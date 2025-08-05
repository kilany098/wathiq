@extends('layouts.master')
@section('title','Clients_panel')
@section('content')
<div class="page-title-head d-flex align-items-center gap-2">
    <div class="flex-grow-1">
        <h4 class="fs-18 fw-bold mb-0">Clients</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0 fs-13">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Clients</a></li>
            <li class="breadcrumb-item active">Admin</li>
        </ol>

        <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#createClientModal">Create Client</button>
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

@include('user.components._createClientModal')


<div class="modal fade" id="editUserModal" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Update User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editUserForm" class="row" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editUserId" name="id">
                    <div class="mb-3 col-md-12">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name">
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="edit_email" name="email">
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="edit_phone" name="phone">
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="userStatus" class="form-label">Status</label>
                        <select class="form-control" id="edit_userStatus" name="status">
                            <option value="" disabled>Choose Status</option>
                            <option value=1>Active</option>
                            <option value=0>Not active</option>
                        </select>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-control" id="edit-role" name="role">
                            <option value="" disabled selected>Choose Role</option>

                        </select>
                        <small class="text-warning">leave it empty to keep current role</small>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="password" class="form-label">Password</label>
                        <input type="tel" class="form-control mb-1" id="edit_password" name="password">
                        <small class="text-warning">leave it empty to keep current password</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="editUserForm" class="btn btn-primary" id="editUserButton">Update User</button>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
<script src="{{ asset('asset/admin/js/users/client.js') }}"></script>
@endpush