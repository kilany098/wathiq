document.getElementById('city_id').addEventListener('change', function() {
    const cityId = this.value;
    const zoneSelect = document.getElementById('zone_id');
    
    if (!cityId) {
        zoneSelect.innerHTML = '<option value="" disabled selected>Select Zone</option>';
        return;
    }
    
    // Fetch zones for selected city
    fetch(`/client/zones?city_id=${cityId}`)
        .then(response => response.json())
        .then(data => {
            zoneSelect.innerHTML = '<option value="" disabled selected>Select Zone</option>';
            data.forEach(zone => {
                const option = document.createElement('option');
                option.value = zone.id;
                option.textContent = zone.name;
                zoneSelect.appendChild(option);
            });
        });
});
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#createBranchForm").on("submit", function (e) {
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
                    text: "The branch has been Created successfully",
                    icon: "success",
                    showCloseButton: false,
                }).then(() => {
                    $('#createBranchForm')[0].reset();
                    $("#createBranchModal").modal("hide");
                    $("#branch-table").DataTable().ajax.reload();
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
            url: "/client/branches/edit/" + id,
            method: "GET",
            dataType: "json",
            success: function (response) {
                // Populate form fields
                $("#editBranchId").val(response.branch.id);
                $("#edit_manager_name").val(response.branch.manager_name);
                $("#edit_manager_phone").val(response.branch.manager_phone);
                $("#edit_visit_price").val(response.branch.visit_price);
                $("#edit_name").val(response.branch.name);
                $("#edit_city_id").val(response.branch.city_id);
                $("#edit_map_link").val(response.branch.map_link);
                $("#edit_status").val(response.branch.status);

  const cityId = response.branch.city_id;
    const zoneSelect = document.getElementById('edit_zone_id');
    
    if (!cityId) {
        zoneSelect.innerHTML = '<option value="" disabled>Select Zone</option>';
        return;
    }
    
    fetch(`/client/zones?city_id=${cityId}`)
        .then(response => response.json())
        .then(data => {
            zoneSelect.innerHTML = '<option value="" disabled>Select Zone</option>';
            data.forEach(zone => {
                const option = document.createElement('option');
                option.value = zone.id;
                option.textContent = zone.name;
                zoneSelect.appendChild(option);
            });
            
            // Set previously selected zone if available
            if (response.branch.zone_id) {
                zoneSelect.value = response.branch.zone_id;
            }
        });
            },
            error: function (response) {
                Swal.fire({
                    title: "Error",
                    text: "There was a problem fetching branch data.",
                    icon: "error",
                    showCloseButton: false,
                });
            },
        });
    });

$("#editBranchForm").on("submit", function (e) {
        e.preventDefault();
        let id = $("#editBranchId").val();
        var formData = new FormData(this);

        $.ajax({
            url: "/client/branches/update/" + id,
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
                        $("#editBranchModal").modal("hide");
                        $("#branch-table").DataTable().ajax.reload();
                    });
                }
            },
            error: function (xhr) {},
        });
    });

});