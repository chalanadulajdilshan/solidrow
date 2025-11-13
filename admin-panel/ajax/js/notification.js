jQuery(document).ready(function ($) {

    function handleAjax(action, formData, successMsg, errorMsg) {
        $('.someBlock').preloader();
        $.ajax({
            url: "ajax/php/notification.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (res) {
                $('.someBlock').preloader('remove');
                if (res.status === 'success') {
                    swal("Success!", successMsg, "success");
                    setTimeout(() => location.reload(), 1500);
                } else {
                    swal("Error!", res.message || errorMsg, "error");
                }
            },
            error: function () {
                $('.someBlock').preloader('remove');
                swal("Error!", "Something went wrong. Try again later.", "error");
            }
        });
    }

    function validateForm() {
        const title = $('#title').val().trim();
        const description = $('#description').val().trim();
        if (!title) return { valid: false, message: 'Enter notification title' };
        if (!description) return { valid: false, message: 'Enter description' };
        return { valid: true };
    }

    $("#create").click(function (e) {
        e.preventDefault();
        const v = validateForm();
        if (!v.valid) return swal("Error!", v.message, "error");

        const formData = new FormData($("#notification-form")[0]);
        formData.append('create', true);
        handleAjax('create', formData, 'Notification created successfully.', 'Failed to create notification.');
    });

    $("#update").click(function (e) {
        e.preventDefault();
        const v = validateForm();
        if (!v.valid) return swal("Error!", v.message, "error");

        const formData = new FormData($("#notification-form")[0]);
        formData.append('update', true);
        handleAjax('update', formData, 'Notification updated successfully.', 'Failed to update notification.');
    });

    $("#new").click(function () {
        $('#notification-form')[0].reset();
        $('#create').show();
        $('#update').hide();
    });

    $(document).on('click', '.select-notification', function () {
        const data = $(this).data();
        $('#id').val(data.id);
        $('#title').val(data.title);
        $('#description').val(data.description);
        $('#create').hide();
        $('#update').show();
    });

    $(document).on('click', '.delete-notification', function () {
        const id = $('#id').val();
        if (!id) return swal("Error!", "Select a notification first.", "error");

        swal({
            title: "Are you sure?",
            text: "Delete this notification?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonText: "Cancel",
            confirmButtonText: "Yes, delete it!"
        }, function (isConfirm) {
            if (isConfirm) {
                const formData = new FormData();
                formData.append('id', id);
                formData.append('delete', true);
                handleAjax('delete', formData, 'Notification deleted successfully.', 'Failed to delete notification.');
            }
        });
    });

});
