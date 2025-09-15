jQuery(document).ready(function ($) {
    // Common AJAX handler
    function handleAjaxRequest(action, formData, successMessage, errorMessage) {
      $(".someBlock").preloader();
  
      $.ajax({
        url: "ajax/php/jobs.php",
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
        { id: "title", message: "Please enter job title" },
        { id: "description", message: "Please enter job description" },
        { id: "country", message: "Please select country" },
        { id: "respons_person", message: "Please select responsible person" },
      ];
  
      for (const field of requiredFields) {
        const value = $(`#${field.id}`).val();
        if (!value || value.length === 0) {
          return { valid: false, message: field.message };
        }
      }
  
      return { valid: true };
    }
  
    // Create Job
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
  
      var formData = new FormData($("#form-data")[0]);
      formData.append("create", true);
      handleAjaxRequest("create", formData, "Job added successfully!", "Failed to create job.");
      return false;
    });
  
    // Update Job
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
  
      var formData = new FormData($("#form-data")[0]);
      formData.append("update", true);
      handleAjaxRequest("update", formData, "Job updated successfully!", "Failed to update job.");
      return false;
    });
  
    // Reset form
    $("#new").click(function (e) {
      e.preventDefault();
      $("#form-data")[0].reset();
      $("#create").show();
      $("#update").hide();
      $("#image_preview").hide();
    });
  
    // Populate form from table click
    $(document).on("click", ".select-job", function () {
      const jobData = $(this).data();
  
      $("#job_id").val(jobData.id);
      $("#title").val(jobData.title);
      $("#description").val(jobData.description);
      $("#country").val(jobData.country);
      $("#respons_person").val(jobData.respons_person);
  
      if (jobData.image) {
        $("#image_preview").show();
        $("#job_image").attr("src", "../upload/job/" + jobData.image);
      } else {
        $("#image_preview").hide();
      }
  
      $("#create").hide();
      $("#update").show();
    });
  
    // Delete Job
    $(document).on("click", ".delete-job", function (e) {
      e.preventDefault();
      const jobId = $("#job_id").val();
      const jobTitle = $("#title").val();
  
      if (!jobId) {
        swal({
          title: "Error!",
          text: "Please select a job first.",
          type: "error",
          timer: 2000,
          showConfirmButton: false,
        });
        return;
      }
  
      swal(
        {
          title: "Are you sure?",
          text: "Do you want to delete job '" + jobTitle + "'?",
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
              { id: jobId, delete: true },
              "Job deleted successfully!",
              "Failed to delete job."
            );
          }
        }
      );
    });
  });
  