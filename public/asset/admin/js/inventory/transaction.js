$(document).ready(function() {
    // Show/hide destination warehouse based on transaction type
    $('#transaction_type').change(function() {
        if ($(this).val() === 'transfer') {
            $('#warehouse-to-group').show();
            $('#warehouse_to').prop('required', true);
        } else {
            $('#warehouse-to-group').hide();
            $('#warehouse_to').prop('required', false);
        }
    });

    // Handle form submission
    $('#createTransactionForm').submit(function(e) {
        e.preventDefault();
        
        // Clear previous messages
        $('#response-message').hide().removeClass('alert-success alert-danger');
        
        // Get form data
        var formData = $(this).serialize();
        
        // Show loading state
        var submitButton = $(this).find('button[type="submit"]');
        submitButton.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Processing...');
        
        // Send AJAX request
        $.ajax({
            url: "/transaction/create",
            type: "POST",
            data: formData,
            dataType: 'json',
            success: function(response) {
                Swal.fire({
                    title: "Success",
                    text: "The transaction has been Created successfully",
                    icon: "success",
                    showCloseButton: false,
                }).then(() => {
                
                // Reset form if needed
                $('#createTransactionForm')[0].reset();
                $('#warehouse-to-group').hide();
                $("#createTransactionModal").modal("hide");
                $("#transaction-table").DataTable().ajax.reload();
                });
                // You might want to update your UI with the new transaction
                // For example, add to a transactions table
            },
            error: function(xhr) {
                var errorMessage = 'An error occurred. Please try again.';
                
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                    
                    if (xhr.responseJSON.available_quantity) {
                        errorMessage += ' Available quantity: ' + xhr.responseJSON.available_quantity;
                    }
                }
                 Swal.fire({
                        title: "Error",
                        text: errorMessage,
                        icon: "error",
                        confirmButtonText: "OK",
                    });
            },
            complete: function() {
                submitButton.prop('disabled', false).html('Submit Transaction');
            }
        });
    });
});