@extends('layouts.master')
@section('title','contracts_panel')
@section('content')
<div class="page-title-head d-flex align-items-center gap-2">
    <div class="flex-grow-1">
        <h4 class="fs-18 fw-bold mb-0">Urgent Orders</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0 fs-13">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Urgent Orders</a></li>
            <li class="breadcrumb-item active">Sup Operation</li>
        </ol>

        <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#createOrderModal">Create Urgent Order</button>
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


<div class="modal fade" id="createOrderModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createContractModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createContractModalLabel">Create Work Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createOrderForm">
                    @csrf

                    <!-- Contract ID -->
                    <div class="mb-3 col-md-6">
                        <label for="contract_id" class="form-label">Contract *</label>
                        <select class="form-control" id="contract_id" name="contract_id" required>
                            <option value="">Select Contract</option>
                            @foreach($contracts as $contract)
                            <option value="{{ $contract->id }}">{{ $contract->contract_number }}</option>
                            @endforeach
                        </select>
                    </div>

<!-- Contract ID -->
                    <div class="mb-3 col-md-6">
                        <label for="branch_id" class="form-label">Branch *</label>
                        <select class="form-control" id="branch_id" name="branch_id" required>
                            <option value="">Select Branch</option>
                            @foreach($branches as $branch)
                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <!-- Title -->
                    <div class="mb-3 col-md-12">
                        <label for="title" class="form-label">Price *</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>

                    <!-- Description -->
                    <div class="mb-3 col-md-12">
                        <label for="description" class="form-label">Hours *</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>

                    <!-- Priority -->
                    <div class="mb-3 col-md-6">
                        <label for="priority" class="form-label">Priority *</label>
                        <select class="form-control" id="priority" name="priority" required>
                            <option value="low">Low</option>
                            <option value="medium">Medium</option>
                            <option value="high">High</option>
                            <option value="urgent">Urgent</option>
                        </select>
                    </div>

                    <!-- Due Date -->
                    <div class="mb-3 col-md-6">
                        <label for="due_date" class="form-label">Due Date</label>
                        <input type="date" class="form-control" id="due_date" name="due_date">
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="createOrderForm" class="btn btn-primary" id="createContractButton">Create Urgent Order</button>
            </div>
        </div>
    </div>
</div>



@endsection
@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
<script src="{{ asset('asset/admin/js/operation/contract.js') }}"></script>
@endpush