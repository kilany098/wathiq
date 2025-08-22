<div class="modal fade" id="editUserModal" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">{{__('Update User')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editUserForm" class="row" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editUserId" name="id">
                    <div class="mb-3 col-md-12">
                        <label for="first_name" class="form-label">{{__('First name')}}</label>
                        <input type="text" class="form-control" id="edit_first_name" name="first_name">
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="last_name" class="form-label">{{__('Last name')}}</label>
                        <input type="text" class="form-control" id="edit_last_name" name="last_name">
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="email" class="form-label">{{__('Email')}}</label>
                        <input type="email" class="form-control" id="edit_email" name="email">
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="phone" class="form-label">{{__('Phone')}}</label>
                        <input type="tel" class="form-control" id="edit_phone" name="phone">
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="userStatus" class="form-label">{{__('Status')}}</label>
                        <select class="form-control" id="edit_userStatus" name="status">
                            <option value="" disabled>{{__('Choose Status')}}</option>
                            <option value=1>{{__('Active')}}</option>
                            <option value=0>{{__('Not active')}}</option>
                        </select>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="role" class="form-label">{{__('Role')}}</label>
                        <select class="form-control" id="edit-role" name="role">
                            <option value="" disabled selected>{{__('Choose Role')}}</option>
                            @foreach ($roles as $role)
                            <option value={{$role->name}}>{{$role->name}}</option>
                            @endforeach
                        </select>
                        <small class="text-warning">{{__('leave it empty to keep current role')}}</small>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="password" class="form-label">{{__('Password')}}</label>
                        <input type="tel" class="form-control mb-1" id="edit_password" name="password">
                        <small class="text-warning">{{__('leave it empty to keep current password')}}</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Cancel')}}</button>
                <button type="submit" form="editUserForm" class="btn btn-primary" id="editUserButton">{{__('Update User')}}</button>
            </div>
        </div>
    </div>
</div>