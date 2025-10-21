jQuery(document).ready(function () {

    // Create Job Role
    $("#create").click(function (event) {
        event.preventDefault();

        if (!$('#title').val() || $('#title').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter job role name",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else {
            $('.someBlock').preloader();

            var formData = new FormData($("#form-data")[0]);
            formData.append('create', true);

            $.ajax({
                url: "ajax/php/job_role.php",
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (result) {
                    $('.someBlock').preloader('remove');

                    if (result.status === 'success') {
                        swal({
                            title: "Success!",
                            text: "Job role added successfully!",
                            type: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });

                        window.setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                    } else {
                        swal({
                            title: "Error!",
                            text: "Something went wrong.",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                }
            });
        }
        return false;
    });

    // Update Job Role
    $("#update").click(function (event) {
        event.preventDefault();

        if (!$('#name').val() || $('#name').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter job role name",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
        } else {
            $('.someBlock').preloader();

            var formData = new FormData($("#form-data")[0]);
            formData.append('update', true);

            $.ajax({
                url: "ajax/php/job_role.php",
                type: 'POST',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function (result) {
                    $('.someBlock').preloader('remove');

                    if (result.status === 'success') {
                        swal({
                            title: "Success!",
                            text: "Job role updated successfully!",
                            type: 'success',
                            timer: 2500,
                            showConfirmButton: false
                        });

                        window.setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                    } else {
                        swal({
                            title: "Error!",
                            text: "Something went wrong.",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                }
            });
        }
        return false;
    });

    // Reset input fields
    $("#new").click(function (e) {
        e.preventDefault();
        $('#form-data')[0].reset();
        $("#create").show();
    });

    // Populate form from modal click
    $(document).on('click', '.select-jobrole', function () {
        $('#jobrole_id').val($(this).data('id'));
        $('#name').val($(this).data('name'));

        if ($(this).data('active') == 1) {
            $('#activeStatus').prop('checked', true);
        } else {
            $('#activeStatus').prop('checked', false);
        }

        $("#create").hide();
        $('#jobrole_master').modal('hide');
    });

    // Delete Job Role
    $(document).on('click', '.delete-jobrole', function (e) {
        e.preventDefault();

        var jobroleId = $('#jobrole_id').val();
        var jobroleName = $('#name').val();

        if (!jobroleId || jobroleId === "") {
            swal({
                title: "Error!",
                text: "Please select a job role first.",
                type: "error",
                timer: 2000,
                showConfirmButton: false
            });
            return;
        }

        swal({
            title: "Are you sure?",
            text: "Do you want to delete job role '" + jobroleName + "'?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#6c757d",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel",
            closeOnConfirm: false
        }, function (isConfirm) {
            if (isConfirm) {
                $('.someBlock').preloader();

                $.ajax({
                    url: 'ajax/php/job_role.php',
                    type: 'POST',
                    data: {
                        id: jobroleId,
                        delete: true
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        $('.someBlock').preloader('remove');

                        if (response.status === 'success') {
                            swal({
                                title: "Deleted!",
                                text: "Job role has been deleted.",
                                type: "success",
                                timer: 2000,
                                showConfirmButton: false
                            });

                            setTimeout(() => {
                                window.location.reload();
                            }, 2000);
                        } else {
                            swal({
                                title: "Error!",
                                text: "Something went wrong.",
                                type: "error",
                                timer: 2000,
                                showConfirmButton: false
                            });
                        }
                    }
                });
            }
        });
    });

});
