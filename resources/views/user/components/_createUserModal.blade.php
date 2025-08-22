<div class="modal fade" id="createUserModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header ">
                <h5 class="modal-title" id="createUserModalLabel">{{__('Create User')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createUserForm" action="{{ route('users.create') }}" class="row" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3 col-md-12">
                        <label for="first_name" class="form-label">{{__('First name')}}</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="last_name" class="form-label">{{__('Last name')}}</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="email" class="form-label">{{__('Email')}}</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="phone" class="form-label">{{__('Phone')}}</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="role" class="form-label">{{__('Role')}}</label>
                        <select class="form-control" id="role" name="role" required>
                            <option value="" disabled selected>{{__('Choose Role')}}</option>
                            @foreach ($roles as $role)
                            <option value={{$role->name}}>{{$role->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="password" class="form-label">{{__('Password')}}</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                        <small class="text-warning">{{__('Password must be at least 8 characters long.')}}</small>
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="password_confirmation" class="form-label">{{__('Confirm Password')}}</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Cancel')}}</button>
                <button type="submit" form="createUserForm" class="btn btn-primary" id="createUserButton">{{__('Create User')}}</button>
            </div>
        </div>
    </div>
</div>