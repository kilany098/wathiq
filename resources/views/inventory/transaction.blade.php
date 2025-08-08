@extends('layouts.master')
@section('title','transactions_panel')
@section('content')
<div class="page-title-head d-flex align-items-center gap-2">
    <div class="flex-grow-1">
        <h4 class="fs-18 fw-bold mb-0">Transactions</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0 fs-13">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Transactions</a></li>
            <li class="breadcrumb-item active">Inventory</li>
        </ol>

        <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#createTransactionModal">Create Transaction</button>
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


@include('inventory.components._createTransactionModal')


@endsection
@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
<script src="{{ asset('asset/admin/js/inventory/transaction.js') }}"></script>
@endpush