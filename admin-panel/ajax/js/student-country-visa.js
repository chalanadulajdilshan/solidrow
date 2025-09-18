jQuery(document).ready(function () {

    // Create Student Visa Country
    $("#create").click(function (event) {
        event.preventDefault();

        if (!$('#country_id').val() || !$('#visa_category').val()) {
            swal({
                title: "Error!",
                text: "Please select both Country and Visa Category",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return;
        }

        $('.someBlock').preloader();
        var formData = new FormData($("#form-data")[0]);
        formData.append('create', true);

        $.ajax({
            url: "ajax/php/student-country-visa.php",
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
                        text: "Record added Successfully!",
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false,
                    });

                    setTimeout(function () {
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

        return false;
    });

    // Update Student Visa Country
    $("#update").click(function (event) {
        event.preventDefault();

        if (!$('#country_id').val() || !$('#visa_category').val()) {
            swal({
                title: "Error!",
                text: "Please select both Country and Visa Category",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return;
        }

        $('.someBlock').preloader();
        var formData = new FormData($("#form-data")[0]);
        formData.append('update', true);

        $.ajax({
            url: "ajax/php/student-country-visa.php",
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
                        text: "Record updated successfully!",
                        type: 'success',
                        timer: 2500,
                        showConfirmButton: false
                    });

                    setTimeout(function () {
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

        return false;
    });

    // Reset form
    $("#new").click(function (e) {
        e.preventDefault();
        $('#form-data')[0].reset();
        $("#create").show();
        $("#update").hide();
    });

    // Populate form for edit
    $(document).on('click', '.select-staff', function () {
        $('#staff_visa_id').val($(this).data('id'));
        $('#country_id').val($(this).data('country_id'));
        $('#visa_category').val($(this).data('visa_category'));

        $("#create").hide();
        $("#update").show();
    });

    // Delete Student Visa Country
    $(document).on('click', '.delete-staff', function (e) {
        e.preventDefault();

        var id = $(this).data('id');

        if (!id) {
            swal({
                title: "Error!",
                text: "Please select a record first.",
                type: "error",
                timer: 2000,
                showConfirmButton: false
            });
            return;
        }

        swal({
            title: "Are you sure?",
            text: "Do you want to delete this record?",
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
                    url: 'ajax/php/student-country-visa.php',
                    type: 'POST',
                    data: {
                        id: id,
                        delete: true
                    },
                    dataType: 'JSON',
                    success: function (response) {
                        $('.someBlock').preloader('remove');

                        if (response.status === 'success') {
                            swal({
                                title: "Deleted!",
                                text: "Record has been deleted.",
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
