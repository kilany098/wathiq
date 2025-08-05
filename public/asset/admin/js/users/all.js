$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#createUserForm").on("submit", function (e) {
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
                    text: "The user has been Created successfully",
                    icon: "success",
                    showCloseButton: false,
                }).then(() => {
                    $("#createUserModal").modal("hide");
                    $("#user-table").DataTable().ajax.reload();
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
            url: "/users/edit/" + id,
            method: "GET",
            dataType: "json",
            success: function (response) {
                // Populate form fields
                $("#editUserId").val(response.user.id);
                $("#edit_name").val(response.user.name);
                $("#edit_email").val(response.user.email);
                $("#edit_phone").val(response.user.phone);
                $("#edit_userStatus").val(response.user.is_active);
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

    $("#editUserForm").on("submit", function (e) {
        e.preventDefault();
        let id = $("#editUserId").val();
        var formData = new FormData(this);

        $.ajax({
            url: "/users/update/" + id,
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
                        text: "The user has been Updated successfully",
                        icon: "success",
                        showCloseButton: false,
                    }).then(() => {
                        $("#editUserModal").modal("hide");
                        $("#user-table").DataTable().ajax.reload();
                    });
                }
            },
            error: function (xhr) {},
        });
    });

    $(".delete-form").on("submit", function (e) {
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
                        if (response) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "The user has been deleted.",
                                icon: "success",
                                showCloseButton: false,
                            }).then(() => {
                                $("#user-table").DataTable().ajax.reload();
                            });
                        }
                    },
                    error: function (response) {
                        Swal.fire({
                            title: "Error!",
                            text: "Failed to delete user",
                            icon: "error",
                        });
                    },
                });
            }
        });
    });
});
