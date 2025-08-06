$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#createWareForm").on("submit", function (e) {
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
                    text: "The warehouse has been Created successfully",
                    icon: "success",
                    showCloseButton: false,
                }).then(() => {
                    $("#createWarehouseModal").modal("hide");
                    $("#warehouse-table").DataTable().ajax.reload();
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




});