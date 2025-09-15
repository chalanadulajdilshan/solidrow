jQuery(document).ready(function ($) {
    // Common AJAX handler
    function handleAjaxRequest(action, formData, successMessage, errorMessage) {
        $('.someBlock').preloader();

        $.ajax({
            url: "ajax/php/staff.php",
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
        const requiredFields = [
            { id: 'name', message: 'Please enter staff name' },
            { id: 'position', message: 'Please enter position' },
            { id: 'contact_no', message: 'Please enter contact number' },
            { id: 'nic', message: 'Please enter NIC number' },
            { id: 'epf_no', message: 'Please enter EPF number' },
            { id: 'salary', message: 'Please enter salary' },
            { id: 'district', message: 'Please select district' },
            { id: 'province', message: 'Please select province' },
            { id: 'company', message: 'Please select company' },
            { id: 'join_date', message: 'Please select join date' }
        ];

        for (const field of requiredFields) {
            const value = $(`#${field.id}`).val();
            if (!value || value.length === 0) {
                return { valid: false, message: field.message };
            }
        }

        // Validate NIC format
        const nic = $('#nic').val();
        if (!/^[0-9]{9}[vVxX]?$|^[0-9]{12}$/.test(nic)) {
            return { valid: false, message: 'Please enter a valid NIC number' };
        }

        // Validate contact number
        const contactNo = $('#contact_no').val();
        if (!/^[0-9]{10}$/.test(contactNo)) {
            return { valid: false, message: 'Please enter a valid 10-digit contact number' };
        }

        // Validate salary
        const salary = $('#salary').val();
        if (isNaN(salary) || salary <= 0) {
            return { valid: false, message: 'Please enter a valid salary amount' };
        }

        return { valid: true };
    }

    // Create Staff
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
        handleAjaxRequest('create', formData, 'Staff member created successfully.', 'Failed to create staff member.');
        return false;
    });

    // Update Staff
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
        handleAjaxRequest('update', formData, 'Staff member updated successfully.', 'Failed to update staff member.');
        return false;
    });

    // Reset form
    $("#new").click(function (e) {
        e.preventDefault();
        $('#form-data')[0].reset();
        $("#create").show();
        $("#update").hide();
        $("#id_copy_preview").hide();
        removeIdCopy();
    });

    // Populate form from modal click
    $(document).on('click', '.select-staff', function () {
        const staffData = $(this).data();

        $('#staff_id').val(staffData.id);
        $('#name').val(staffData.name);
        $('#position').val(staffData.position);
        $('#contact_no').val(staffData.contact_no);
        $('#whatsapp_no').val(staffData.whatsapp_no);
        $('#nic').val(staffData.nic);
        $('#education_qualification').val(staffData.education_qualification);
        $('#position_qualification').val(staffData.position_qualification);
        $('#service_experience').val(staffData.service_experience);
        $('#epf_no').val(staffData.epf_no);
        $('#salary').val(staffData.salary);
        $('#district').val(staffData.district).trigger('change');
        $('#province').val(staffData.province).trigger('change');
        $('#company').val(staffData.company).trigger('change');

        if (staffData.join_date) {
            const joinDate = new Date(staffData.join_date);
            $('#join_date').val(joinDate.toISOString().split('T')[0]);
        }

        if (staffData.id_copy) {
            $('#id_copy_preview').show();
            $('#id_copy_image').attr('src', '../upload/staff/id-copy/' + staffData.id_copy);
        } else {
            $('#id_copy_preview').hide();
        }

        $("#create").hide();
        $("#update").show();
        $('#staff_master').modal('hide');
    });

    // Delete Staff
    $(document).on('click', '.delete-staff', function (e) {
        e.preventDefault();
        const staffId = $('#staff_id').val();
        const staffName = $('#name').val();

        if (!staffId) {
            swal({
                title: "Error!",
                text: "Please select a staff member first.",
                type: "error",
                timer: 2000,
                showConfirmButton: false
            });
            return;
        }

        swal({
            title: "Are you sure?",
            text: "Do you want to delete staff member '" + staffName + "'?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#6c757d",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel"
        }, function (isConfirm) {
            if (isConfirm) {
                handleAjaxRequest('delete', { id: staffId, delete: true }, 
                    'Staff member deleted successfully.', 'Failed to delete staff member.');
            }
        });
    });
});