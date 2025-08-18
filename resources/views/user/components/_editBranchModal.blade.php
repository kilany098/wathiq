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
                    
                    <input type="hidden" name="client_id" value="{{ $client->id ?? '' }}">

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

                    <div class="col-md-12 mb-3">
                            <label for="name" class="form-label">Branch Name*</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
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

                    <div class="mb-3 col-md-6">
                        <label for="edit_status" class="form-label">Status</label>
                        <select class="form-control" id="edit_status" name="status">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="edit_map_link" class="form-label">Map Link*</label>
                        <input type="url" class="form-control" id="edit_map_link" name="map_link" 
                               required placeholder="https://maps.google.com/...">
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
