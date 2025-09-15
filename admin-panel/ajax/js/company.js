jQuery(document).ready(function ($) {
    // Common AJAX handler
    function handleAjaxRequest(action, formData, successMessage, errorMessage) {
        $('.someBlock').preloader();

        $.ajax({
            url: "ajax/php/company.php",
            type: 'POST',
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (result) {
                $('.someBlock').preloader('remove');
                if (result.status === 'success') {
                    swal({
                        title: "Success!",
                        text: result.message || successMessage,
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false
                    }).then(function () {
                        location.reload();
                    });
                } else {
                    swal("Error!", result.message || errorMessage, "error");
                }
            },
            error: function (xhr, status, error) {
                $('.someBlock').preloader('remove');
                swal("Error!", "Something went wrong. Please try again later.", "error");
                console.error("AJAX Error:", status, error);
            }
        });
    }

    // Form validation
    function validateForm() {
        if (!$('#name').val() || $('#name').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter company name",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        }
        return true;
    }

    // Create Company
    $("#create").click(function (event) {
        event.preventDefault();
        if (!validateForm()) return false;

        var formData = new FormData($("#form-data")[0]);
        formData.append('create', true);
        handleAjaxRequest('create', formData, 'Company created successfully.', 'Failed to create company.');
        return false;
    });

    // Update Company
    $("#update").click(function (event) {
        event.preventDefault();
        if (!validateForm()) return false;

        var formData = new FormData($("#form-data")[0]);
        formData.append('update', true);
        formData.append('id', $('#company_id').val());
        handleAjaxRequest('update', formData, 'Company updated successfully.', 'Failed to update company.');
        return false;
    });

    // Reset input fields
    $("#new").click(function (e) {
        e.preventDefault();
        $('#form-data')[0].reset();
        $("#create").show();
        $("#update").hide();
        removeImage();
    });

    // Populate form from modal click
    $(document).on('click', '.select-company', function () {
        $('#company_id').val($(this).data('id'));
        $('#name').val($(this).data('name'));
        $('#short_desc').val($(this).data('short_desc'));
        $('#image_url').val($(this).data('image_url'));

        const imageName = $(this).data('image_name');
        if (imageName) {
            $('#company_image').attr('src', '../upload/company/' + imageName);
            $('#image_preview').show();
        } else {
            removeImage();
        }

        $("#create").hide();
        $("#update").show();
        $('#company_master').modal('hide');
    });

    // Delete Company
    $(document).on('click', '.delete-company', function (e) {
        e.preventDefault();
        const companyId = $('#company_id').val();
        const companyName = $('#name').val();

        if (!companyId) {
            swal({
                title: "Error!",
                text: "Please select a company first.",
                type: "error",
                timer: 2000,
                showConfirmButton: false
            });
            return;
        }

        swal({
            title: "Are you sure?",
            text: "Do you want to delete company '" + companyName + "'?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#6c757d",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel"
        }, function (isConfirm) {
            if (isConfirm) {
                handleAjaxRequest('delete', { id: companyId, delete: true }, 
                    'Company deleted successfully.', 'Failed to delete company.');
            }
        });
    });
});