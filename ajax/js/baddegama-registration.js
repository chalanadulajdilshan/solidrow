jQuery(document).ready(function () {

  $("#create").click(function (event) {

    event.preventDefault();

    // Validation
    if (!$("#full_name").val()) {
      showError("Please enter your full name");
    } else if (!$("#nic").val()) {
      showError("Please enter your NIC number");
    } else if (!validateNIC($("#nic").val())) {
      showError("Please enter a valid Sri Lankan NIC number (e.g., 123456789V or 123456789012)");
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

  // OTP Verification Logic
  $("#send-otp").click(function () {
    var mobile = $("#mobile_number").val();
    if (!mobile) {
      showError("Please enter your mobile number first.");
      return;
    }

    $("#send-otp").prop("disabled", true).text("Sending...");

    $.ajax({
      url: "../ajax/php/otp-verification.php",
      type: "POST",
      data: {
        action: "send_otp",
        mobile: mobile,
      },
      dataType: "JSON",
      success: function (result) {
        if (result.status === "success") {
          Swal.fire({
            title: "OTP Sent!",
            text: "Please check your SMS for the verification code.",
            icon: "success",
            timer: 2000,
            showConfirmButton: false,
          });
          $("#otp-section").fadeIn();
          $("#send-otp").text("Resend OTP").prop("disabled", false);
        } else {
          showError(result.message);
          $("#send-otp").prop("disabled", false).text("Verify");
        }
      },
      error: function () {
        showError("Failed to send OTP. Please try again.");
        $("#send-otp").prop("disabled", false).text("Verify");
      },
    });
  });

  $("#verify-otp").click(function () {
    var otp = $("#otp_code").val();
    var mobile = $("#mobile_number").val();

    if (!otp) {
      showError("Please enter the OTP code.");
      return;
    }

    $("#verify-otp").prop("disabled", true).text("Verifying...");

    $.ajax({
      url: "../ajax/php/otp-verification.php",
      type: "POST",
      data: {
        action: "verify_otp",
        otp: otp,
        mobile: mobile,
      },
      dataType: "JSON",
      success: function (result) {
        if (result.status === "success") {
          Swal.fire({
            title: "Verified!",
            text: "Mobile number verified successfully.",
            icon: "success",
            timer: 2000,
            showConfirmButton: false,
          });
          $("#otp-section").fadeOut();
          $("#send-otp").hide();
          $("#mobile_number").prop("readonly", true);
          $("#mobile-status")
            .removeClass("text-muted")
            .addClass("text-success font-weight-bold")
            .text("✓ Verified");
          $("#create").prop("disabled", false);
        } else {
          showError(result.message);
          $("#verify-otp").prop("disabled", false).text("Confirm OTP");
        }
      },
      error: function () {
        showError("Verification failed. Please try again.");
        $("#verify-otp").prop("disabled", false).text("Confirm OTP");
      },
    });
  });

  // Reset verification if mobile number is changed (if not readonly)
  $("#mobile_number").on("input", function () {
    $("#create").prop("disabled", true);
    $("#mobile-status").removeClass("text-success font-weight-bold").addClass("text-muted").text("Verification required");
    $("#otp-section").hide();
  });

  // Real-time NIC Validation
  $("#nic").on("input", function () {
    var nic = $(this).val();
    var status = $("#nic-status");

    if (nic.length === 0) {
      status.text("").removeClass("text-success text-danger");
    } else if (validateNIC(nic)) {
      status
        .text("✓ Valid NIC format")
        .removeClass("text-danger text-muted")
        .addClass("text-success font-weight-bold");
    } else {
      status
        .text("✗ Invalid NIC format")
        .removeClass("text-success text-muted")
        .addClass("text-danger font-weight-bold");
    }
  });

  function validateNIC(nic) {
    var old_nic_regx = /^(?:19|20)?\d{9}[vVxX]$/;
    var new_nic_regx = /^[0-9]{12}$/;

    if (nic.length === 10 && old_nic_regx.test(nic)) {
      return true;
    } else if (nic.length === 12 && new_nic_regx.test(nic)) {
      return true;
    }
    return false;
  }

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
