<!-- Vendor js -->
<script src="{{ asset('asset/admin/js/vendor.min.js') }}"></script>

<!-- App js -->
<script src="{{ asset('asset/admin/js/app.js') }}"></script>

<!-- Theme Config Js -->
<script src="{{ asset('asset/admin/js/config.js') }}"></script>

<!-- Apex Chart js -->
{{-- <script src="{{ asset('asset/admin/vendor/apexcharts/apexcharts.min.js') }}"></script> --}}

<!-- Projects Analytics Dashboard App js -->
{{-- <script src="{{ asset('asset/admin/js/pages/dashboard.js') }}"></script> --}}

<!-- Datatable -->
<script src="//cdn.datatables.net/2.3.1/js/dataTables.min.js"></script>

<!-- Sweet Alerts js -->
<script src="{{ asset('asset/admin/vendor/sweetalert2/sweetalert2.min.js') }}"></script>

{{-- delete function --}}
<script>
    function deleteFunction(dataTableId) {
        $(document).on('submit', '.delete-form', function(e) {
            e.preventDefault();
            var form = this;
            Swal.fire({
                title: 'Are you sure?',
                text: 'You wont be able to revert this',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "Cancel",
                showCloseButton: false
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: $(form).attr('action'),
                        method: 'POST',
                        data: $(form).serialize(),
                        success: function(response) {
                            Swal.fire({
                                title: "Success",
                                text: response.message || 'Deleted successfully',
                                icon: 'success',
                                showCloseButton: false
                            }).then(() => {
                                var table = $(dataTableId).DataTable();
                                table.ajax.reload(null, false);
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire({
                                title: "Error",
                                text: xhr.responseJSON.error || "There was a problem deleting the Attachment",
                                icon: 'error',
                                showCloseButton: false
                            });
                        }
                    });
                }
            });
        });
    }
</script>

@stack('scripts')