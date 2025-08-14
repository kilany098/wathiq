@extends('layouts.master')
@section('title','contracts_panel')
@section('content')
<div class="page-title-head d-flex align-items-center gap-2">
    <div class="flex-grow-1">
        <h4 class="fs-18 fw-bold mb-0">contracts</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0 fs-13">
            <li class="breadcrumb-item"><a href="javascript: void(0);">contracts</a></li>
            <li class="breadcrumb-item active">Operation</li>
        </ol>

        <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#createContractModal">Create Contract</button>
    </div>
</div>

<div class="page-container">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                {{ $dataTable->table() }}
            </div>
        </div> <!-- end card body-->
    </div>
</div>


@include('operation.components._createContractModal')

<div class="modal fade" id="editContractModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editContractModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editContractModalLabel">Edit Contract</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editContractForm" class="row g-3">
                    @csrf
                    @method('PUT')
                    
                    <input type="hidden" id="editContractId" >
                    <!-- Section 1: Client & Operator -->
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">Client Information</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="edit_client_id" class="form-label">Client *</label>
                                    <select class="form-select" id="edit_client_id" name="client_id" required>
                                        <option value="">Select Client</option>
                                        @foreach($clients as $client)
                                        <option value="{{ $client->id }}">{{ $client->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="edit_operated_by" class="form-label">Operator *</label>
                                    <select class="form-select" id="edit_operated_by" name="operated_by" required>
                                        <option value="">Select Operator</option>
                                        @foreach($operators as $operator)
                                        <option value="{{ $operator->id }}">{{ $operator->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="edit_type" class="form-label">Service Type *</label>
                                    <select class="form-select" id="edit_type" name="type" required>
                                        <option value="">Select Type</option>
                                        <option value="Pest Control">Pest Control</option>
                                        <option value="Agricultural">Agricultural</option>
                                        <option value="Industrial">Industrial</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>

                                <!-- New Status Field -->
                                <div class="mb-3">
                                    <label for="edit_status" class="form-label">Status *</label>
                                    <select class="form-select" id="edit_status" name="status" required>
                                        <option value="draft">draft</option>
                                        <option value="active">active</option>
                                        <option value="expired">expired</option>
                                        <option value="terminated">terminated</option>
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
                                        <label for="edit_visits" class="form-label">Visits *</label>
                                        <input type="number" class="form-control" id="edit_visits" name="visits" min="1" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="edit_expected_hours" class="form-label">Expected Hours *</label>
                                        <input type="number" class="form-control" id="edit_expected_hours" name="expected_hours" min="1" step="0.1" required>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="edit_start_date" class="form-label">Start Date *</label>
                                        <input type="date" class="form-control" id="edit_start_date" name="start_date" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="edit_end_date" class="form-label">End Date *</label>
                                        <input type="date" class="form-control" id="edit_end_date" name="end_date" required>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="edit_payment_terms" class="form-label">Payment Terms *</label>
                                    <select class="form-select" id="edit_payment_terms" name="payment_terms" required>
                                        <option value="monthly">Monthly</option>
                                        <option value="quarterly">Quarterly</option>
                                        <option value="annual">Annual</option>
                                        <option value="custom">Custom</option>
                                    </select>
                                </div>
                                
                                <div class="mb-0" id="edit_custom_terms_group" style="display:none;">
                                    <label for="edit_custom_payment_terms" class="form-label">Custom Terms</label>
                                    <input type="text" class="form-control" id="edit_custom_payment_terms" name="custom_payment_terms">
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
                                    <label for="edit_terms_and_conditions" class="form-label">Terms & Conditions</label>
                                    <textarea class="form-control" id="edit_terms_and_conditions" name="terms_and_conditions" rows="2" maxlength="255"></textarea>
                                </div>
                                
                                <div class="mb-0">
                                    <label for="edit_note" class="form-label">Internal Notes</label>
                                    <textarea class="form-control" id="edit_note" name="note" rows="2" maxlength="255"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="editContractForm" class="btn btn-primary" id="editContractButton">
                    <i class="fas fa-save me-2"></i>Update Contract
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
<script src="{{ asset('asset/admin/js/operation/contract.js') }}"></script>
@endpush