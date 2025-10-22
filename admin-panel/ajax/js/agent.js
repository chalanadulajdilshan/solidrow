jQuery(document).ready(function ($) {
    // Common AJAX handler
    function handleAjaxRequest(action, formData, successMessage, errorMessage) {
        $(".someBlock").preloader();

        $.ajax({
            url: "ajax/php/agent.php",
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
                $(".someBlock").preloader("remove");
                swal("Error!", "Something went wrong. Please try again later.", "error");
                console.error("AJAX Error:", status, error);
            },
        });
    }

    // Form validation
    function validateForm() {
        const requiredFields = [
            { id: "name", message: "Please enter staff name" }, 
            { id: "contact_no", message: "Please enter contact number" },
            { id: "nic", message: "Please enter NIC number" }, 
        ];

        for (const field of requiredFields) {
            const value = $(`#${field.id}`).val();
            if (!value || value.length === 0) {
                return { valid: false, message: field.message };
            }
        }

        // Validate NIC format (9 digits + v/x or 12 digits)
        const nic = $("#nic").val();
        if (!/^[0-9]{9}[vVxX]?$|^[0-9]{12}$/.test(nic)) {
            return { valid: false, message: "Please enter a valid NIC number" };
        }

        // Validate contact number (exactly 10 digits)
        const contactNo = $("#contact_no").val();
        if (!/^[0-9]{10}$/.test(contactNo)) {
            return { valid: false, message: "Please enter a valid 10-digit contact number" };
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
                type: "error",
                timer: 2000,
                showConfirmButton: false,
            });
            return false;
        }

        const formData = new FormData($("#form-data")[0]);
        formData.append("create", true);
        handleAjaxRequest("create", formData, "Agent created successfully.", "Failed to create agent.");
    });

    // Update Staff
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
        handleAjaxRequest("update", formData, "Agent updated successfully.", "Failed to update agent.");
    });

    // Reset form
    $("#new").click(function (e) {
        e.preventDefault();
        $("#form-data")[0].reset();
        $("#create").show();
        $("#update").hide();
        $("#id_copy_preview").hide();
        if (typeof removeIdCopy === "function") removeIdCopy(); // avoid error if function not defined
    });

    // Populate form when selecting staff
    $(document).on("click", ".select-staff", function () {
        const agentData = $(this).data();

        $("#agent_id").val(agentData.id);
        $("#name").val(agentData.name);
        $("#contact_no").val(agentData.contact_no);
        $("#whatsapp_no").val(agentData.whatsapp_no);
        $("#nic").val(agentData.nic);

        if (agentData.join_date) {
            const joinDate = new Date(agentData.join_date);
            $("#join_date").val(joinDate.toISOString().split("T")[0]);
        }

        $("#create").hide();
        $("#update").show();
        $("#agent_master").modal("hide");
    });

    // Delete Agent
    $(document).on("click", ".delete-agent", function (e) {
        e.preventDefault();
        const agentId = $("#agent_id").val();
        const agentName = $("#name").val();

        if (!agentId) {
            swal({
                title: "Error!",
                text: "Please select an agent first.",
                type: "error",
                timer: 2000,
                showConfirmButton: false,
            });
            return;
        }

        swal(
            {
                title: "Are you sure?",
                text: "Do you want to delete agent '" + agentName + "'?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#6c757d",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "Cancel",
            },
            function (isConfirm) {
                if (isConfirm) {
                    handleAjaxRequest(
                        "delete",
                        { id: agentId, delete: true },
                        "Agent deleted successfully.",
                        "Failed to delete agent."
                    );
                }
            }
        );
    });
});
