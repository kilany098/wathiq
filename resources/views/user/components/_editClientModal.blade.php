<div class="modal fade" id="editClientModal" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Update Client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editClientForm"  class="row" method="POST" >
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editClientId" name="id">
                    <div class="mb-3 col-md-12">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name">
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="contact_person" class="form-label">Contact Person</label>
                        <input type="text" class="form-control" id="edit_contact_person" name="contact_person">
                    </div>


                    <div class="mb-3 col-md-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="edit_email" name="email">
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="edit_phone" name="phone">
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="address" class="form-label">Contact Person</label>
                        <input type="text" class="form-control" id="edit_address" name="address">
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="tax_number" class="form-label">Tax Number</label>
                        <input type="text" class="form-control" id="edit_tax_number" name="tax_number">
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-control" id="edit_type" name="type">
                            <option value="" disabled>Choose Type</option>
                            <option value="individual">individual</option>
                            <option value="company">company</option>
                        </select>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" form="editClientForm" class="btn btn-primary" id="editUserButton">Update Client</button>
            </div>
        </div>
    </div>
</div>