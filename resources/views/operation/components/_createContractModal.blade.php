<div class="modal fade" id="createContractModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createContractModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="createContractModalLabel">Create New Contract</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createContractForm" class="row g-3">
                    @csrf
                    
                    <!-- Section 1: Client & Operator -->
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">Client Information</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="client_id" class="form-label">Client *</label>
                                    <select class="form-select" id="client_id" name="client_id" required>
                                        <option value="">Select Client</option>
                                        @foreach($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="operated_by" class="form-label">Operator *</label>
                                    <select class="form-select" id="operated_by" name="operated_by" required>
                                        <option value="">Select Operator</option>
                                        @foreach($operators as $operator)
                                        <option value="{{ $operator->id }}">{{ $operator->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="type" class="form-label">Service Type *</label>
                                    <select class="form-select" id="type" name="type" required>
                                        <option value="">Select Type</option>
                                        <option value="Pest Control">Pest Control</option>
                                        <option value="Agricultural">Agricultural</option>
                                        <option value="Industrial">Industrial</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Section 2: Service Details -->
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">Service Details</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="visits" class="form-label">Visits *</label>
                                        <input type="number" class="form-control" id="visits" name="visits" min="1" required>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="start_date" class="form-label">Start Date *</label>
                                        <input type="date" class="form-control" id="start_date" name="start_date" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="end_date" class="form-label">End Date *</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date" required>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="payment_terms" class="form-label">Payment Terms *</label>
                                    <select class="form-select" id="payment_terms" name="payment_terms" required>
                                        <option value="monthly">Monthly</option>
                                        <option value="quarterly">Quarterly</option>
                                        <option value="annual">Annual</option>
                                        <option value="custom">Custom</option>
                                    </select>
                                </div>
                                
                                <div class="mb-0" id="custom_terms_group" style="display:none;">
                                    <label for="custom_payment_terms" class="form-label">Custom Terms</label>
                                    <input type="text" class="form-control" id="custom_payment_terms" name="custom_payment_terms">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Section 3: Terms & Notes -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">Additional Information</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="terms_and_conditions" class="form-label">Terms & Conditions</label>
                                    <textarea class="form-control" id="terms_and_conditions" name="terms_and_conditions" rows="2" maxlength="255"></textarea>
                                </div>
                                
                                <div class="mb-0">
                                    <label for="note" class="form-label">Internal Notes</label>
                                    <textarea class="form-control" id="note" name="note" rows="2" maxlength="255"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="createContractForm" class="btn btn-primary" id="createContractButton">
                    <i class="fas fa-save me-2"></i>Create Contract
                </button>
            </div>
        </div>
    </div>
</div>
