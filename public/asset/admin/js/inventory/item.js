$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#createItemForm").on("submit", function (e) {
        e.preventDefault();
        $(".invalid-feedback").remove();
        $(".is-invalid").removeClass("is-invalid");

        var submitButton = $("#createUserButton");
        var originalButtonHtml = submitButton.html();

        submitButton.prop("disabled", true);
        submitButton.html(
            '<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span>Loading...'
        );

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
                    text: "The item has been Created successfully",
                    icon: "success",
                    showCloseButton: false,
                }).then(() => {
                    $("#createItemModal").modal("hide");
                    $("#item-table").DataTable().ajax.reload();
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
                submitButton.html(originalButtonHtml).prop("disabled", false);
            },
        });
    });


$(document).on("click", ".update-user", function (e) {
        let id = $(this).data("id");

        $.ajax({
            url: "/item/edit/" + id,
            method: "GET",
            dataType: "json",
            success: function (response) {
                // Populate form fields
                $("#editItemId").val(response.item.id);
                $("#edit_name").val(response.item.name);
                $("#edit_code").val(response.item.code);
                $("#edit_category_id").val(response.item.category_id);
                $("#edit_description").val(response.item.description);
                $("#edit_quantity").val(response.item.quantity);

                $("#editItemModal").modal("show");
            },
            error: function (response) {
                Swal.fire({
                    title: "Error",
                    text: "There was a problem fetching item data.",
                    icon: "error",
                    showCloseButton: false,
                });
            },
        });
    });


$("#editItemForm").on("submit", function (e) {
        e.preventDefault();
        let id = $("#editItemId").val();
        var formData = new FormData(this);

        $.ajax({
            url: "/item/update/" + id,
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
                        text: "The item has been Updated successfully",
                        icon: "success",
                        showCloseButton: false,
                    }).then(() => {
                        $("#editItemModal").modal("hide");
                        $("#item-table").DataTable().ajax.reload();
                    });
                }
            },
            error: function (xhr) {},
        });
    });

$("#item-table").on("submit", ".delete-form", function (e) {
        e.preventDefault();

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                let url = $(this).attr("action");
                $.ajax({
                    url: url,
                    type: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    success: function (response) {
                            Swal.fire({
                                title: "Deleted!",
                                text: response.message,
                                icon: "success",
                                showCloseButton: false,
                            }).then(() => {
                                $("#item-table").DataTable().ajax.reload();
                            });
                        
                    },
                    error: function (response) {
                        Swal.fire({
                            title: "Error!",
                            text: "Failed to delete warehouse",
                            icon: "error",
                        });
                    },
                });
            }
        });
    });

});