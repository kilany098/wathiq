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

<div class="modal fade" id="editContractModal" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Update Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
    <form id="editContractForm" class="row" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" id="editContractId" name="id" >
        
        <div class="mb-3 col-md-6">
            <label for="edit_client_id" class="form-label">Client *</label>
            <select class="form-control" id="edit_client_id" name="client_id" required>
                <option value="">Select Client</option>
                @foreach($clients as $client)
                <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3 col-md-6">
            <label for="edit_contract_number" class="form-label">Contract Number *</label>
            <input type="text" class="form-control" id="edit_contract_number" name="contract_number" required readonly>
        </div>

        <div class="mb-3 col-md-12">
            <label for="edit_title" class="form-label">Title *</label>
            <input type="text" class="form-control" id="edit_title" name="title" required>
        </div>

        <div class="mb-3 col-md-12">
            <label for="edit_description" class="form-label">Description</label>
            <textarea class="form-control" id="edit_description" name="description" rows="2"></textarea>
        </div>

        <div class="mb-3 col-md-6">
            <label for="edit_start_date" class="form-label">Start Date *</label>
            <input type="date" class="form-control" id="edit_start_date" name="start_date" required>
        </div>

        <div class="mb-3 col-md-6">
            <label for="edit_end_date" class="form-label">End Date *</label>
            <input type="date" class="form-control" id="edit_end_date" name="end_date" required>
        </div>

        <div class="mb-3 col-md-6">
            <label for="edit_total_value" class="form-label">Total Value *</label>
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="number" class="form-control" id="edit_total_value" name="total_value" min="0" step="0.01" required>
            </div>
        </div>

        <div class="mb-3 col-md-6">
            <label for="edit_payment_terms" class="form-label">Payment Terms *</label>
            <select class="form-control" id="edit_payment_terms" name="payment_terms" required>
                <option value="monthly">Monthly</option>
                <option value="quarterly">Quarterly</option>
                <option value="annual">Annual</option>
                <option value="custom">Custom</option>
            </select>
        </div>

        <div class="mb-3 col-md-6">
            <label for="edit_status" class="form-label">Status *</label>
            <select class="form-control" id="edit_status" name="status" required>
                <option value="draft">draft</option>
                <option value="active">active</option>
                <option value="expired">expired</option>
                <option value="terminated">terminated</option>
            </select>
        </div>

        <div class="mb-3 col-md-12">
            <label for="edit_terms_and_conditions" class="form-label">Terms and Conditions</label>
            <textarea class="form-control" id="edit_terms_and_conditions" name="terms_and_conditions" rows="4"></textarea>
        </div>
    </form>
</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="editContractForm" class="btn btn-primary" id="editUserButton">Update Contract</button>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
<script src="{{ asset('asset/admin/js/operation/contract.js') }}"></script>
@endpush