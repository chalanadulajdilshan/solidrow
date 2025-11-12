jQuery(document).ready(function ($) {
    // Common AJAX handler
    function handleAjaxRequest(action, formData, successMessage, errorMessage) {
        $(".someBlock").preloader();

        $.ajax({
            url: "ajax/php/group.php", // <-- use your group backend
            type: "POST",
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            dataType: "json",
            success: function (result) {
                $(".someBlock").preloader("remove");
                if (result.status === "success") {
                    // Show success message and reload immediately
                    swal({
                        title: "Success!",
                        text: result.message || successMessage,
                        type: "success",
                        timer: 1000, // Shorter timer
                        showConfirmButton: false
                    });
                    // Force page refresh after a short delay
                    setTimeout(function() {
                        window.location.reload(true); // true forces reload from server, not cache
                    }, 500);
                } else {
                    swal("Error!", result.message || errorMessage, "error");
                }
            },
            error: function (xhr, status, error) {
                $(".someBlock").preloader("remove");
                swal("Error!", "Something went wrong. Please try again later.", "error");
                console.error("AJAX Error:", status, error);
            },
        });
    }

    // Form validation
    function validateForm() {
        const requiredFields = [
            { id: "group_name", message: "Please enter group name" },
            { id: "group_payment", message: "Please enter group payment" },
            { id: "document_charge", message: "Please enter document charge" },
            { id: "country", message: "Please select country" },
        ];

        for (const field of requiredFields) {
            const value = $(`#${field.id}`).val();
            if (!value || value.length === 0) {
                return { valid: false, message: field.message };
            }
        }

        // Validate group_payment (must be numeric & > 0)
        const payment = parseFloat($("#group_payment").val());
        if (isNaN(payment) || payment <= 0) {
            return { valid: false, message: "Please enter a valid group payment amount" };
        }

        // Validate document_charge (must be numeric & >= 0)
        const docCharge = parseFloat($("#document_charge").val());
        if (isNaN(docCharge) || docCharge < 0) {
            return { valid: false, message: "Please enter a valid document charge amount" };
        }

        return { valid: true };
    }

    // Handle form submission
    $("#form-data").on('submit', function(e) {
        e.preventDefault();
        // Trigger the create button click
        $("#create").click();
        return false;
    });

    // Create Group
    $("#create").click(function (event) {
        event.preventDefault();
        const validation = validateForm();
        if (!validation.valid) {
            swal({
                title: "Error!",
                text: validation.message,
                type: "error",
                timer: 2000,
                showConfirmButton: false,
            });
            return false;
        }

        const formData = new FormData($("#form-data")[0]);
        formData.append("create", true);
        
        // Show loading state
        const $createBtn = $(this);
        $createBtn.prop('disabled', true).html('<i class="uil uil-spinner uil-spin me-1"></i> Saving...');
        
        // Use AJAX to submit the form data
        $.ajax({
            url: "ajax/php/group.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    swal({
                        title: "Success!",
                        text: response.message || "Group created successfully.",
                        type: "success",
                        timer: 1000,
                        showConfirmButton: false
                    });
                    // Reload after a short delay to show the success message
                    setTimeout(function() {
                        window.location.reload(true);
                    }, 1000);
                } else {
                    swal("Error!", response.message || "Failed to create group.", "error");
                    $createBtn.prop('disabled', false).html('<i class="uil uil-save me-1"></i> Save');
                }
            },
            error: function(xhr, status, error) {
                console.error("Create error:", error);
                swal("Error!", "Failed to create group. Please try again.", "error");
                $createBtn.prop('disabled', false).html('<i class="uil uil-save me-1"></i> Save');
            }
        });
    });

    // Update Group
    $("#update").click(function (event) {
        event.preventDefault();
        const validation = validateForm();
        if (!validation.valid) {
            swal({
                title: "Error!",
                text: validation.message,
                type: "error",
                timer: 2000,
                showConfirmButton: false,
            });
            return false;
        }

        const formData = new FormData($("#form-data")[0]);
        formData.append("update", true);
        
        // Make sure we have a group ID
        const groupId = $("#group_id").val();
        if (!groupId) {
            swal({
                title: "Error!",
                text: "No group selected for update.",
                type: "error",
                timer: 2000,
                showConfirmButton: false,
            });
            return false;
        }
        
        // Show loading state
        const $updateBtn = $(this);
        $updateBtn.prop('disabled', true).html('<i class="uil uil-spinner uil-spin me-1"></i> Updating...');
        
        // Use AJAX to submit the form data
        $.ajax({
            url: "ajax/php/group.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    swal({
                        title: "Success!",
                        text: response.message || "Group updated successfully.",
                        type: "success",
                        timer: 1000,
                        showConfirmButton: false
                    });
                    // Reload after a short delay to show the success message
                    setTimeout(function() {
                        window.location.reload(true);
                    }, 1000);
                } else {
                    swal("Error!", response.message || "Failed to update group.", "error");
                    $updateBtn.prop('disabled', false).html('<i class="uil uil-save me-1"></i> Update');
                }
            },
            error: function(xhr, status, error) {
                console.error("Update error:", error);
                swal("Error!", "Failed to update group. Please try again.", "error");
                $updateBtn.prop('disabled', false).html('<i class="uil uil-save me-1"></i> Update');
            }
        });
    });

    // Reset form
    $("#new").click(function (e) {
        e.preventDefault();
        $("#form-data")[0].reset();
        $("#create").show();
        $("#update").hide();
    });

    // Handle edit button click
    $(document).on("click", ".edit-group", function () {
        const groupId = $(this).data('id');
        const groupName = $(this).data('group_name');
        const groupPayment = $(this).data('group_payment');
        const documentCharge = $(this).data('document_charge');
        const country = $(this).data('country');

        // Fill the form with group data
        $("#group_id").val(groupId);
        $("#group_name").val(groupName);
        $("#group_payment").val(groupPayment);
        $("#document_charge").val(documentCharge);
        $("#country").val(country).trigger('change');

        // Switch to update mode
        $("#create").hide();
        $("#update").show();

        // Scroll to the form
        $('html, body').animate({
            scrollTop: $("#form-data").offset().top - 100
        }, 500);
    });

    // Delete Group
    $(document).on("click", ".delete-group", function (e) {
        e.preventDefault();
        e.stopPropagation();
        
        const $btn = $(this);
        const groupId = $btn.data('id');
        const groupName = $btn.data('group_name');

        if (!groupId) {
            swal({
                title: "Error!",
                text: "Group ID is missing. Please refresh the page and try again.",
                type: "error"
            });
            return false;
        }

        swal({
            title: "Are you sure?",
            text: "Do you want to delete group '" + (groupName || '') + "'?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#6c757d",
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "Cancel",
            closeOnConfirm: false,
            showLoaderOnConfirm: true
        }, function(isConfirm) {
            if (isConfirm) {
                // Show loading state on the clicked button
                $btn.prop('disabled', true).html('<i class="uil uil-spinner uil-spin"></i>');
                
                // Send delete request
                $.ajax({
                    url: "ajax/php/group.php",
                    type: "POST",
                    data: {
                        delete: true,
                        id: groupId
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response && response.status === 'success') {
                            swal({
                                title: "Deleted!",
                                text: response.message || "Group has been deleted.",
                                type: "success",
                                timer: 1000,
                                showConfirmButton: false
                            }, function() {
                                window.location.reload(true);
                            });
                        } else {
                            swal("Error!", (response && response.message) || "Failed to delete group.", "error");
                            $btn.prop('disabled', false).html('<i class="uil uil-trash"></i>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Delete error:", error);
                        swal("Error!", "Failed to delete group. Please try again.", "error");
                        $btn.prop('disabled', false).html('<i class="uil uil-trash"></i>');
                    }
                });
            }
        });
    });

    // Search functionality
    function performSearch() {
        const searchTerm = $('#searchInput').val().toLowerCase();
        
        if (searchTerm.length === 0) {
            // If search is empty, show all rows
            $('table tbody tr').show();
            return;
        }

        // Hide all rows first
        $('table tbody tr').hide();

        // Show only matching rows
        $('table tbody tr').each(function() {
            const $row = $(this);
            const groupName = $row.find('td:eq(1)').text().toLowerCase();
            const country = $row.find('td:eq(2)').text().toLowerCase();

            if (groupName.includes(searchTerm) || country.includes(searchTerm)) {
                $row.show();
            }
        });
    }

    // Handle search button click
    $('#searchBtn').on('click', function() {
        performSearch();
    });

    // Handle Enter key in search input
    $('#searchInput').on('keyup', function(e) {
        if (e.key === 'Enter') {
            performSearch();
        } else if ($(this).val() === '') {
            // If search is cleared, show all rows
            $('table tbody tr').show();
        }
    });
});
