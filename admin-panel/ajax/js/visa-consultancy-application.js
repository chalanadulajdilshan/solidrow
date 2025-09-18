jQuery(document).ready(function () {
  // Create Application
  $("#create").click(function (event) {
    event.preventDefault();

    // Validation
    if (!$("#full_name").val()) {
      showError("Please enter full name");
    } else if (!$("#nic").val()) {
      showError("Please enter NIC number");
    } else if (!$("#passport_number").val()) {
      showError("Please enter passport number");
    } else if (!$("#birthday").val()) {
      showError("Please select birthday");
    } else if (!$("#age").val()) {
      showError("Please enter age");
    } else if (!$("#gender").val()) {
      showError("Please select gender");
    } else if (!$("#marital_status").val()) {
      showError("Please select marital status");
    } else if (!$("#mobile_number").val()) {
      showError("Please enter mobile number");
    } else if (!$("#province_id").val()) {
      showError("Please select province");
    } else if (!$("#job_abroad").val()) {
      showError("Please enter job abroad intention");
    } else if (!$("#country_id").val()) {
      showError("Please select country");
    } else if (!$("#visa_category").val()) {
      showError("Please select visa category");
    } else {
      // Start preloader
      $(".someBlock").preloader();

      // Form data
      var formData = new FormData($("#form-data")[0]);
      formData.append("create", true);

      $.ajax({
        url: "ajax/php/visa-consultancy-application.php",
        type: "POST",
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function (result) {
          $(".someBlock").preloader("remove");

          if (result.status === "success") {
            swal({
              title: "Success!",
              text: "Application created successfully!",
              type: "success",
              timer: 2000,
              showConfirmButton: false,
            });

            setTimeout(function () {
              window.location.reload();
            }, 2000);
          } else {
            swal({
              title: "Error!",
              text: result.message || "Something went wrong!",
              type: "error",
              timer: 2000,
              showConfirmButton: false,
            });
          }
        },
      });
    }
  });

  // Update Application
  $("#update").click(function (event) {
    event.preventDefault();

    // Validation (same as create)
    if (!$("#full_name").val()) {
      showError("Please enter full name");
    } else if (!$("#nic").val()) {
      showError("Please enter NIC number");
    } else if (!$("#passport_number").val()) {
      showError("Please enter passport number");
    } else if (!$("#birthday").val()) {
      showError("Please select birthday");
    } else if (!$("#age").val()) {
      showError("Please enter age");
    } else if (!$("#gender").val()) {
      showError("Please select gender");
    } else if (!$("#marital_status").val()) {
      showError("Please select marital status");
    } else if (!$("#mobile_number").val()) {
      showError("Please enter mobile number");
    } else if (!$("#province_id").val()) {
      showError("Please select province");
    } else if (!$("#job_abroad").val()) {
      showError("Please enter job abroad intention");
    } else if (!$("#country_id").val()) {
      showError("Please select country");
    } else if (!$("#visa_category").val()) {
      showError("Please select visa category");
    } else if (!$("#call_date_time").val()) {
      showError("Please select call date and time");
    } else if (!$("#call_status").val()) {
      showError("Please select call status");
    } else if (!$("#employee_status").val()) {
      showError("Please select employee status");
    } else if (!$("#call_notes").val()) {
      showError("Please enter call notes");
    } else {
      // Start preloader
      $(".someBlock").preloader();

      // Form data
      var formData = new FormData($("#form-data")[0]);
      formData.append("update", true);

      $.ajax({
        url: "ajax/php/visa-consultancy-application.php",
        type: "POST",
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function (result) {
          $(".someBlock").preloader("remove");

          if (result.status === "success") {
            swal({
              title: "Success!",
              text: "Application updated successfully!",
              type: "success",
              timer: 1500,
              showConfirmButton: false,
            });

            setTimeout(function () {
              window.location.href =
                "../admin-panel/all-visa-consultancy-application.php";
            }, 1000);
          } else {
            swal({
              title: "Error!",
              text: result.message || "Something went wrong!",
              type: "error",
              timer: 2000,
              showConfirmButton: false,
            });
          }
        },
      });
    }
  });

  function showError(message) {
    swal({
      title: "Error!",
      text: message,
      type: "error",
      timer: 3000,
      showConfirmButton: false,
    });
  }

  $("#country_id").on("change", function () {
    var countryId = $(this).val();
    var visaCategorySelect = $("#visa_category");

    if (countryId) {
      // Show loading state
      visaCategorySelect
        .prop("disabled", true)
        .html('<option value="">Loading visa categories...</option>');

      // Fetch visa categories for the selected country
      $.ajax({
        url: "ajax/php/student-country-visa.php",
        type: "GET",
        data: { 
          country_id: countryId,
          get_visa_types: true // Add this parameter to get visa type details
        },
        dataType: "json",
        success: function (response) {
          if (
            response.status === "success" &&
            response.data &&
            response.data.length > 0
          ) {
            var options = '<option value="">Select Visa Category</option>';

            $.each(response.data, function (index, category) {
              // Use visa_type_id and visa_type_name if available, otherwise fallback to old format
              var value = category.visa_type_id || category.visa_category || '';
              var name = category.visa_type_name || category.visa_category || 'Unknown';
              
              options +=
                '<option value="' +
                value +
                '">' +
                name +
                "</option>";
            });

            visaCategorySelect.html(options).prop("disabled", false);
          } else {
            visaCategorySelect
              .html(
                '<option value="">No visa categories found for this country</option>'
              )
              .prop("disabled", true);
          }
        },
        error: function (xhr, status, error) {
          console.error("Error fetching visa categories:", error);
          visaCategorySelect
            .html(
              '<option value="">Error loading visa categories. Please try again.</option>'
            )
            .prop("disabled", true);
        },
      });
    } else {
      visaCategorySelect
        .html('<option value="">Select Country First</option>')
        .prop("disabled", true);
    }
  });
});
