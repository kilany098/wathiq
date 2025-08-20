@extends('layouts.master')
@section('title','contracts_panel')

@section('content')

<div class="page-title-head d-flex align-items-center gap-2">
    <div class="flex-grow-1">
        <h4 class="fs-18 fw-bold mb-0">My Inventory</h4>
       
    </div>

    <div class="text-end">
        <ol class="breadcrumb m-0 py-0 fs-13">
            <li class="breadcrumb-item"><a href="javascript: void(0);">My Inventory</a></li>
            <li class="breadcrumb-item active">Technical</li>
        </ol>
          <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#createRequestModal">Request Item</button> 
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



<div class="modal fade" id="createRequestModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createContractModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="createContractModalLabel">Create New Request</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createRequestForm" class="row g-3" action="{{route('request.create')}}" method="POST">
                    @csrf
                    <!-- Section 3: Inventory Management -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">Inventory Management</h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="item_id" class="form-label">Item *</label>
                                        <select class="form-select" id="item_id" name="item_id" required>
                                            <option value="">Select Item</option>
                                            @foreach ($items as $item)
                                            <option value={{$item->id}}>{{$item->code}}</option>    
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <label for="warehouse_id" class="form-label">Warehouse *</label>
                                        <select class="form-select" id="warehouse_id" name="warehouse_id" required>
                                            <option value="">Select Warehouse</option>
                                            
                                        </select>
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <label for="quantity" class="form-label">Quantity *</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="quantity" name="quantity" min="0.01" step="0.01" required>
                                            <span class="input-group-text" id="quantity_unit">Unit</span>
                                        </div>
                                        <small class="form-text text-muted">Enter quantity with up to 2 decimal places</small>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="related_order_id" class="form-label">Related Work Order (Optional)</label>
                                        <select class="form-select" id="related_order_id" name="related_order_id">
                                            <option value="">Select Work Order</option>
                                            @foreach ($orders as $order)
                                                <option value={{$order->id}}>{{$order->order_number}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Section 4: Terms & Notes -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-light">
                                <h6 class="mb-0">Additional Information</h6>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="notes" class="form-label">Notes</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="2" placeholder="Enter any specific notes about the inventory usage..." maxlength="500"></textarea>
                                    <small class="form-text text-muted">Max 500 characters</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="createRequestForm" class="btn btn-primary" id="createContractButton">
                    <i class="fas fa-save me-2"></i>Create Request
                </button>
            </div>
        </div>
    </div>
</div>



@endsection
@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
<script src="{{ asset('asset/admin/js/technical/inventory.js') }}"></script>
@endpush