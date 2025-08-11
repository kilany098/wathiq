$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#createOrderForm").on("submit", function (e) {
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
            url: "/work_order/create",
            method: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                Swal.fire({
                    title: "Success",
                    text: "The work order has been Created successfully",
                    icon: "success",
                    showCloseButton: false,
                }).then(() => {
                    $("#createOrderModal").modal("hide");
                    $("#work_order-table").DataTable().ajax.reload();
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
            url: "/contract/edit/" + id,
            method: "GET",
            dataType: "json",
            success: function (response) {
                // Populate form fields
               $("#editContractId").val(response.contract.id);
                $("#edit_client_id").val(response.contract.client_id);
                $("#edit_contract_number").val(response.contract.contract_number);
                $("#edit_title").val(response.contract.title);
                $("#edit_description").val(response.contract.description);
                $("#edit_start_date").val(response.contract.start_date);
                $("#edit_end_date").val(response.contract.end_date);
                $("#edit_total_value").val(response.contract.total_value);
                $("#edit_payment_terms").val(response.contract.payment_terms);
                $("#edit_custom_payment_terms").val(response.contract.custom_payment_terms);
                $("#edit_status").val(response.contract.status);
                $("#edit_terms_and_conditions").val(response.contract.terms_and_conditions);
                $("#edit_operated_by").val(response.contract.operated_by);
            },
            error: function (response) {
                Swal.fire({
                    title: "Error",
                    text: "There was a problem fetching contract data.",
                    icon: "error",
                    showCloseButton: false,
                });
            },
        });
    });
});