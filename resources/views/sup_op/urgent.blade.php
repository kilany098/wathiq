@extends('layouts.master')
@section('title',__('contracts_panel'))
@section('content')
<div class="page-title-head d-flex align-items-center gap-2">
    <div class="flex-grow-1">
        <h4 class="fs-18 fw-bold mb-0">{{__('Urgent Orders')}}</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0 fs-13">
            <li class="breadcrumb-item"><a href="javascript: void(0);">{{__('Urgent Orders')}}</a></li>
            <li class="breadcrumb-item active">{{__('Operation')}}</li>
        </ol>

        <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#createOrderModal">{{__('Create Urgent Order')}}</button>
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


<div class="modal fade" id="createOrderModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createOrderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="createOrderModalLabel">{{__('Create Urgent Order')}}</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="{{__('Close')}}"></button>
                </div>
                <div class="modal-body">
                    <form id="createOrderForm" class="row g-3">
                        @csrf
                        
                        <!-- Contract Information -->
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">{{__('Contract Information')}}</h6>
                                </div>
                                <div class="card-body">

                                    <!-- Client -->
                                    <div class="mb-3">
                                        <label for="client_id" class="form-label required-field">{{__('Client')}}</label>
                                        <select class="form-select" id="client_id" name="client_id" required>
                                            <option value="" disabled selected>{{__('Select Client')}}</option>
                                            @foreach($clients as $client)
                                            <option value={{$client->id}}>{{$client->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Contract ID -->
                                    <div class="mb-3">
                                        <label for="contract_id" class="form-label required-field">{{__('Contract')}}</label>
                                        <select class="form-select" id="contract_id" name="contract_id" required>
                                            <option value="">{{__('Select Contract')}}</option>
                                        </select>
                                    </div>

                                    <!-- Branch ID -->
                                    <div class="mb-3">
                                        <label for="branch_id" class="form-label required-field">{{__('Branch')}}</label>
                                        <select class="form-select" id="branch_id" name="branch_id" required>
                                            <option value="">{{__('Select Branch')}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Financial Details -->
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">{{__('Financial Details')}}</h6>
                                </div>
                                <div class="card-body">
                                    <!-- Visit Price -->
                                    <div class="mb-3">
                                        <label for="visit_price" class="form-label required-field">{{__('Visit Price ($)')}}</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                            <input type="number" step="0.01" min="0" class="form-control" id="visit_price" name="visit_price" required>
                                        </div>
                                    </div>

                                    <!-- Expected Hours -->
                                    <div class="mb-3">
                                        <label for="expected_hours" class="form-label required-field">{{__('Expected Hours')}}</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                            <input type="number" step="0.5" min="0" class="form-control" id="expected_hours" name="expected_hours" required>
                                        </div>
                                    </div>

                                    <!-- Month -->
                                    <div class="mb-3">
                                        <label for="month" class="form-label required-field">{{__('Month')}}</label>
                                        <select class="form-select" id="month" name="month" required>
                                            <option value="">{{__('Select Month')}}</option>
                                            <option value="1">{{__('January')}}</option>
                                            <option value="2">{{__('February')}}</option>
                                            <option value="3">{{__('March')}}</option>
                                            <option value="4">{{__('April')}}</option>
                                            <option value="5">{{__('May')}}</option>
                                            <option value="6">{{__('June')}}</option>
                                            <option value="7">{{__('July')}}</option>
                                            <option value="8">{{__('August')}}</option>
                                            <option value="9">{{__('September')}}</option>
                                            <option value="10">{{__('October')}}</option>
                                            <option value="11">{{__('November')}}</option>
                                            <option value="12">{{__('December')}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Work Details -->
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">{{__('Work Details')}}</h6>
                                </div>
                                <div class="card-body">
                                    <!-- Title -->
                                    <div class="mb-3">
                                        <label for="title" class="form-label required-field">{{__('Title')}}</label>
                                        <input type="text" class="form-control" id="title" name="title" required>
                                    </div>

                                    <!-- Description -->
                                    <div class="mb-3">
                                        <label for="description" class="form-label required-field">{{__('Description')}}</label>
                                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Schedule & Assignment -->
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">{{__('Schedule & Assignment')}}</h6>
                                </div>
                                <div class="card-body">
                                    <!-- Start Date -->
                                    <div class="mb-3">
                                        <label for="start_date" class="form-label">{{__('Start Date')}}</label>
                                        <input type="datetime-local" class="form-control" id="start_date" name="start_date">
                                    </div>

                                    <!-- End Date -->
                                    <div class="mb-3">
                                        <label for="end_date" class="form-label">{{__('End Date & Time')}}</label>
                                        <input type="datetime-local" class="form-control" id="end_date" name="end_date">
                                    </div>

                                    <!-- Assigned To -->
                                    <div class="mb-3">
                                        <label for="assigned_id" class="form-label required-field">{{__('Assigned To')}}</label>
                                        <select class="form-select" id="assigned_id" name="assigned_id" required>
                                            <option value="">{{__('Select Assignee')}}</option>
                                            @foreach ($technicians as $technician)
                                            <option value={{$technician->id}}>{{$technician->full_name}}</option>    
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{__('Cancel')}}</button>
                    <button type="submit" form="createOrderForm" class="btn btn-primary" id="createOrderButton">
                        <i class="fas fa-plus-circle me-2"></i>{{__('Create Work Order')}}
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
</script> 
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
<script src="{{ asset('asset/admin/js/sup_op/urgent.js') }}"></script>
@endpush