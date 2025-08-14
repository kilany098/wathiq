@extends('layouts.master')
@section('title','Company Branches')
@section('content')
<div class="page-title-head d-flex align-items-center gap-2">
    <div class="flex-grow-1">
        <h4 class="fs-18 fw-bold mb-0">{{$client->name}} Branches</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0 fs-13">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Branches</a></li>
            <li class="breadcrumb-item active">{{$client->name}}</li>
        </ol>

        <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#createBranchModal">Create Branch</button>
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

@include('user.components._createBranchModal')

@include('user.components._editBranchModal')

@endsection
@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
<script src="{{ asset('asset/admin/js/users/branch.js') }}"></script>
@endpush