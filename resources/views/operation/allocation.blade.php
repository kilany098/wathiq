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
                                        @foreach($months as $month)
                                        <th>{{ \Carbon\Carbon::parse($month)->format('M Y') }}</th>
                                        @endforeach
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($branches as $branch)
                                    <tr>
                                        <td>
                                            {{ $branch->name }}
                                            <input type="hidden" name="schedules[{{ $branch->id }}][branch_id]" value="{{ $branch->id }}">
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
                                        <td class="total-visits" id="total-{{ $branch->id }}">0</td>
                                    </tr>
                                    @endforeach
                                    <tr class="table-info">
                                        <td><strong>Grand Total</strong></td>
                                        @foreach($months as $month)
                                        <td class="month-total" id="month-{{ $month }}">0</td>
                                        @endforeach
                                        <td class="grand-total" id="grand-total">0</td>
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
                            <button type="submit" class="btn btn-primary">Complete Contract Setup</button>
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
        const requiredVisits = parseInt(document.getElementById('total_visits').value);
        const validationError = document.getElementById('validationError');
        
        function calculateTotals() {
            // Calculate branch totals
            const branchTotals = {};
            visitInputs.forEach(input => {
                const branchId = input.dataset.branch;
                if (!branchTotals[branchId]) {
                    branchTotals[branchId] = 0;
                }
                branchTotals[branchId] += parseInt(input.value) || 0;
            });
            
            // Update branch totals display
            Object.keys(branchTotals).forEach(branchId => {
                document.getElementById(`total-${branchId}`).textContent = branchTotals[branchId];
            });
            
            // Calculate monthly totals
            const monthTotals = {};
            visitInputs.forEach(input => {
                const month = input.dataset.month;
                if (!monthTotals[month]) {
                    monthTotals[month] = 0;
                }
                monthTotals[month] += parseInt(input.value) || 0;
            });
            
            // Update monthly totals display
            Object.keys(monthTotals).forEach(month => {
                document.getElementById(`month-${month}`).textContent = monthTotals[month];
            });
            
            // Calculate grand total
            let grandTotal = 0;
            Object.values(branchTotals).forEach(total => {
                grandTotal += total;
            });
            
            document.getElementById('grand-total').textContent = grandTotal;
            document.getElementById('currentTotal').textContent = grandTotal;
            
            // Show/hide validation error
            if (grandTotal !== requiredVisits) {
                validationError.classList.remove('d-none');
            } else {
                validationError.classList.add('d-none');
            }
            
            return grandTotal;
        }
        
        // Update totals when inputs change
        visitInputs.forEach(input => {
            input.addEventListener('change', function() {
                calculateTotals();
            });
        });
        
        // Form submission validation
        document.getElementById('visitsForm').addEventListener('submit', function(e) {
            const totalVisits = calculateTotals();
            
            if (totalVisits !== requiredVisits) {
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