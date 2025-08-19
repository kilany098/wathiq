 document.getElementById('client_id').addEventListener('change', function() {
    const clientId = this.value;
    const contractSelect = document.getElementById('contract_id');
    const branchSelect = document.getElementById('branch_id');
    if (!clientId) {
        contractSelect.innerHTML = '<option value="" disabled selected>Select Contract</option>';
        branchSelect.innerHTML = '<option value="" disabled selected>Select Branch</option>';
        return;
    }
    // Fetch contracts for selected client
    fetch(`/urgent_order/contracts?client_id=${clientId}`)
        .then(response => response.json())
        .then(data => {
            contractSelect.innerHTML = '<option value="" disabled selected>Select Contract</option>';
            data.forEach(contract => {
                const option = document.createElement('option');
                option.value = contract.id;
                option.textContent = contract.contract_number;
                contractSelect.appendChild(option);
            });
        });
         // Fetch zones for selected city
    fetch(`/urgent_order/branches?client_id=${clientId}`)
        .then(response => response.json())
        .then(data => {
            branchSelect.innerHTML = '<option value="" disabled selected>Select Branch</option>';
            data.forEach(branch => {
                const option = document.createElement('option');
                option.value = branch.id;
                option.textContent = branch.name;
                branchSelect.appendChild(option);
            });
        });
});
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
            url: "/urgent_order/create",
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
                    location.reload();
                });
            },
            error: function (xhr) {
                console.log(xhr.responseText);
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