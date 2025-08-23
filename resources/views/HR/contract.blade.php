@extends('layouts.master')
@section('title','contracts_panel')
@section('content')
<div class="page-title-head d-flex align-items-center gap-2">
    <div class="flex-grow-1">
        <h4 class="fs-18 fw-bold mb-0 ">{{__('Contracts')}}</h4>
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0 fs-13">
            <li class="breadcrumb-item"><a href="javascript: void(0);">{{__('Contracts')}}</a></li>
            <li class="breadcrumb-item active">{{__('HR')}}</li>
        </ol>

        <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#createEmployeeModal">{{__('Create Contract')}}</button>
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


<div class="modal fade" id="createEmployeeModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="createEmployeeModalLabel">{{__('Create Employee')}}</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="{{__('Close')}}"></button>
                </div>
                <div class="modal-body">
                    <form id="createEmployeeForm" class="row g-3" action="{{ route('hr.create') }}" method="POST">
                        @csrf
                        
                        <!-- Basic Information -->
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">{{__('Basic Information')}}</h6>
                                </div>
                                <div class="card-body">
                                    <!-- User ID -->
                                    <div class="mb-3">
                                        <label for="user_id" class="form-label required-field">{{__('User Account')}}</label>
                                        <select class="form-select" id="user_id" name="user_id" required>
                                            <option value="" disabled selected>{{__('Select User Account')}}</option>
                                            @foreach ($users as $user)
                                            <option value="{{$user->id}}">{{$user->full_name}}</option>   
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Hire Date -->
                                    <div class="mb-3">
                                        <label for="hire_date" class="form-label required-field">{{__('Hire Date')}}</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                            <input type="date" class="form-control" id="hire_date" name="hire_date" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Financial Information -->
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">{{__('Financial Information')}}</h6>
                                </div>
                                <div class="card-body">
                                    <!-- Salary -->
                                    <div class="mb-3">
                                        <label for="salary" class="form-label">{{__('Salary ($)')}}</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                            <input type="number" step="0.01" min="0" class="form-control" id="salary" name="salary">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Emergency Contact -->
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">{{__('Emergency Contact')}}</h6>
                                </div>
                                <div class="card-body">
                                    <!-- Emergency Contact Name -->
                                    <div class="mb-3">
                                        <label for="emergency_contact" class="form-label">{{__('Contact Name')}}</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            <input type="text" class="form-control" id="emergency_contact" name="emergency_contact">
                                        </div>
                                    </div>

                                    <!-- Emergency Phone -->
                                    <div class="mb-3">
                                        <label for="emergency_phone" class="form-label">{{__('Phone Number')}}</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            <input type="tel" class="form-control" id="emergency_phone" name="emergency_phone">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Additional Information -->
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">{{__('Additional Information')}}</h6>
                                </div>
                                <div class="card-body">
                                    <!-- Notes -->
                                    <div class="mb-3">
                                        <label for="notes" class="form-label">{{__('Notes')}}</label>
                                        <textarea class="form-control" id="notes" name="notes" rows="4"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{__('Cancel')}}</button>
                    <button type="submit" form="createEmployeeForm" class="btn btn-primary" id="createEmployeeButton">
                        <i class="fas fa-plus-circle me-2"></i>{{__('Create Employee')}}
                    </button>
                </div>
            </div>
        </div>
    </div>


<div class="modal fade" id="editEmployeeModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-warning text-dark">
                    <h5 class="modal-title" id="editEmployeeModalLabel">{{__('Edit Employee')}}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{__('Close')}}"></button>
                </div>
                <div class="modal-body">
                    <form id="editEmployeeForm" class="row g-3" action="#" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="editEmployeeId" name="id">
                        <!-- Basic Information -->
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">{{__('Basic Information')}}</h6>
                                </div>
                                <div class="card-body">
                                    

                                    <!-- Hire Date -->
                                    <div class="mb-3">
                                        <label for="edit_hire_date" class="form-label required-field">{{__('Hire Date')}}</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                            <input type="date" class="form-control" id="edit_hire_date" name="hire_date" required>
                                        </div>
                                    </div>

                                    <!-- Termination Date -->
                                    <div class="mb-3">
                                        <label for="edit_termination_date" class="form-label">{{__('Termination Date')}}</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-calendar-times"></i></span>
                                            <input type="date" class="form-control" id="edit_termination_date" name="termination_date">
                                        </div>
                                        <div class="form-text">{{__('Leave blank if employee is still active')}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Financial Information -->
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">{{__('Financial Information')}}</h6>
                                </div>
                                <div class="card-body">
                                    <!-- Salary -->
                                    <div class="mb-3">
                                        <label for="edit_salary" class="form-label">{{__('Salary ($)')}}</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                            <input type="number" step="0.01" min="0" class="form-control" id="edit_salary" name="salary">
                                        </div>
                                    </div>

                
                                </div>
                            </div>
                        </div>
                        
                        <!-- Emergency Contact -->
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">{{__('Emergency Contact')}}</h6>
                                </div>
                                <div class="card-body">
                                    <!-- Emergency Contact Name -->
                                    <div class="mb-3">
                                        <label for="edit_emergery_contact" class="form-label">{{__('Contact Name')}}</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            <input type="text" class="form-control" id="edit_emergency_contact" name="emergency_contact">
                                        </div>
                                    </div>

                                    <!-- Emergency Phone -->
                                    <div class="mb-3">
                                        <label for="edit_emergency_phone" class="form-label">{{__('Phone Number')}}</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                            <input type="tel" class="form-control" id="edit_emergency_phone" name="emergency_phone" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Additional Information -->
                        <div class="col-md-6">
                            <div class="card h-100">
                                <div class="card-header bg-light">
                                    <h6 class="mb-0">{{__('Additional Information')}}</h6>
                                </div>
                                <div class="card-body">

                                    <!-- Notes -->
                                    <div class="mb-3">
                                        <label for="edit_notes" class="form-label">{{__('Notes')}}</label>
                                        <textarea class="form-control" id="edit_notes" name="notes" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{__('Cancel')}}</button>
                    <button type="submit" form="editEmployeeForm" class="btn btn-warning" id="editEmployeeButton">
                        <i class="fas fa-save me-2"></i>{{__('Update Employee')}}
                    </button>
                </div>
            </div>
        </div>
    </div>



@endsection
@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
<script src="{{ asset('asset/admin/js/hr/contract.js') }}"></script>
@endpush