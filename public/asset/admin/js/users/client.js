$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#createClientForm").on("submit", function (e) {
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
                    text: "The client has been Created successfully",
                    icon: "success",
                    showCloseButton: false,
                }).then(() => {
                    $('#createClientForm')[0].reset();
                    $("#createClientModal").modal("hide");
                    $("#client-table").DataTable().ajax.reload();
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

$(document).on("click", ".update-user", function (e) {
        let id = $(this).data("id");

        $.ajax({
            url: "/client/edit/" + id,
            method: "GET",
            dataType: "json",
            success: function (response) {
                // Populate form fields
                $("#editClientId").val(response.client.id);
                $("#edit_name").val(response.client.name);
                $("#edit_contact_person").val(response.client.contact_person);
                $("#edit_email").val(response.client.email);
                $("#edit_phone").val(response.client.phone);
                $("#edit_address").val(response.client.address);
                $("#edit_tax_number").val(response.client.tax_number);
                $("#edit_type").val(response.client.type);
                $("#edit_contact_phone").val(response.client.contact_phone);
                $("#edit_status").val(response.client.status);
                $("#edit_commercial_number").val(response.client.commercial_number);

                $("#editUserModal").modal("show");
            },
            error: function (response) {
                Swal.fire({
                    title: "Error",
                    text: "There was a problem fetching user data.",
                    icon: "error",
                    showCloseButton: false,
                });
            },
        });
    });

$("#editClientForm").on("submit", function (e) {
        e.preventDefault();
        let id = $("#editClientId").val();
        var formData = new FormData(this);

        $.ajax({
            url: "/client/update/" + id,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response) {
                    Swal.fire({
                        title: "Success",
                        text: "The client has been Updated successfully",
                        icon: "success",
                        showCloseButton: false,
                    }).then(() => {
                        $("#editClientModal").modal("hide");
                        $("#client-table").DataTable().ajax.reload();
                    });
                }
            },
            error: function (xhr) {},
        });
    });



});