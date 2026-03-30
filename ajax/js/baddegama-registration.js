jQuery(document).ready(function () {

  $("#create").click(function (event) {

    event.preventDefault();

    // Validation
    if (!$("#full_name").val()) {
      showError("Please enter your full name");
    } else if (!validateName($("#full_name").val())) {
      showError("Full name must contain only English letters and spaces (automatic caps)");
    } else if (!$("#nic").val()) {
      showError("Please enter your NIC number");
    } else if (!validateNIC($("#nic").val())) {
      showError("Please enter a valid Sri Lankan NIC number (e.g., 123456789V or 123456789012)");
    } else if ($("#passport_number").val() && !validatePassport($("#passport_number").val())) {
      showError("Please enter a valid passport number (Starts with N or P followed by numbers)");
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
    var mobile = $(this).val();
    var status = $("#mobile-status");

    $("#create").prop("disabled", true);
    $("#otp-section").hide();

    if (mobile.length === 0) {
      status.text("Verification required").removeClass("text-success text-danger font-weight-bold").addClass("text-muted");
    } else if (validateMobile(mobile)) {
      status
        .text("✓ Valid format - Verification required")
        .removeClass("text-danger text-muted")
        .addClass("text-success font-weight-bold");
    } else {
      status
        .text("✗ Invalid mobile format (e.g., 0771234567)")
        .removeClass("text-success text-muted")
        .addClass("text-danger font-weight-bold");
    }
  });

  // Real-time NIC Validation
  $("#nic").on("input", function () {
    var nic = $(this).val().toUpperCase();
    $(this).val(nic); // Auto-capitalize
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
 
  // Real-time Name Validation
  $("#full_name").on("input", function () {
    var name = $(this).val().toUpperCase();
    $(this).val(name); // Auto-capitalize

    var status = $("#name-status");

    if (name.length === 0) {
      status.text("").removeClass("text-success text-danger font-weight-bold");
    } else if (validateName(name)) {
      status
        .text("✓ Valid Name format")
        .removeClass("text-danger text-muted")
        .addClass("text-success font-weight-bold");
    } else {
      status
        .text("✗ Only English letters and spaces allowed")
        .removeClass("text-success text-muted")
        .addClass("text-danger font-weight-bold");
    }
  });

  // Real-time Passport Validation
  $("#passport_number").on("input", function () {
    var passport = $(this).val();

    if (passport.length > 0) {
      // Auto-capitalize first character if it's n or p
      var firstChar = passport.charAt(0).toUpperCase();
      if (firstChar === 'N' || firstChar === 'P') {
        passport = firstChar + passport.substring(1);
        $(this).val(passport);
      }
    }

    var status = $("#passport-status");

    if (passport.length === 0) {
      status.text("").removeClass("text-success text-danger font-weight-bold");
    } else if (validatePassport(passport)) {
      status
        .text("✓ Valid Passport format")
        .removeClass("text-danger text-muted")
        .addClass("text-success font-weight-bold");
    } else {
      status
        .text("✗ Must start with N or P followed by numbers (no spaces/special characters)")
        .removeClass("text-success text-muted")
        .addClass("text-danger font-weight-bold");
    }
  });

  function validateNIC(nic) {
    var old_nic_regx = /^(?:19|20)?\d{9}[VX]$/;
    var new_nic_regx = /^[0-9]{12}$/;

    if (nic.length === 10 && old_nic_regx.test(nic)) {
      return true;
    } else if (nic.length === 12 && new_nic_regx.test(nic)) {
      return true;
    }
    return false;
  }

  function validateMobile(mobile) {
    var mobile_regx = /^07[01245678][0-9]{7}$/;
    return mobile_regx.test(mobile);
  }

  function validatePassport(passport) {
    var passport_regx = /^[NP][0-9]+$/;
    return passport_regx.test(passport);
  }

  function validateName(name) {
    var name_regx = /^[A-Z ]+$/;
    return name_regx.test(name);
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
