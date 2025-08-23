$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#createEmployeeForm").on("submit", function (e) {
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
                    text: "The contract has been Created successfully",
                    icon: "success",
                    showCloseButton: false,
                }).then(() => {
                    $("#createEmployeeModal").modal("hide");
                    $("#employee_info-table").DataTable().ajax.reload();
                    $('#createEmployeeForm')[0].reset();
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
            url: "/hr/edit/" + id,
            method: "GET",
            dataType: "json",
            success: function (response) {
                // Populate form fields
                $("#editEmployeeId").val(response.employee.id);
                $("#edit_hire_date").val(response.employee.hire_date);
                $("#edit_termination_date").val(response.employee.termination_date);
                $("#edit_salary").val(response.employee.salary);
                $("#edit_emergency_contact").val(response.employee.emergency_contact);
                $("#edit_emergency_phone").val(response.employee.emergency_phone);
                $("#edit_notes").val(response.employee.notes);
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

$("#editEmployeeForm").on("submit", function (e) {
        e.preventDefault();
        let id = $("#editEmployeeId").val();
        var formData = new FormData(this);

        $.ajax({
            url: "/hr/update/" + id,
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
                        text: "The employee has been Updated successfully",
                        icon: "success",
                        showCloseButton: false,
                    }).then(() => {
                        $("#editEmployeeModal").modal("hide");
                        $("#employee_info-table").DataTable().ajax.reload();
                    });
                }
            },
            error: function (xhr) {},
        });
    });


});