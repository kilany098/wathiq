<div class="modal fade" id="createClientModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title" id="createUserModalLabel">{{__('Create Client')}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{__('Close')}}"></button>
    </div>
    <div class="modal-body">
        <form id="createClientForm" action="{{route('client.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 col-md-12">
                <label for="name" class="form-label">{{__('Name')}}</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3 col-md-12">
                <label for="contact_phone" class="form-label">{{__('Contact Phone')}}</label>
                <input type="tel" class="form-control" id="contact_phone" name="contact_phone" required maxlength="15">
            </div>

            <div class="mb-3 col-md-12">
                <label for="email" class="form-label">{{__('Email')}}</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3 col-md-12">
                <label for="phone" class="form-label">{{__('Phone')}}</label>
                <input type="tel" class="form-control" id="phone" name="phone" required maxlength="15">
            </div>

            <div class="mb-3 col-md-12">
                <label for="type" class="form-label">{{__('Type')}}</label>
                <select class="form-control" id="type" name="type" required>
                    <option value="" disabled selected>{{__('Choose Type')}}</option>
                    <option value="individual">{{__('Individual')}}</option>
                    <option value="company">{{__('Company')}}</option>
                </select>
            </div>

            <div class="mb-3 col-md-12" id="taxNumberField" style="display: none;">
                <label for="tax_number" class="form-label">{{__('Tax Number')}}</label>
                <input type="text" class="form-control" id="tax_number" name="tax_number" maxlength="50">
            </div>

            <div class="mb-3 col-md-12" id="comNumberField" style="display: none;">
                <label for="commercial_number" class="form-label">{{__('Commercial Number (10 digits)')}}</label>
                <input type="text" class="form-control" id="commercial_number" name="commercial_number" 
                        pattern="[0-9]{10}" title="{{__('Please enter exactly 10 digits')}}">
            </div>

            <div class="mb-3 col-md-12">
                <label for="commercial_register" class="form-label">{{__('Commercial Register File (PDF, JPG, PNG, max 5MB)')}}</label>
                <input type="file" class="form-control" id="commercial_register" name="commercial_register" 
                       accept=".pdf,.jpg,.png" required>
            </div>

            <div class="mb-3 col-md-12">
                <label for="personal_id" class="form-label">{{__('Personal ID File (PDF, JPG, PNG, max 5MB)')}}</label>
                <input type="file" class="form-control" id="personal_id" name="personal_id" 
                       accept=".pdf,.jpg,.png" required>
            </div>

            <div class="mb-3 col-md-12">
                <label for="national_address" class="form-label">{{__('National Address File (PDF, JPG, PNG, max 5MB)')}}</label>
                <input type="file" class="form-control" id="national_address" name="national_address" 
                       accept=".pdf,.jpg,.png" required>
            </div>

            <div class="mb-3 col-md-12">
                <label for="IBAN_number" class="form-label">{{__('IBAN Number File (PDF, JPG, PNG, max 5MB)')}}</label>
                <input type="file" class="form-control" id="IBAN_number" name="IBAN_number" 
                       accept=".pdf,.jpg,.png" required>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Cancel')}}</button>
        <button type="submit" form="createClientForm" class="btn btn-primary">{{__('Create Client')}}</button>
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