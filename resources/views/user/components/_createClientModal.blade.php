<div class="modal fade" id="createClientModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="createUserModalLabel">Create Client</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <form id="createClientForm" action="{{route('client.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 col-md-12">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3 col-md-12">
                <label for="contact_phone" class="form-label">Contact Phone</label>
                <input type="tel" class="form-control" id="contact_phone" name="contact_phone" required maxlength="15">
            </div>

            <div class="mb-3 col-md-12">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3 col-md-12">
                <label for="phone" class="form-label">Phone</label>
                <input type="tel" class="form-control" id="phone" name="phone" required maxlength="15">
            </div>

            <div class="mb-3 col-md-12">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" required maxlength="255">
            </div>

            <div class="mb-3 col-md-12">
                <label for="type" class="form-label">Type</label>
                <select class="form-control" id="type" name="type" required>
                    <option value="" disabled selected>Choose Type</option>
                    <option value="individual">Individual</option>
                    <option value="company">Company</option>
                </select>
            </div>

            <div class="mb-3 col-md-12" id="taxNumberField" style="display: none;">
                <label for="tax_number" class="form-label">Tax Number</label>
                <input type="text" class="form-control" id="tax_number" name="tax_number" maxlength="50">
            </div>

            <div class="mb-3 col-md-12" id="comNumberField" style="display: none;">
                <label for="commercial_number" class="form-label">Commercial Number (10 digits)</label>
                <input type="text" class="form-control" id="commercial_number" name="commercial_number" 
                       required pattern="[0-9]{10}" title="Please enter exactly 10 digits">
            </div>

            <div class="mb-3 col-md-12">
                <label for="commercial_register" class="form-label">Commercial Register File (PDF, JPG, PNG, max 5MB)</label>
                <input type="file" class="form-control" id="commercial_register" name="commercial_register" 
                       accept=".pdf,.jpg,.png" required>
            </div>

            <div class="mb-3 col-md-12">
                <label for="personal_id" class="form-label">Personal ID File (PDF, JPG, PNG, max 5MB)</label>
                <input type="file" class="form-control" id="personal_id" name="personal_id" 
                       accept=".pdf,.jpg,.png" required>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" form="createClientForm" class="btn btn-primary">Create Client</button>
    </div>
</div>


    </div>
</div>
<script>
    // Show/hide tax number field based on type selection
    document.getElementById('type').addEventListener('change', function() {
        const taxNumberField = document.getElementById('taxNumberField');
        const comNumberField = document.getElementById('comNumberField');
        if (this.value === 'company') {
            taxNumberField.style.display = 'block';
            comNumberField.style.display = 'block';
            document.getElementById('tax_number').setAttribute('required', 'required');
        } else {
            taxNumberField.style.display = 'none';
            comNumberField.style.display = 'none';
            document.getElementById('tax_number').removeAttribute('required');
        }
    });
</script>