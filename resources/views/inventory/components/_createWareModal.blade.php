<div class="modal fade" id="createWarehouseModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">Create Warehouse</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createWareForm" action="{{ route('warehouse.create') }}" class="row" method="POST" >
                    @csrf
                    <div class="mb-3 col-md-12">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" id="location" name="location" required>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="manager_id" class="form-label">Manager</label>
                        <select class="form-control" id="manager_id" name="manager_id" required>
                            <option value="" disabled selected>Choose a manager</option>
                            @foreach ($managers as $manager)
                            <option value={{$manager->id}}>{{$manager->full_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3 col-md-12">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" class="form-control" id="description" name="description" required>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="createWareForm" class="btn btn-primary" id="createUserButton">Create Warehouse</button>
            </div>
        </div>
    </div>
</div>