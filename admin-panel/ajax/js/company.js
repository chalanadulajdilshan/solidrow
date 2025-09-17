jQuery(document).ready(function ($) {
    // Common AJAX handler
    function handleAjaxRequest(action, formData, successMessage, errorMessage) {
      $(".someBlock").preloader();
  
      $.ajax({
        url: "ajax/php/company.php",
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
  
            setTimeout(() => {
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
        { id: "name", message: "Please enter company name" },
      ];
  
      for (const field of requiredFields) {
        const value = $(`#${field.id}`).val();
        if (!value || value.length === 0) {
          return { valid: false, message: field.message };
        }
      }
  
      return { valid: true };
    }
  
    // Create Company
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
        "Company added successfully!",
        "Failed to create company."
      );
      return false;
    });
  
    // Update Company
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
        "Company updated successfully!",
        "Failed to update company."
      );
      return false;
    });
  
    // Reset form
    $("#new").click(function (e) {
      e.preventDefault();
      $("#form-data")[0].reset();
      $("#create").show();
      $("#update").hide();
    });
  
    // Populate form from modal click
    $(document).on("click", ".select-company", function () {
      const companyData = $(this).data();
      
      $("#company_id").val(companyData.id);
      $("#name").val(companyData.name);
      $("#short_desc").val(companyData.short_desc);
      $("#image_name").val(companyData.image_name);
      $("#page_url").val(companyData.page_url);
  
      $("#create").hide();
      $("#update").show();
      $("#company_master").modal("hide");
    });
  
    // Delete Company
    $(document).on("click", ".delete-company", function (e) {
      e.preventDefault();
      const companyId = $("#company_id").val();
      const companyName = $("#name").val();
  
      if (!companyId) {
        swal({
          title: "Error!",
          text: "Please select a company first.",
          type: "error",
          timer: 2000,
          showConfirmButton: false,
        });
        return;
      }
  
      swal(
        {
          title: "Are you sure?",
          text: "Do you want to delete company '" + companyName + "'?",
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
              { id: companyId, delete: true },
              "Company deleted successfully!",
              "Failed to delete company."
            );
          }
        }
      );
    });
  });
  