@extends('layouts.master')
@section('title','Work orders_panel')
@section('content')
<div class="page-title-head d-flex align-items-center gap-2">
    <div class="flex-grow-1">
        <h4 class="fs-18 fw-bold mb-0">Work orders</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0 fs-13">
            <li class="breadcrumb-item"><a href="javascript: void(0);">work orders</a></li>
            <li class="breadcrumb-item active">Operation</li>
        </ol>

        <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#createOrderModal">Create Work Order</button>
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


@include('operation.components._createOrderModal')

  <div class="modal fade" id="addUserModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createContractModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createContractModalLabel">Add new order worker</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addWorkerForm">
                    @csrf

                    <!-- Assigned To -->
                    <div class="mb-3 col-md-6">

<div id="order_workers">
<h4>The order workers</h4>    
<p>. hi</p>
</div>
<input type="hidden" id="editWorkerId" name="id">
                        <label for="assigned_id" class="form-label">Workers *</label>
                        <select class="form-control" id="add_assigned_id" name="assigned_id" required>
                            <option value="">Select User</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="addWorkerForm" class="btn btn-primary" id="createContractButton">Add Worker</button>
            </div>
        </div>
    </div>
</div>
                
@endsection
@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
<script src="{{ asset('asset/admin/js/operation/order.js') }}"></script>
@endpush