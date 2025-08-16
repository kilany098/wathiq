@extends('layouts.master')
@section('title','contracts_panel')

@section('content')

<div class="page-title-head d-flex align-items-center gap-2">
    <div class="flex-grow-1">
        <h4 class="fs-18 fw-bold mb-0">Assign Order To {{$schedule->branch->name. ' | '. $month->translatedFormat('F')}}</h4>
        <span class="badge bg-info text-dark fs-13">Unassigned Visits this month: <span id="visit_count">{{$schedule->visits_count}}</span></span>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0 fs-13">
            <li class="breadcrumb-item"><a href="javascript: void(0);">Work Orders</a></li>
            <li class="breadcrumb-item active">Sup Operation</li>
        </ol>
         @if($schedule->visits_count >= 1)
          <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#createOrderModal">Create Work Order</button>
         @endif 
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
                <h5 class="modal-title" id="createOrderModalLabel">Create Work Order</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createOrderForm" class="row g-3">
                    @csrf

                   <input type="hidden" name="schedule_id" value={{$schedule->id}} >

                    <!-- Section 1: Basic Information -->
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">Order Details</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Title *</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description *</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Scheduling -->
                    <div class="col-md-6">
                        <div class="card h-100">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">Scheduling</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="start_date" class="form-label">Start Date</label>
                                        <input type="datetime-local" class="form-control" id="start_date" name="start_date">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="end_date" class="form-label">End Date & Time</label>
                                        <input type="datetime-local" class="form-control" id="end_date" name="end_date">
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <label for="assigned_id" class="form-label">Technician *</label>
                                    <select class="form-select" id="assigned_id" name="assigned_id" required>
                                        <option value="" disabled selected>Choose technician</option>
                                        @foreach ($technicians as $technician)
                                        <option value="{{ $technician->id }}">{{ $technician->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Additional Information -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">Additional Information</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-0">
                                    <label for="notes" class="form-label">Internal Notes</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="2" maxlength="255"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="createOrderForm" class="btn btn-primary" id="createOrderButton">
                    <i class="fas fa-save me-2"></i>Create Work Order
                </button>
            </div>
        </div>
    </div>
</div>




@endsection
@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
<script src="{{ asset('asset/admin/js/sup_op/assign.js') }}"></script>
@endpush