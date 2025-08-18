@extends('layouts.master')
@section('title','contract_allocation')
@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Schedule Visits for {{ $contract->client->name}} Company</div>

                <div class="card-body">
                    <form method="POST" action="{{route('allocation.create')}}" id="visitsForm">
                        @csrf
                        <input type="hidden" name="contract_id" value="{{ $contract->id }}">
                        <input type="hidden" id="total_visits" value="{{ $contract->visits }}">

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="table-light">
                                    <tr>
                                        <th>Branch</th>
                                        <th>Visit Price</th>
                                        <th>Expected Hours</th>
                                        @foreach($months as $month)
                                        <th>{{ \Carbon\Carbon::parse($month)->format('M Y') }}</th>
                                        @endforeach
                                        <th>Total Value</th>                
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($branches as $branch)
                                    <tr>
                                        <td>
                                            {{ $branch->name }}
                                            <input type="hidden" name="schedules[{{ $branch->id }}][branch_id]" value="{{ $branch->id }}">
                                        </td>
                                        <td>
                                            <input type="number" class="form-control visit-price" 
                                                   name="schedules[{{ $branch->id }}][visit_price]" 
                                                   value="0" min="0" step="0.01" required>
                                        </td>
                                        <td>
                                            <input type="number" class="form-control hours-per-visit" 
                                                   name="schedules[{{ $branch->id }}][hours_per_visit]" 
                                                   value="0" min="0" step="0.1" required>
                                        </td>
                                        @foreach($months as $month)
                                        <td>
                                            <input type="number" 
                                                class="form-control visit-count" 
                                                name="schedules[{{ $branch->id }}][{{ $month }}]" 
                                                min="0" 
                                                data-branch="{{ $branch->id }}"
                                                data-month="{{ $month }}"
                                                value="0">
                                        </td>
                                        @endforeach
                                        <td class="total-value" id="value-{{ $branch->id }}">$0.00</td> 
                                    </tr>
                                    @endforeach
                                    <tr class="table-info">
                                        <td colspan="3"><strong>Grand Total</strong></td>
                                        @foreach($months as $month)
                                        <td class="month-total" id="month-{{ $month }}">0</td>
                                        @endforeach
                                        <td class="grand-value" id="grand-value">$0.00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="alert alert-info mt-3">
                            <strong>Note:</strong> The sum of all branch visits must exactly match the contract requirement of {{ $contract->visits }} visits.
                        </div>

                        <div id="validationError" class="alert alert-danger d-none">
                            The total number of visits (<span id="currentTotal">0</span>) does not match the required {{ $contract->visits }} visits.
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                            <button type="submit" class="btn btn-primary" id="submitButton" disabled>Complete Contract Setup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const visitInputs = document.querySelectorAll('.visit-count');
        const priceInputs = document.querySelectorAll('.visit-price');
        const hoursInputs = document.querySelectorAll('.hours-per-visit');
        const requiredVisits = parseInt(document.getElementById('total_visits').value);
        const validationError = document.getElementById('validationError');
        const submitButton = document.getElementById('submitButton');
        
        function calculateTotals() {
            let grandTotalVisits = 0;
            let grandTotalValue = 0;
            
            // Calculate branch totals
            const branchTotals = {};
            const monthTotals = {};
            
            // Initialize month totals
            @foreach($months as $month)
                monthTotals['{{ $month }}'] = 0;
            @endforeach
            
            visitInputs.forEach(input => {
                const branchId = input.dataset.branch;
                const month = input.dataset.month;
                const visits = parseInt(input.value) || 0;
                
                if (!branchTotals[branchId]) {
                    branchTotals[branchId] = {
                        visits: 0,
                        value: 0
                    };
                }
                
                // Get price for this branch
                const price = parseFloat(document.querySelector(`input[name="schedules[${branchId}][visit_price]"]`).value) || 0;
                
                // Update branch totals
                branchTotals[branchId].visits += visits;
                branchTotals[branchId].value += visits * price;
                
                // Update month totals
                monthTotals[month] += visits;
                
                // Update grand totals
                grandTotalVisits += visits;
                grandTotalValue += visits * price;
            });
            
            // Update branch totals display
            Object.keys(branchTotals).forEach(branchId => {
                document.getElementById(`value-${branchId}`).textContent = `$${branchTotals[branchId].value.toFixed(2)}`;
            });
            
            // Update monthly totals display
            Object.keys(monthTotals).forEach(month => {
                document.getElementById(`month-${month}`).textContent = monthTotals[month];
            });
            
            // Update grand totals display
            document.getElementById('grand-value').textContent = `$${grandTotalValue.toFixed(2)}`;
            document.getElementById('currentTotal').textContent = grandTotalVisits;
            
            // Show/hide validation error and enable/disable submit button
            if (grandTotalVisits !== requiredVisits) {
                validationError.classList.remove('d-none');
                submitButton.disabled = true;
            } else {
                validationError.classList.add('d-none');
                submitButton.disabled = false;
            }
            
            return {
                visits: grandTotalVisits,
                value: grandTotalValue
            };
        }
        
        // Update totals when any input changes
        function handleInputChange() {
            calculateTotals();
        }
        
        // Add event listeners to all relevant inputs
        visitInputs.forEach(input => input.addEventListener('input', handleInputChange));
        priceInputs.forEach(input => input.addEventListener('input', handleInputChange));
        hoursInputs.forEach(input => input.addEventListener('input', handleInputChange));
        
        // Form submission validation
        document.getElementById('visitsForm').addEventListener('submit', function(e) {
            const totals = calculateTotals();
            
            if (totals.visits !== requiredVisits) {
                e.preventDefault();
                validationError.classList.remove('d-none');
                validationError.scrollIntoView({ behavior: 'smooth' });
            }
        });
        
        // Initial calculation
        calculateTotals();
    });
</script>

@endsection