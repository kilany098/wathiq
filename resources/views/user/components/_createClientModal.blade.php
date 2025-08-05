<div class="modal fade" id="createClientModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createUserModalLabel">Create Client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createClientForm" action="{{route('client.create') }}" method="POST">
                    @csrf
                    <div class="mb-3 col-md-12">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="contact_person" class="form-label">Contact</label>
                        <input type="text" class="form-control" id="contact_person" name="contact_person" required>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="phone" name="phone" required>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="tax_number" class="form-label">Tax Number</label>
                        <input type="text" class="form-control" id="tax_number" name="tax_number" required>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="role" class="form-label">Type</label>
                        <select class="form-control" id="type" name="type" required>
                            <option value="" disabled selected>Choose Type</option>
                            <option value="individual">individual</option>
                            <option value="company">company</option>
                        </select>
                    </div>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="createClientForm" class="btn btn-primary" >Create Client</button>
            </div>
        </div>
    </div>
</div>