@extends('layouts.master')
@section('title','Warehouses_panel')
@section('content')
<div class="page-title-head d-flex align-items-center gap-2">
    <div class="flex-grow-1">
        <h4 class="fs-18 fw-bold mb-0">Warehouses</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0 fs-13">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Warehouses</a></li>
            <li class="breadcrumb-item active">Inventory</li>
        </ol>

        <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#createWarehouseModal">Create Warehouse</button>
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


@include('inventory.components._createWareModal')

<div class="modal fade" id="editWareModal" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Update Warehouse</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editWareForm" class="row" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editWareId" name="id">
                    <div class="mb-3 col-md-12">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" id="edit_location" name="location" required>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="manager_id" class="form-label">Manager</label>
                        <select class="form-control" id="edit_manager_id" name="manager_id" required>
                            <option value="" disabled selected>Choose a manager</option>
                            @foreach ($managers as $manager)
                            <option value={{$manager->id}}>{{$manager->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3 col-md-12">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="edit_description" name="description" required>
                    </div>

                   <div class="mb-3 col-md-12">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="edit_Status" name="status">
                            <option value="" disabled>Choose Status</option>
                            <option value=1>Active</option>
                            <option value=0>Not active</option>
                        </select>
                    </div>



                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="editWareForm" class="btn btn-primary" id="editUserButton">Update User</button>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
<script src="{{ asset('asset/admin/js/inventory/warehouse.js') }}"></script>
@endpush