jQuery(document).ready(function ($) {
  // ✅ Common AJAX handler
    $("#create").click(function (event) {
        event.preventDefault();

        // Validation
        if (!$('#title').val() || $('#title').val().length === 0) {
            swal({
                title: "Error!",
                text: "Please enter job title",
                type: 'error',
                timer: 2000,
                showConfirmButton: false
            });
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
                        swal({
                            title: "Success!",
                            text: "Job added Successfully!",
                            type: "success",
                            timer: 2000,
                            showConfirmButton: false,
                          });
              
                          window.setTimeout(function () {
                            window.location.reload();
                          }, 2000);
                    } else {
                        swal({
                            title: "Error!",
                            text: "Something went wrong.",
                            type: 'error',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                }
            });
        }
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
      $("#active").prop("checked", true);
      $("#create").show();
      $("#update").hide();
      $("#image_preview").hide();
    });
  
    // Populate form from table click
    $(document).on("click", ".select-job", function () {
      const jobData = $(this).data();
  
      $("#job_id").val(jobData.id);
      $("#title").val(jobData.title);
      $("#position").val(jobData.position);
      $("#description").val(jobData.description);
      $("#country").val(jobData.country);
      $("#respons_person").val(jobData.respons_person);
      $("#active").prop("checked", jobData.active == 1);
  
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
  