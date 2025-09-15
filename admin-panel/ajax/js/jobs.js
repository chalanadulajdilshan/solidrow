jQuery(document).ready(function () {

    // Create Job
    $("#create").click(function (event) {
        event.preventDefault();

        if (!$('#title').val() || $('#title').val().length === 0) {
            swal({ title: "Error!", text: "Please enter job title", type: 'error', timer: 2000, showConfirmButton: false });
        } else if (!$('#description').val() || $('#description').val().length === 0) {
            swal({ title: "Error!", text: "Please enter job description", type: 'error', timer: 2000, showConfirmButton: false });
        } else {

            $('.someBlock').preloader();

            var formData = new FormData($("#form-data")[0]);
            formData.append('create', true);

            $.ajax({
                url: "ajax/php/jobs.php",
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
                        swal({ title: "Success!", text: "Job added successfully!", type: 'success', timer: 2000, showConfirmButton: false });
                        setTimeout(() => { window.location.reload(); }, 2000);
                    } else {
                        swal({ title: "Error!", text: "Something went wrong.", type: 'error', timer: 2000, showConfirmButton: false });
                    }
                }
            });
        }
        return false;
    });

    // Update Job
    $("#update").click(function (event) {
        event.preventDefault();

        if (!$('#title').val() || $('#title').val().length === 0) {
            swal({ title: "Error!", text: "Please enter job title", type: 'error', timer: 2000, showConfirmButton: false });
        } else if (!$('#description').val() || $('#description').val().length === 0) {
            swal({ title: "Error!", text: "Please enter job description", type: 'error', timer: 2000, showConfirmButton: false });
        } else {

            $('.someBlock').preloader();

            var formData = new FormData($("#form-data")[0]);
            formData.append('update', true);

            $.ajax({
                url: "ajax/php/jobs.php",
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
                        swal({ title: "Success!", text: "Job updated successfully!", type: 'success', timer: 2500, showConfirmButton: false });
                        setTimeout(() => { window.location.reload(); }, 2000);
                    } else {
                        swal({ title: "Error!", text: "Something went wrong.", type: 'error', timer: 2000, showConfirmButton: false });
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

    // Populate form when selecting job
    $(document).on('click', '.select-job', function () {
        $('#job_id').val($(this).data('id'));
        $('#title').val($(this).data('title'));
        $('#description').val($(this).data('description'));
        $('#country').val($(this).data('country'));
        $('#respons_person').val($(this).data('respons_person'));
        $("#create").hide();
        $('#job_master').modal('hide');
    });

    // Delete Job
    $(document).on('click', '.delete-job', function (e) {
        e.preventDefault();

        var jobId = $('#job_id').val();
        var jobTitle = $('#title').val();

        if (!jobId || jobId === "") {
            swal({ title: "Error!", text: "Please select a job first.", type: "error", timer: 2000, showConfirmButton: false });
            return;
        }

        swal({
            title: "Are you sure?",
            text: "Do you want to delete job '" + jobTitle + "'?",
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
                    url: 'ajax/php/jobs.php',
                    type: 'POST',
                    data: { id: jobId, delete: true },
                    dataType: 'JSON',
                    success: function (response) {
                        $('.someBlock').preloader('remove');

                        if (response.status === 'success') {
                            swal({ title: "Deleted!", text: "Job has been deleted.", type: "success", timer: 2000, showConfirmButton: false });
                            setTimeout(() => { window.location.reload(); }, 2000);
                        } else {
                            swal({ title: "Error!", text: "Something went wrong.", type: "error", timer: 2000, showConfirmButton: false });
                        }
                    }
                });
            }
        });
    });

});
