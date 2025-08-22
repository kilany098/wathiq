@extends('layouts.master')
@section('title',__('categories_panel'))
@section('content')
<div class="page-title-head d-flex align-items-center gap-2">
    <div class="flex-grow-1">
        <h4 class="fs-18 fw-bold mb-0">{{__('Categories')}}</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0 fs-13">
            <li class="breadcrumb-item"><a href="javascript: void(0);">{{__('Categories')}}</a></li>
            <li class="breadcrumb-item active">{{__('Inventory')}}</li>
        </ol>

        <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#createCategoryModal">{{__('Create Category')}}</button>
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


@include('inventory.components._createCategoryModal')

<div class="modal fade" id="createCategoryModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">{{__('Create Category')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{__('Close')}}"></button>
            </div>
            <div class="modal-body">
                <form id="createCategoryForm" action="{{ route('category.create') }}" class="row" method="POST" >
                    @csrf
                    <div class="mb-3 col-md-12">
                        <label for="name" class="form-label">{{__('Name')}}</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    
                    <div class="mb-3 col-md-12">
                        <label for="description" class="form-label">{{__('Description')}}</label>
                        <input type="text" class="form-control" id="description" name="description" required>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Cancel')}}</button>
                <button type="submit" form="createCategoryForm" class="btn btn-primary" id="createUserButton">{{__('Create Category')}}</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editCategoryModal" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">{{__('Update Category')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{__('Close')}}"></button>
            </div>
            <div class="modal-body">
                <form id="editCategoryForm" class="row" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editCategoryId" name="id">
                    <div class="mb-3 col-md-12">
                        <label for="name" class="form-label">{{__('Name')}}</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    
                    <div class="mb-3 col-md-12">
                        <label for="description" class="form-label">{{__('Description')}}</label>
                        <input type="text" class="form-control" id="edit_description" name="description" required>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Cancel')}}</button>
                <button type="submit" form="editCategoryForm" class="btn btn-primary" id="editUserButton">{{__('Update Category')}}</button>
            </div>
        </div>
    </div>
</div>


@endsection
@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
<script src="{{ asset('asset/admin/js/inventory/category.js') }}"></script>
@endpush