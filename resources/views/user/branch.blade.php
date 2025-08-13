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

<div class="modal fade" id="createBranchModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createBranchModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createBranchModalLabel">Create Branch</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createBranchForm" action="{{route('branch.create')}}" method="POST">
                    @csrf
                    
                    <!-- Hidden client_id if needed -->
                    <input type="hidden" name="client_id" value="{{ $client->id ?? '' }}">
                    
                    <div class="row">
                        <!-- Manager Information -->
                        <div class="col-md-6 mb-3">
                            <label for="manager_name" class="form-label">Manager Name*</label>
                            <input type="text" class="form-control" id="manager_name" name="manager_name" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="manager_phone" class="form-label">Manager Phone*</label>
                            <input type="tel" class="form-control" id="manager_phone" name="manager_phone" required>
                        </div>
                        
                        <!-- Location Information -->
                        <div class="col-md-6 mb-3">
                            <label for="city_id" class="form-label">City*</label>
                            <select class="form-control" id="city_id" name="city_id" required>
                                <option value="" disabled selected>Select City</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="zone_id" class="form-label">Zone*</label>
                            <select class="form-control" id="zone_id" name="zone_id" required>
                                <option value="" disabled selected>Select Zone</option>
                                <!-- Zones will be loaded via AJAX based on city selection -->
                            </select>
                        </div>
                        
                        <div class="col-12 mb-3">
                            <label for="map_link" class="form-label">Map Link*</label>
                            <input type="url" class="form-control" id="map_link" name="map_link" required placeholder="https://maps.google.com/...">
                        </div>
                        
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="createBranchForm" class="btn btn-primary">Create Branch</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for dynamic zone loading -->
<script>
document.getElementById('city_id').addEventListener('change', function() {
    const cityId = this.value;
    const zoneSelect = document.getElementById('zone_id');
    
    if (!cityId) {
        zoneSelect.innerHTML = '<option value="" disabled selected>Select Zone</option>';
        return;
    }
    
    // Fetch zones for selected city
    fetch(`/client/zones?city_id=${cityId}`)
        .then(response => response.json())
        .then(data => {
            zoneSelect.innerHTML = '<option value="" disabled selected>Select Zone</option>';
            data.forEach(zone => {
                const option = document.createElement('option');
                option.value = zone.id;
                option.textContent = zone.name;
                zoneSelect.appendChild(option);
            });
        });
});
</script>

<div class="modal fade" id="editBranchModal" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editBranchModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBranchModalLabel">Update Branch</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editBranchForm" class="row" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editBranchId" name="id">
                    
                    <div class="mb-3 col-md-6">
                        <label for="edit_manager_name" class="form-label">Manager Name*</label>
                        <input type="text" class="form-control" id="edit_manager_name" name="manager_name" required>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="edit_manager_phone" class="form-label">Manager Phone*</label>
                        <input type="tel" class="form-control" id="edit_manager_phone" name="manager_phone" 
                               required pattern="^(009665|9665|\+9665|05|5)([0-9]{8})$"
                               title="Saudi number format: 05XXXXXXXX or +9665XXXXXXXX">
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="edit_city_id" class="form-label">City*</label>
                        <select class="form-control" id="edit_city_id" name="city_id" required>
                            <option value="" disabled>Select City</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="edit_zone_id" class="form-label">Zone*</label>
                        <select class="form-control" id="edit_zone_id" name="zone_id" required>
                            <option value="" disabled>Select Zone</option>
                        </select>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="edit_map_link" class="form-label">Map Link*</label>
                        <input type="url" class="form-control" id="edit_map_link" name="map_link" 
                               required placeholder="https://maps.google.com/...">
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="edit_status" class="form-label">Status</label>
                        <select class="form-control" id="edit_status" name="status">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="editBranchForm" class="btn btn-primary" id="editBranchButton">Update Branch</button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Dynamic Zone Loading -->
<script>
document.getElementById('edit_city_id').addEventListener('change', function() {
    const cityId = this.value;
    const zoneSelect = document.getElementById('edit_zone_id');
    
    if (!cityId) {
        zoneSelect.innerHTML = '<option value="" disabled>Select Zone</option>';
        return;
    }
    
    fetch(`/client/zones?city_id=${cityId}`)
        .then(response => response.json())
        .then(data => {
            zoneSelect.innerHTML = '<option value="" disabled>Select Zone</option>';
            data.forEach(zone => {
                const option = document.createElement('option');
                option.value = zone.id;
                option.textContent = zone.name;
                zoneSelect.appendChild(option);
            });
            
            // Set previously selected zone if available
            if (window.preSelectedZoneId) {
                zoneSelect.value = window.preSelectedZoneId;
            }
        });
});
</script>


@endsection
@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
<script src="{{ asset('asset/admin/js/users/branch.js') }}"></script>
@endpush