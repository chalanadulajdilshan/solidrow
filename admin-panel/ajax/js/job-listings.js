jQuery(document).ready(function ($) {
    // Initialize DataTable
    $('.table').DataTable({
        "pageLength": 10,
        "ordering": false
    });

    // Preview image before upload
    window.previewImage = function(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $('#image_preview').show();
                $('#job_image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    };

    // Remove image preview
    window.removeImage = function() {
        $('#image_preview').hide();
        $('#job_image').attr('src', '#');
        $('#image').val('');
    };

    // Handle form submission
    function handleFormSubmission(action, successMessage) {
        $(".someBlock").preloader();
        const formData = new FormData($('#form-data')[0]);
        formData.append(action, true);

        $.ajax({
            url: "ajax/php/job-listings.php",
            type: "POST",
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (result) {
                $(".someBlock").preloader("remove");
                console.log("Server response:", result); // Log server response
                
                if (result && result.status === "success") {
                    swal({
                        title: "Success!",
                        text: successMessage,
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false,
                    });
                    setTimeout(() => window.location.reload(), 2000);
                } else {
                    const errorMsg = result && result.message 
                        ? result.message 
                        : (result ? JSON.stringify(result) : 'No response from server');
                    console.error("Server error:", errorMsg);
                    swal("Error!", errorMsg || "Operation failed. Please try again.", "error");
                }
            },
            error: function (xhr, status, error) {
                $(".someBlock").preloader("remove");
                console.error("AJAX Error:", {
                    status: xhr.status,
                    statusText: xhr.statusText,
                    responseText: xhr.responseText,
                    error: error
                });
                
                let errorMsg = "Something went wrong. Please try again later.";
                try {
                    const response = JSON.parse(xhr.responseText);
                    errorMsg = response.message || errorMsg;
                } catch (e) {
                    errorMsg = xhr.responseText || errorMsg;
                }
                
                swal("Error!", errorMsg, "error");
            }
        });
    }

    // Create job listing
    $("#create").click(function (e) {
        e.preventDefault();
        if (validateForm()) {
            handleFormSubmission('create', 'Job listing created successfully!');
        }
    });

    // Update job listing
    $("#update").click(function (e) {
        e.preventDefault();
        if (validateForm()) {
            handleFormSubmission('update', 'Job listing updated successfully!');
        }
    });

    // Reset form
    $("#new").click(function (e) {
        e.preventDefault();
        $("#form-data")[0].reset();
        $("#job_id").val('');
        $("#create").show();
        $("#update").hide();
        $("#image_preview").hide();
    });

    // Edit job listing
    $(document).on("click", ".edit-job, .select-job", function (e) {
        e.preventDefault();
        const jobData = $(this).data();
        
        $("#job_id").val(jobData.id);
        $("#name").val(jobData.name);
        $("#position").val(jobData.position);
        $("#description").val(jobData.description);
        // Handle checkbox state
        if (jobData.is_active == 1) {
            $("#is_active").prop('checked', true);
        } else {
            $("#is_active").prop('checked', false);
        }

        if (jobData.image) {
            $("#image_preview").show();
            $("#job_image").attr("src", "../upload/joblisting/" + jobData.image);
        } else {
            $("#image_preview").hide();
        }

        $("#create").hide();
        $("#update").show();
        $('html, body').animate({ scrollTop: 0 }, 'fast');
    });

    // Delete job listing
    $(document).on("click", ".delete-job", function (e) {
        e.preventDefault();
        e.stopPropagation();
        
        const jobId = $(this).data('id');
        
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this job listing!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!",
            closeOnConfirm: false
        }, function() {
            $.post("ajax/php/job-listings.php", 
                { delete: true, id: jobId },
                function(response) {
                    if (response.status === "success") {
                        swal({
                            title: "Deleted!",
                            text: "Job listing has been deleted.",
                            type: "success",
                            timer: 2000,
                            showConfirmButton: false
                        });
                        setTimeout(() => window.location.reload(), 2000);
                    } else {
                        swal("Error!", "Failed to delete job listing.", "error");
                    }
                }, "json"
            );
        });
    });

    // Toggle job status
    $(document).on("click", ".toggle-status", function (e) {
        e.preventDefault();
        e.stopPropagation();
        
        const jobId = $(this).data('id');
        const currentStatus = $(this).data('status');
        const newStatus = currentStatus ? 0 : 1;
        
        $.post("ajax/php/job-listings.php", 
            { toggle_status: true, id: jobId, status: newStatus },
            function(response) {
                if (response.status === "success") {
                    window.location.reload();
                } else {
                    swal("Error!", "Failed to update job status.", "error");
                }
            }, "json"
        );
    });

    // Form validation
    function validateForm() {
        const requiredFields = [
            { id: "name", message: "Please enter job title" },
            { id: "position", message: "Please enter position" },
            { id: "description", message: "Please enter description" },
            { id: "is_active", message: "Please select status" }
        ];

        for (const field of requiredFields) {
            const value = $(`#${field.id}`).val();
            if (!value || value.length === 0) {
                swal({
                    title: "Error!",
                    text: field.message,
                    type: "error",
                    timer: 2000,
                    showConfirmButton: false,
                });
                return false;
            }
        }
        return true;
    }
});
