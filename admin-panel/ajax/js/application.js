jQuery(document).ready(function ($) {

    // Common AJAX handler
    function handleAjaxRequest(action, formData, successMessage, errorMessage) {
        $('.someBlock').preloader();

        $.ajax({
            url: "ajax/php/application.php",
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
                        text: successMessage,
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false,
                    });

                    window.setTimeout(function () {
                        window.location.reload();
                    }, 2000);
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
        const requiredFields = [
            { id: 'fullname', message: 'Please enter full name' },
            { id: 'NIC', message: 'Please enter NIC number' },
            { id: 'passportnumber', message: 'Please enter passport number' },
            { id: 'married_status', message: 'Please select married status' },
            { id: 'mobile_number', message: 'Please enter mobile number' },
            { id: 'whatsapp_number', message: 'Please enter WhatsApp number' },
            { id: 'country', message: 'Please enter country' }
        ];

        for (const field of requiredFields) {
            const value = $(`#${field.id}`).val().trim();
            if (!value) {
                return { valid: false, message: field.message };
            }
        }

        // --- Additional field-specific validations ---
        const fullname = $('#fullname').val().trim();
        const nic = $('#NIC').val().trim();
        const passport = $('#passportnumber').val().trim();
        const mobile = $('#mobile_number').val().trim();
        const whatsapp = $('#whatsapp_number').val().trim();
        const country = $('#country').val().trim();

        // Full name: only letters/spaces, at least 3 chars
        if (!/^[A-Za-z ]{3,}$/.test(fullname)) {
            return { valid: false, message: 'Full name must contain at least 3 letters and no numbers.' };
        }

        // NIC: at least 10 chars (Sri Lankan NICs are 10–12 chars)
        if (nic.length < 10) {
            return { valid: false, message: 'NIC seems too short. Please check again.' };
        }

        // Passport: alphanumeric check, min 6 chars
        if (!/^[A-Za-z0-9]{6,}$/.test(passport)) {
            return { valid: false, message: 'Passport number must be at least 6 characters and alphanumeric.' };
        }

        // Mobile: digits only, typically 10 digits
        if (!/^\d{10}$/.test(mobile)) {
            return { valid: false, message: 'Please enter a valid 10-digit mobile number.' };
        }

            // WhatsApp: digits only, typically 10 digits
        if (!/^\d{10}$/.test(whatsapp)) {
            return { valid: false, message: 'Please enter a valid 10-digit WhatsApp number.' };
        }

        return { valid: true };
    }

    // Create Application
    $("#create").click(function (event) {
        event.preventDefault();
        const validation = validateForm();
        if (!validation.valid) {
            swal({
                title: "Error!",
                text: validation.message,
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        }

        var formData = new FormData($("#form-data")[0]);
        formData.append('create', true);
        handleAjaxRequest('create', formData, 'Application created successfully.', 'Failed to create application.');
        return false;
    });

    // Update Application
    $("#update").click(function (event) {
        event.preventDefault();
        const validation = validateForm();
        if (!validation.valid) {
            swal({
                title: "Error!",
                text: validation.message,
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            return false;
        }

        var formData = new FormData($("#form-data")[0]);
        formData.append('update', true);
        handleAjaxRequest('update', formData, 'Application updated successfully.', 'Failed to update application.');
        return false;
    });

    // Reset form
    $("#new").click(function (e) {
        e.preventDefault();
        $('#form-data')[0].reset();
        $("#create").show();
        $("#update").hide();
    });

    // Populate form from table click
    $(document).on('click', '.select-application', function () {
        const appData = $(this).data();

        $('#id').val(appData.id);
        $('#fullname').val(appData.fullname);
        $('#NIC').val(appData.nic);
        $('#passportnumber').val(appData.passportnumber);
        $('#married_status').val(appData.married_status);
        $('#mobile_number').val(appData.mobile_number);
        $('#whatsapp_number').val(appData.whatsapp_number);
        $('#country').val(appData.country);

        $("#create").hide();
        $("#update").show();
        $('#application_modal').modal('hide');
    });

    // Delete Application
    $(document).on('click', '.delete-application', function (e) {
        e.preventDefault();
        const appId = $('#id').val();
        const fullname = $('#fullname').val();

        if (!appId) {
            swal({
                title: "Error!",
                text: "Please select an application first.",
                type: "error",
                timer: 2000,
                showConfirmButton: false
            });
            return;
        }

        swal({
            title: "Are you sure?",
            text: "Do you want to delete application for '" + fullname + "'?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#6c757d",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel"
        }, function (isConfirm) {
            if (isConfirm) {
                const formData = new FormData();
                formData.append('id', appId);
                formData.append('delete', true);
                handleAjaxRequest('delete', formData,
                    'Application deleted successfully.', 'Failed to delete application.');
            }
        });
    });
});
