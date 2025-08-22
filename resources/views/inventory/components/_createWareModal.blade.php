<div class="modal fade" id="createWarehouseModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">{{__('Create Warehouse')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{__('Close')}}"></button>
            </div>
            <div class="modal-body">
                <form id="createWareForm" action="{{ route('warehouse.create') }}" class="row" method="POST" >
                    @csrf
                    <div class="mb-3 col-md-12">
                        <label for="name" class="form-label">{{__('Name')}}</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="location" class="form-label">{{__('Location')}}</label>
                        <input type="text" class="form-control" id="location" name="location" required>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="manager_id" class="form-label">{{__('Manager')}}</label>
                        <select class="form-control" id="manager_id" name="manager_id" required>
                            <option value="" disabled selected>{{__('Choose a manager')}}</option>
                            @foreach ($managers as $manager)
                            <option value={{$manager->id}}>{{$manager->full_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3 col-md-12">
                        <label for="description" class="form-label">{{__('Description')}}</label>
                        <input type="text" class="form-control" id="description" name="description" required>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Cancel')}}</button>
                <button type="submit" form="createWareForm" class="btn btn-primary" id="createUserButton">{{__('Create Warehouse')}}</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editWareModal" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">{{__('Update Warehouse')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{__('Close')}}"></button>
            </div>
            <div class="modal-body">
                <form id="editWareForm" class="row" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editWareId" name="id">
                    <div class="mb-3 col-md-12">
                        <label for="name" class="form-label">{{__('Name')}}</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="location" class="form-label">{{__('Location')}}</label>
                        <input type="text" class="form-control" id="edit_location" name="location" required>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="manager_id" class="form-label">{{__('Manager')}}</label>
                        <select class="form-control" id="edit_manager_id" name="manager_id" required>
                            <option value="" disabled selected>{{__('Choose a manager')}}</option>
                            @foreach ($managers as $manager)
                            <option value={{$manager->id}}>{{$manager->full_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="mb-3 col-md-12">
                        <label for="description" class="form-label">{{__('Description')}}</label>
                        <input type="text" class="form-control" id="edit_description" name="description" required>
                    </div>

                   <div class="mb-3 col-md-12">
                        <label for="status" class="form-label">{{__('Status')}}</label>
                        <select class="form-control" id="edit_Status" name="status">
                            <option value="" disabled>{{__('Choose Status')}}</option>
                            <option value=1>{{__('Active')}}</option>
                            <option value=0>{{__('Not active')}}</option>
                        </select>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Cancel')}}</button>
                <button type="submit" form="editWareForm" class="btn btn-primary" id="editUserButton">{{__('Update Warehouse')}}</button>
            </div>
        </div>
    </div>
</div>