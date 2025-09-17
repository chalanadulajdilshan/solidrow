jQuery(document).ready(function () {
  
  $("#create").click(function (event) {

    event.preventDefault();
 
    // Validation
    if (!$("#full_name").val()) {
      showError("Please enter your full name");
    } else if (!$("#nic").val()) {
      showError("Please enter your NIC number");
    } else if (!$("#birthday").val()) {
      showError("Please select your birthday");
    } else if (!$("#age").val()) {
      showError("Please enter your age");
    } else if (!$("#gender").val()) {
      showError("Please select your gender");
    } else if (!$("#marital_status").val()) {
      showError("Please select your marital status");
    } else if (!$("#mobile_number").val()) {
      showError("Please enter your mobile number");
    } else if (!$("#province_id").val()) {
      showError("Please select your province");
    } else if (!$("#job_abroad").val()) {
      showError("Please select the job you intend to do abroad");
    } else {
      // Start preloader
      $(".someBlock").preloader();

      // Form data
      var formData = new FormData($("#form-data")[0]);

      // Debug: Log form data
      for (var pair of formData.entries()) {
        console.log(pair[0] + ": " + pair[1]);
      }

      $.ajax({
        url: "../ajax/php/engineering-application.php", // Change this URL to your actual handler
        type: "POST",
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function (result) {
          $(".someBlock").preloader("remove");

          if (result.status === "success") {
            swal({
              title: "Success!",
              text: "Registration successful!",
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

  $("#update").click(function (event) {
    event.preventDefault();

    // Validation
    if (!$("#full_name").val()) {
      showError("Please enter your full name");
    } else if (!$("#nic").val()) {
      showError("Please enter your NIC number");
    } else if (!$("#birthday").val()) {
      showError("Please select your birthday");
    } else if (!$("#age").val()) {
      showError("Please enter your age");
    } else if (!$("#gender").val()) {
      showError("Please select your gender");
    } else if (!$("#marital_status").val()) {
      showError("Please select your marital status");
    } else if (!$("#mobile_number").val()) {
      showError("Please enter your mobile number");
    } else if (!$("#province_id").val()) {
      showError("Please select your province");
    } else if (!$("#job_abroad").val()) {
      showError("Please select the job you intend to do abroad");
    } else if (!$("#call_date_time").val()) {
      showError("Please select the call date and time");
    } else if (!$("#call_status").val()) {
      showError("Please select the call status");
    } else if (!$("#employee_status").val()) {
      showError("Please select the employee status");
    } else if (!$("#call_notes").val()) {
      showError("Please select the call notes");
    } else {
      // Start preloader
      $(".someBlock").preloader();

      // Form data
      var formData = new FormData($("#form-data")[0]);

      $.ajax({
        url: "ajax/php/engineering-application.php",
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

            window.setTimeout(function () {
              window.location.href = "../admin-panel/staff-engineering-applications.php";
            }, 1000);
          } else {
            swal({
              title: "Error!",
              text: "Something went wrong.",
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
});
