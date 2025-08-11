<div class="modal fade" id="createContractModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">Create Contract</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createContractForm" >
                    @csrf
                 <div class="mb-3 col-md-6">
                    <label for="client_id" class="form-label">Client *</label>
                    <select class="form-control" id="client_id" name="client_id" required>
                        <option value="">Select Client</option>
                        @foreach($clients as $client)
                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3 col-md-6">
                    <label for="operated_by" class="form-label">Operator *</label>
                    <select class="form-control" id="operated_by" name="operated_by" required>
                        <option value="">Select Operator</option>
                        @foreach($operators as $operator)
                        <option value="{{ $operator->id }}">{{ $operator->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Contract Number -->
                <div class="mb-3 col-md-6">
                    <label for="contract_number" class="form-label">Contract Number *</label>
                    <input type="text" class="form-control" id="contract_number" name="contract_number" required>
                </div>

                <!-- Contract Title -->
                <div class="mb-3 col-md-12">
                    <label for="title" class="form-label">Title *</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>

                <!-- Description -->
                <div class="mb-3 col-md-12">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="2"></textarea>
                </div>

                <!-- Date Range -->
                <div class="mb-3 col-md-6">
                    <label for="start_date" class="form-label">Start Date *</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" required>
                </div>

                <div class="mb-3 col-md-6">
                    <label for="end_date" class="form-label">End Date *</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" required>
                </div>

                <!-- Financial Information -->
                <div class="mb-3 col-md-6">
                    <label for="total_value" class="form-label">Total Value *</label>
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" class="form-control" id="total_value" name="total_value" min="0" step="0.01" required>
                    </div>
                </div>

                <div class="mb-3 col-md-6">
                    <label for="payment_terms" class="form-label">Payment Terms *</label>
                    <select class="form-control" id="payment_terms" name="payment_terms" required>
                        <option value="monthly">Monthly</option>
                        <option value="quarterly">Quarterly</option>
                        <option value="annual">Annual</option>
                        <option value="custom">Custom</option>
                    </select>
                </div>

                <!-- Custom Payment Terms (Conditional) -->
                <div class="mb-3 col-md-12" id="custom_terms_group" style="display:none;">
                    <label for="custom_payment_terms" class="form-label">Custom Payment Terms</label>
                    <input type="text" class="form-control" id="custom_payment_terms" name="custom_payment_terms">
                </div>

                <!-- Terms and Conditions -->
                <div class="mb-3 col-md-12">
                    <label for="terms_and_conditions" class="form-label">Terms and Conditions</label>
                    <textarea class="form-control" id="terms_and_conditions" name="terms_and_conditions" rows="4"></textarea>
                </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="createContractForm" class="btn btn-primary" id="createUserButton">Create Contract</button>
            </div>
        </div>
    </div>
</div>