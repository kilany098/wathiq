<div class="modal fade" id="editClientModal" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Update Client</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editClientForm" class="row" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="editClientId" name="id">
                    
                    <div class="mb-3 col-md-12">
                        <label for="edit_name" class="form-label">Name*</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required maxlength="255">
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="edit_contact_phone" class="form-label">Contact Phone* (Saudi format)</label>
                        <input type="tel" class="form-control" id="edit_contact_phone" name="contact_phone" 
                               required maxlength="15" pattern="^(009665|9665|\+9665|05|5)([0-9]{8})$"
                               title="Please enter a valid Saudi phone number (e.g., 05XXXXXXXX or +9665XXXXXXXX)">
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="edit_email" class="form-label">Email*</label>
                        <input type="email" class="form-control" id="edit_email" name="email" required>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="edit_phone" class="form-label">Phone*</label>
                        <input type="tel" class="form-control" id="edit_phone" name="phone" required>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="edit_type" class="form-label">Type*</label>
                        <select class="form-control" id="edit_type" name="type" required>
                            <option value="" disabled selected>Choose Type</option>
                            <option value="individual">Individual</option>
                            <option value="company">Company</option>
                        </select>
                    </div>

                    <div class="mb-3 col-md-12" id="edit_tax_number_container" style="display: none;">
                        <label for="edit_tax_number" class="form-label">Tax Number</label>
                        <input type="text" class="form-control" id="edit_tax_number" name="tax_number" maxlength="50">
                    </div>

                    <div class="mb-3 col-md-12" id="edit_commercial_number_container" style="display: none;">
                        <label for="edit_commercial_number" class="form-label">Commercial Number (10 digits)</label>
                        <input type="text" class="form-control" id="edit_commercial_number" name="commercial_number" 
                               pattern="[0-9]{10}" title="Please enter exactly 10 digits">
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="edit_status" class="form-label">Status*</label>
                        <select class="form-control" id="edit_status" name="status" required>
                            <option value="" disabled selected>Select Status</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="edit_commercial_register" class="form-label">Commercial Register File (PDF, JPG, PNG, max 5MB)</label>
                        <input type="file" class="form-control" id="edit_commercial_register" name="commercial_register" 
                               accept=".pdf,.jpg,.png">
                        <small class="text-muted">Leave empty to keep existing file</small>
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="edit_personal_id" class="form-label">Personal ID File (PDF, JPG, PNG, max 5MB)</label>
                        <input type="file" class="form-control" id="edit_personal_id" name="personal_id" 
                               accept=".pdf,.jpg,.png">
                        <small class="text-muted">Leave empty to keep existing file</small>
                    </div>

                      <div class="mb-3 col-md-12">
                        <label for="edit_national_address" class="form-label">National Address File (PDF, JPG, PNG, max 5MB)</label>
                        <input type="file" class="form-control" id="edit_national_address" name="national_address" 
                               accept=".pdf,.jpg,.png">
                        <small class="text-muted">Leave empty to keep existing file</small>
                    </div>

                      <div class="mb-3 col-md-12">
                        <label for="edit_IBAN_number" class="form-label">IBAN Number File (PDF, JPG, PNG, max 5MB)</label>
                        <input type="file" class="form-control" id="edit_IBAN_number" name="IBAN_number" 
                               accept=".pdf,.jpg,.png">
                        <small class="text-muted">Leave empty to keep existing file</small>
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

<script>
    // Show/hide fields based on client type
    document.getElementById('edit_type').addEventListener('change', function() {
        const isCompany = this.value === 'company';
        document.getElementById('edit_tax_number_container').style.display = isCompany ? 'block' : 'none';
        document.getElementById('edit_commercial_number_container').style.display = isCompany ? 'block' : 'none';
        
        if (isCompany) {
            document.getElementById('edit_tax_number').setAttribute('required', 'required');
            document.getElementById('edit_commercial_number').setAttribute('required', 'required');
        } else {
            document.getElementById('edit_tax_number').removeAttribute('required');
            document.getElementById('edit_commercial_number').removeAttribute('required');
        }
    });
</script>