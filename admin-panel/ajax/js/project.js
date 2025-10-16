jQuery(document).ready(function ($) {
  // Common AJAX handler
  function handleAjaxRequest(action, formData, successMessage, errorMessage) {
    $(".someBlock").preloader();

    $.ajax({
      url: "ajax/php/project.php",
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
            text: "Project added Successfully!",
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
        swal(
          "Error!",
          "Something went wrong. Please try again later.",
          "error"
        );
        console.error("AJAX Error:", status, error);
      },
    });
  }

  // Form validation
  function validateForm() {
    const requiredFields = [
      { id: "title", message: "Please enter project title" },
      { id: "short_description", message: "Please enter short description" },
      { id: "project_date", message: "Please select project date" },
    ];

    for (const field of requiredFields) {
      const value = $(`#${field.id}`).val();
      if (!value || value.length === 0) {
        return { valid: false, message: field.message };
      }
    }

    return { valid: true };
  }

  // Create Project
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
    handleAjaxRequest(
      "create",
      formData,
      "Project created successfully.",
      "Failed to create project."
    );
    return false;
  });

  // Update Project
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
    handleAjaxRequest(
      "update",
      formData,
      "Project updated successfully.",
      "Failed to update project."
    );
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

  // Populate form from modal click
  $(document).on("click", ".select-project", function () {
    const projectData = $(this).data();

    $("#project_id").val(projectData.id);
    $("#title").val(projectData.title);
    $("#short_description").val(projectData.short_description);

    if (projectData.project_date) {
      const projectDate = new Date(projectData.project_date);
      $("#project_date").val(projectDate.toISOString().split("T")[0]);
    }

    if (projectData.image_name) {
      $("#image_preview").show();
      $("#project_image").attr(
        "src",
        "../upload/project/" + projectData.image_name
      );
    } else {
      $("#image_preview").hide();
    }

    $("#create").hide();
    $("#update").show();
    $("#project_master").modal("hide");
  });

  $(document).on("click", ".delete-project", function (e) {
      e.preventDefault();
      const projectId = $("#project_id").val();
      const projectTitle = $("#title").val();
  
      if (!projectId) {
        swal({
          title: "Error!",
          text: "Please select a project first.",
          type: "error",
          timer: 2000,
          showConfirmButton: false,
        });
        return;
      }
  
      swal(
        {
          title: "Are you sure?",
          text: "Do you want to delete project '" + projectTitle + "'?",
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
              { id: projectId, delete: true },
              "Project deleted successfully!",
              "Failed to delete project."
            );
          }
        }
      );
    });
});
