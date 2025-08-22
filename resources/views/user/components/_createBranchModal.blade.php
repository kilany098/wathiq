<div class="modal fade" id="createBranchModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createBranchModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createBranchModalLabel">{{__('Create Branch')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{__('Close')}}"></button>
            </div>
            <div class="modal-body">
                <form id="createBranchForm" action="{{route('branch.create')}}" method="POST">
                    @csrf
                    
                    <!-- Hidden client_id if needed -->
                    <input type="hidden" name="client_id" value="{{ $client->id ?? '' }}">
                    
                    <div class="row">
                        <!-- Manager Information -->
                        <div class="col-md-6 mb-3">
                            <label for="manager_name" class="form-label">{{__('Manager Name')}}*</label>
                            <input type="text" class="form-control" id="manager_name" name="manager_name" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="manager_phone" class="form-label">{{__('Manager Phone')}}*</label>
                            <input type="tel" class="form-control" id="manager_phone" name="manager_phone" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">{{__('Branch Name')}}*</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>

                        <!-- Location Information -->
                        <div class="col-md-6 mb-3">
                            <label for="city_id" class="form-label">{{__('City')}}*</label>
                            <select class="form-control" id="city_id" name="city_id" required>
                                <option value="" disabled selected>{{__('Select City')}}</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label for="zone_id" class="form-label">{{__('Zone')}}*</label>
                            <select class="form-control" id="zone_id" name="zone_id" required>
                                <option value="" disabled selected>{{__('Select Zone')}}</option>
                                <!-- Zones will be loaded via AJAX based on city selection -->
                            </select>
                        </div>
                        
                        <div class="col-12 mb-3">
                            <label for="map_link" class="form-label">{{__('Map Link')}}*</label>
                            <input type="url" class="form-control" id="map_link" name="map_link" required placeholder="https://maps.google.com/...">
                        </div>
                        
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Cancel')}}</button>
                <button type="submit" form="createBranchForm" class="btn btn-primary">{{__('Create Branch')}}</button>
            </div>
        </div>
    </div>
</div>