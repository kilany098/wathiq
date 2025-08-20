document.getElementById('item_id').addEventListener('change', function() {
    const itemId = this.value;
    const warehouseSelect = document.getElementById('warehouse_id');
    if (!itemId) {
        warehouseSelect.innerHTML = '<option value="" disabled selected>Select Warehouse</option>';
        return;
    }
    // Fetch contracts for selected client
    fetch(`/my_items/warehouse?item_id=${itemId}`)
        .then(response => response.json())
        .then(data => {
            warehouseSelect.innerHTML = '<option value="" disabled selected>Select Warehouse</option>';
            data.forEach(warehouse => {
                const option = document.createElement('option');
                option.value = warehouse.id;
                option.textContent = warehouse.name;
                warehouseSelect.appendChild(option);
            });
        });
    });
    $(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#createRequestForm").on("submit", function (e) {
        e.preventDefault();

        // Create FormData for file upload support
        var formData = new FormData(this);

        $.ajax({
            url: $(this).attr("action"),
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                Swal.fire({
                    title: "Success",
                    text: "The request has been Send successfully",
                    icon: "success",
                    showCloseButton: false,
                }).then(() => {
                    $('#createRequestForm')[0].reset();
                    $("#createRequestModal").modal("hide");
                });
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        var inputField = $(`[name="${key}"]`);
                        inputField.addClass("is-invalid");
                        inputField.after(
                            `<div class="invalid-feedback">${value[0]}</div>`
                        );
                    });
                } else {
                    Swal.fire({
                        title: "Error",
                        text: "An unexpected error occurred. Please try again later",
                        icon: "error",
                        confirmButtonText: "OK",
                    });
                }
            },
            complete: function () {
                // Reset the button after completion
              
            },
        });
    });
    });