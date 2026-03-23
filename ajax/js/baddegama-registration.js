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
    } else if (!$("#current_job").val()) {
      showError("Please enter your current job");
    } else if (!$("#experience").val()) {
      showError("Please enter your experience");
    } else if (!$("#destination_country").val()) {
      showError("Please select your destination country");
    } else {
      // Start preloader
      if (typeof $.fn.preloader === 'function') {
        $(".someBlock").preloader();
      }

      // Form data
      var formData = new FormData($("#form-data")[0]);

      $.ajax({
        url: "../ajax/php/baddegama-registration.php",
        type: "POST",
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function (result) {
          if (typeof $.fn.preloader === 'function') {
            $(".someBlock").preloader("remove");
          }

          if (result.status === "success") {
            Swal.fire({
              title: "Success!",
              text: "Registration successful!",
              icon: "success",
              timer: 2000,
              showConfirmButton: false,
            }).then(() => {
              // Show SMS Status Alert
              var smsIcon = result.sms_status.includes("successfully") ? "success" : "error";
              var smsTitle = result.sms_status.includes("successfully") ? "SMS Sent!" : "SMS Failed!";

              Swal.fire({
                title: smsTitle,
                text: result.sms_status,
                icon: smsIcon,
                timer: 3000,
                showConfirmButton: false,
              }).then(() => {
                window.location.reload();
              });
            });
          } else {
            Swal.fire({
              title: "Error!",
              text: result.message || "Something went wrong!",
              icon: "error",
              timer: 2000,
              showConfirmButton: false,
            });
          }
        },
        error: function () {
          if (typeof $.fn.preloader === 'function') {
            $(".someBlock").preloader("remove");
          }
          showError("A server error white processing your request.");
        }
      });
    }
  });

  function showError(message) {
    if (typeof Swal !== 'undefined') {
      Swal.fire({
        title: "Error!",
        text: message,
        icon: "error",
        timer: 3000,
        showConfirmButton: false,
      });
    } else {
      alert(message);
    }
  }
});
