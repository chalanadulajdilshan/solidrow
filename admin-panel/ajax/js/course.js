jQuery(document).ready(function ($) {
    // Common AJAX handler
    function handleAjaxRequest(action, formData, successMessage, errorMessage) {
        $('.someBlock').preloader();

        $.ajax({
            url: "ajax/php/course.php",
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
                        text: "Course added Successfully!",
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
            { id: 'name', message: 'Please enter course name' },
            { id: 'price', message: 'Please enter course price' },
            { id: 'short_description', message: 'Please enter short description' },
            { id: 'description', message: 'Please enter course description' },
            { id: 'staff_id', message: 'Please select a staff member' },
            { id: 'queue', message: 'Please enter queue order' },
            { id: 'duration', message: 'Please enter duration' },
            { id: 'is_certified', message: 'Please select is certified' }
        ];

        for (const field of requiredFields) {
            const value = $(`#${field.id}`).val();
            if (!value || value.length === 0) {
                return { valid: false, message: field.message };
            }
        }

        return { valid: true };
    }

    // Create Course
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
        handleAjaxRequest('create', formData, 'Course created successfully.', 'Failed to create course.');
        return false;
    });

    // Update Course
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
        handleAjaxRequest('update', formData, 'Course updated successfully.', 'Failed to update course.');
        return false;
    });

    // Reset form
    $("#new").click(function (e) {
        e.preventDefault();
        $('#form-data')[0].reset();
        $("#create").show();
        $("#update").hide();
        $("#image_preview").hide();
    });

    // Populate form from modal click
    $(document).on('click', '.select-course', function () {
        const courseData = $(this).data();

        $('#course_id').val(courseData.id);
        $('#name').val(courseData.name);
        $('#price').val(courseData.price);
        $('#short_description').val(courseData.short_description);
        $('#description').val(courseData.description);
        $('#staff_id').val(courseData.staff_id);
        $('#queue').val(courseData.queue);  
        $('#duration').val(courseData.duration);
        $('#is_certified').val(courseData.is_certified);

        if (courseData.image_name) {
            $('#image_preview').show();
            $('#course_image').attr('src', '../upload/course/' + courseData.image_name);
        } else {
            $('#image_preview').hide();
        }

        $("#create").hide();
        $("#update").show();
        $('#course_master').modal('hide');
    });

    // Delete Course
    $(document).on('click', '.delete-course', function (e) {
        e.preventDefault();
        const courseId = $('#course_id').val();
        const courseName = $('#name').val();

        if (!courseId) {
            swal({
                title: "Error!",
                text: "Please select a course first.",
                type: "error",
                timer: 2000,
                showConfirmButton: false
            });
            return;
        }

        swal({
            title: "Are you sure?",
            text: "Do you want to delete course '" + courseName + "'?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#6c757d",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel"
        }, function (isConfirm) {
            if (isConfirm) {
                const formData = new FormData();
                formData.append('id', courseId);
                formData.append('delete', true);
                handleAjaxRequest('delete', formData,
                    'Course deleted successfully.', 'Failed to delete course.');
            }
        });
    });
});
