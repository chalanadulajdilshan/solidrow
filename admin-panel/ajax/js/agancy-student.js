jQuery(document).ready(function () {
    
  $("#create").click(function (event) {
    event.preventDefault();

    if (!$("#student_id").val() || $("#student_id").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please Enter Student Id.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
         
    } else if (
      !$("#is_completed").val() ||
      $("#is_completed").val().length === 0
    ) {
      swal({
        title: "Error!",
        text: "Please select details complete or not complete..!",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
    } else {
      let student_id = $("#student_id").val();
      //preloarder start
      //$('.someBlock').preloader();
      //grab all form data
      $.ajax({
        url: "ajax/php/agancy-student.php",
        type: "POST",
        data: {
          student_id,
          action: "CHECKSTUID",
        },
        dataType: "JSON",
        success: function (result) {
          //remove preloarder
          $(".someBlock").preloader("remove");
          if (result.status === "exist") {
            swal({
              title: "Error!",
              text: "Student ID is already exist.",
              type: "error",
              timer: 2000,
              showConfirmButton: false,
            });
            return false;
          } else {
            var formData = new FormData($("#form-data")[0]);
            $.ajax({
              url: "ajax/php/agancy-student.php",
              type: "POST",
              data: formData,
              async: false,
              cache: false,
              contentType: false,
              processData: false,
              success: function (result) {
                //remove preloarder
                //$('.someBlock').preloader('remove');
                if (result.status === "success") {
                  swal({
                    title: "success!",
                    text: "Your data saved successfully !",
                    type: "success",
                    timer: 2000,
                    showConfirmButton: false,
                  });
                  window.setTimeout(function () {
                    window.location.replace(
                      "manage-student-payments.php?id=" + result.id
                    );
                  }, 2000);
                } else if (result.status === "error") {
                  swal({
                    title: "Error!",
                    text: "Something went wrong",
                    type: "error",
                    timer: 2000,
                    showConfirmButton: false,
                  });
                }
              },
            });
          }
        },
      });
    }
    return false;
  });

  $("#update").click(function (event) {
    event.preventDefault();
    if (!$("#student_id").val() || $("#student_id").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please Enter Student Id.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
      
    } else {
      //preloarder start
      //$('.someBlock').preloader();
      //grab all form data

      var formData = new FormData($("#form-data")[0]);
      $.ajax({
        url: "ajax/php/agancy-student.php",
        type: "POST",
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function (result) {
          //remove preloarder
          //$('.someBlock').preloader('remove');
          if (result.status === "success") {
            swal({
              title: "success!",
              text: "Your data saved successfully !",
              type: "success",
              timer: 2000,
              showConfirmButton: false,
            });
            window.setTimeout(function () {
              window.location.replace("manage-students.php");
            }, 2000);
          } else if (result.status === "error") {
            swal({
              title: "Error!",
              text: "Something went wrong",
              type: "error",
              timer: 2000,
              showConfirmButton: false,
            });
          }
        },
      });
    }
    return false;
  });

  

  $("#registration_type").change(function () {
    var type = $(this).val();

    if (type == 1) {
      $("#course_section").removeClass("hidden");
      $("#course_free_section").removeClass("hidden");
      $("#exam_fee_section").removeClass("hidden");
    } else if (type == 2) {
      $("#registration_free_section").removeClass("hidden");
      $("#exam_fee_section").removeClass("hidden");
      $("#course_free_section").removeClass("hidden");
      $("#course_section").removeClass("hidden");
    } else if (type == 4) {
      $("#registration_free_section").removeClass("hidden");
      $("#course_section").removeClass("hidden");
    } else if (type == 5) {
      $("#exam_fee_section").removeClass("hidden");
      $("#course_section").removeClass("hidden");
    }
  });

  $("#payment").click(function (event) {
    event.preventDefault();

    if (!$("#amount").val() || $("#amount").val().length === 0) {
      swal({
        title: "Error!",
        text: "Please Enter payment amount.",
        type: "error",
        timer: 2000,
        showConfirmButton: false,
      });
    } else {
      //preloarder start
      //$('.someBlock').preloader();
      //grab all form data

      var formData = new FormData($("#form-data")[0]);
      $.ajax({
        url: "ajax/php/payment.php",
        type: "POST",
        data: formData,
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        success: function (result) {
          //remove preloarder
          //$('.someBlock').preloader('remove');
          if (result.status === "success") {
            swal({
              title: "success!",
              text: "Your data saved successfully !",
              type: "success",
              timer: 2000,
              showConfirmButton: false,
            });
            window.setTimeout(function () {
              var url = "invoice.php?id=" + result.id;
              window.open(url, "_blank");
              location.reload();
            }, 2000);
          } else if (result.status === "error") {
            swal({
              title: "Error!",
              text: "Something went wrong",
              type: "error",
              timer: 2000,
              showConfirmButton: false,
            });
          }
        },
      });
    }
    return false;
  });

  $("#due_amount").keyup(function () {
    var course_fee = $("#course_fee").val();
    var due_amount = $("#due_amount").val();
    $("#pending_amount").val(course_fee - due_amount);
  });

  $("#due_exam_fee").keyup(function () {
    var exam_fee = $("#exam_fee").val();
    var due_exam_fee = $("#due_exam_fee").val();
    $("#pending_exam_fee").val(exam_fee - due_exam_fee);
  });

  $(document).on("blur", "#student_id", function () {
    let student_id = $(this).val();
    //preloarder start
    $(".someBlock").preloader();
    $.ajax({
      url: "ajax/php/agancy-student.php",
      type: "POST",
      data: {
        student_id,
        action: "CHECKSTUID",
      },
      dataType: "JSON",
      success: function (result) {
        //remove preloarder
        $(".someBlock").preloader("remove");
        if (result.status === "exist") {
          swal({
            title: "Error!",
            text: "Student ID is already exist.",
            type: "error",
            timer: 2000,
            showConfirmButton: false,
          });
        } else {
          return true;
        }
      },
    });
  });
  $("#certificate_01").click(function () {
    if($(this).prop("checked")) {
      $('.certificate_01_section').removeClass('hidden');
    } else {
      $('.certificate_01_section').addClass('hidden');
    }
  });
  $("#certificate_02").click(function () {
    if($(this).prop("checked")) {
      $('.certificate_02_section').removeClass('hidden');
    } else {
      $('.certificate_02_section').addClass('hidden');
    }
  });


//---------------------------------------------------------------------------


function saveSection(section, fieldIds, isFinal = false) {
    let formData = new FormData();
    let studentDbId = $("#student_db_id").val();
    let isValid = true;
    let firstInvalidField = null;

    formData.append("student_id", $("#student_id").val());
    formData.append("id", studentDbId);
    formData.append("section", section);

    fieldIds.forEach(function (fieldId) {
        let el = document.getElementById(fieldId);
        if (!el) return;

        if (el.type === "file") {
            if (el.files.length > 0) {
                formData.append(fieldId, el.files[0]);
            }
        } else {
            let val = el.value.trim();
            if (val === "" || val === null) {
                isValid = false;
                if (!firstInvalidField) firstInvalidField = el;
            }
            formData.append(fieldId, val);
        }
    });

    

    $.ajax({
        url: "ajax/php/agancy-student.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (response) {
            if (response.status === "success") {
                if (response.id) {
                    $("#student_db_id").val(response.id);
                }
                if (isFinal) {
                    swal({
                        title: "Success!",
                        text: "All data saved successfully.",
                        type: "success",
                        timer: 2000,
                        showConfirmButton: false
                    });
                    setTimeout(function () {
                        window.location.href = "manage-student-payments.php?id=" + response.id;
                    }, 2000);
                } else {
                    swal("Success", "Section " + section + " saved", "success");
                }
            } else {
                swal("Error", "Failed to save section", "error");
            }
        }
    });
}



function unlockSection(sectionNumber) {
    const sectionSelector = `#section-${sectionNumber}`;
    const $targetSection = $(sectionSelector);

    if ($targetSection.length) {
        $targetSection.slideDown(300, function () {
            const offsetTop = $targetSection.offset()?.top || 0;
            $('html, body').animate({ scrollTop: offsetTop - 20 }, 500);
        });
    }
}


  // Section 1 - Personal
  $("#save_section_1").click(async function (e) {
      e.preventDefault();
      
      // Show loading state
      const $saveBtn = $(this);
      const originalText = $saveBtn.html();
      $saveBtn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');
      
      try {
          // Run the validation
          const isValid = await validateSection1();
          
          if (isValid) {
              // Get all form data
              const form = $('#form-data');
              const formData = new FormData(form[0]);
              
              // Add section info and action
              formData.append('section', 'section1');
              formData.append('action', 'SAVE_SECTION');
              
              // Add student_db_id if exists
              const studentDbId = $("#student_db_id").val();
              if (studentDbId) {
                  formData.append('id', studentDbId);
              }
              
              // Add CSRF token if it exists
              const token = $('meta[name="csrf-token"]').attr('content');
              if (token) {
                  formData.append('_token', token);
              }
              
              // Log form data for debugging
              const formDataObj = {};
              formData.forEach((value, key) => {
                  formDataObj[key] = value;
              });
             
              
              // Send data via AJAX
              $.ajax({
                  url: form.attr('action') || "ajax/php/agancy-student.php",
                  type: "POST",
                  data: formData,
                  processData: false,
                  contentType: false,
                  dataType: "json",
                  success: function(response) {
                      if (response.status === "success") {
                          if (response.id) {
                              // Update the student_db_id if we got a new one
                              $("#student_db_id").val(response.id);
                              
                              // Show success message and unlock next section
                              swal({
                                  title: "Success!",
                                  text: "Section 1 saved successfully!",
                                  type: "success",
                                  timer: 1500,
                                  showConfirmButton: false
                              });

                              setTimeout(() => {
                                  unlockSection(2);
                                  // Trigger country change to show interview/pretest sections if country is selected
                                  if (typeof handleCountryChange === 'function') {
                                      handleCountryChange();
                                  }
                              }, 1600);
                          }
                      } else {
                          swal({
                              title: "Error!",
                              text: response.message || "Failed to save section 1. Please try again.",
                              type: "error",
                              timer: 3000,
                              showConfirmButton: true
                          });
                      }
                  },
                  error: function(xhr, status, error) {
                      console.error("AJAX Error details:", {
                          status: xhr.status,
                          statusText: xhr.statusText,
                          responseText: xhr.responseText,
                          error: error
                      });
                      
                      let errorMessage = "An error occurred while saving. Please try again.";
                      
                      // Try to get more specific error from response
                      try {
                          const response = JSON.parse(xhr.responseText);
                          if (response && response.message) {
                              errorMessage = response.message;
                          }
                      } catch (e) {
                          console.error("Error parsing error response:", e);
                      }
                      
                      swal({
                          title: "Error!",
                          text: errorMessage,
                          type: "error",
                          timer: 5000,
                          showConfirmButton: true
                      });
                  },
                  complete: function() {
                      // Always re-enable the button
                      $saveBtn.prop('disabled', false).html(originalText);
                  }
              });
          } else {
              $saveBtn.prop('disabled', false).html(originalText);
          }
      } catch (error) {
          console.error("Error in save_section_1:", {
              error: error,
              errorMessage: error.message,
              stack: error.stack
          });
          
          swal({
              title: "Error!",
              text: error.message || "An unexpected error occurred. Please try again.",
              type: "error",
              timer: 5000,
              showConfirmButton: true
          });
          
          $saveBtn.prop('disabled', false).html(originalText);
      }
  });
  
  // Make validateSection1 function available globally
  window.validateSection1 = async function() {
      let isValid = true;
      const nic = $('#nic').val().trim();
      const phoneNumber = $('#phone_number').val().trim();
      const whatsappNumber = $('#whatsapp_number').val().trim();
      const registrationDate = $('#registration_date').val();
      const today = new Date();
      today.setHours(0, 0, 0, 0);
      
      // Reset previous error states
      $('.is-invalid').each(function() {
          if (this && this.classList) {
              this.classList.remove('is-invalid');
          }
      });
      $('.duplicate-error').remove();
      $('.form-control').each(function() {
          if (this && this.classList) {
              this.classList.remove('is-valid');
          }
      });
      
      // Function to show error message
      function showError(field, message) {
          const $field = $('#' + field);
          if ($field.length) {
              const element = $field[0];
              if (element && element.classList) {
                  element.classList.add('is-invalid');
              }
              $field.after('<div class="invalid-feedback duplicate-error" style="display: block;">' + message + '</div>');
              try {
                  $field.focus();
              } catch (e) {
                  console.error('Could not focus on field:', field, e);
              }
          } else {
              console.error('Could not find element with ID:', field);
          }
          isValid = false;
      }
      
      // Function to mark field as valid
      function markValid(field) {
          const $field = $('#' + field);
          if ($field.length) {
              const element = $field[0];
              if (element && element.classList) {
                  element.classList.add('is-valid');
              }
          } else {
              console.warn('Could not find element to mark as valid:', field);
          }
      }
      
      // Validate NIC
      if (!nic) {
          showError('nic', 'NIC number is required');
      } else if (!/^([0-9]{9}[xXvV]|[0-9]{12})$/.test(nic)) {
          showError('nic', 'Please enter a valid NIC number (10 or 12 digits)');
      }
      
      // Validate Registration Date
      if (!registrationDate) {
          showError('registration_date', 'Registration date is required');
      } else {
          const selectedDate = new Date(registrationDate);
          selectedDate.setHours(0, 0, 0, 0);
          
          if (selectedDate > today) {
              showError('registration_date', 'Registration date cannot be in the future');
          } else {
              markValid('registration_date');
          }
      }
      
      // Validate Phone Number (Sri Lankan format: 0XXXXXXXXX, 10 digits starting with 0)
      if (!phoneNumber) {
          showError('phone_number', 'Phone number is required');
      } else if (!/^0[1-9]\d{8}$/.test(phoneNumber)) {
          showError('phone_number', 'Please enter a valid 10-digit Sri Lankan phone number starting with 0');
      }   else {
          markValid('phone_number');
      }
      
      // Validate WhatsApp Number (Sri Lankan format: 0XXXXXXXXX, 10 digits starting with 0)
      if (!whatsappNumber) {
          showError('whatsapp_number', 'WhatsApp number is required');
      } else if (!/^0[1-9]\d{8}$/.test(whatsappNumber)) {
          showError('whatsapp_number', 'Please enter a valid 10-digit Sri Lankan WhatsApp number starting with 0');
      }  else {
          markValid('whatsapp_number');
      }
      
      // If all validations pass, check for duplicates
      if (isValid) {
          return new Promise((resolve) => {
              // First, clear any previous NIC error
              const nicField = document.getElementById('nic');
              if (nicField) {
                  nicField.classList.remove('is-invalid');
                  const existingError = document.querySelector('#nic + .invalid-feedback.duplicate-error');
                  if (existingError) {
                      existingError.remove();
                  }
              }
              
              checkNICExists(nic, function(exists) {
                  if (exists) {
                      showError('nic', 'This NIC number is already registered');
                      resolve(false);
                  } else {
                      checkMobileNumberExists(phoneNumber, 'phone_number', function(phoneExists) {
                          if (phoneExists) {
                              showError('phone_number', 'This phone number is already registered');
                              resolve(false);
                          } else {
                              checkMobileNumberExists(whatsappNumber, 'whatsapp_number', function(whatsappExists) {
                                  if (whatsappExists) {
                                      showError('whatsapp_number', 'This WhatsApp number is already registered');
                                      resolve(false);
                                  } else {
                                      resolve(true);
                                  }
                              });
                          }
                      });
                  }
              });
          });
      }
      
      return Promise.resolve(isValid);
  };

  // Section 2 - Attachments
  $("#save_section_2").click(function () {
      saveSection("section2", [
          "passport_image", "nic_doc", "passport_doc", "professional_certificate_1",
          "working_experience", "cv_copy", "local_pcc", "pcc_color_copy",
          "local_pcc_date", "pcc_submit_date"
      ]);
  });

  // Section 3 - Other Related Qualification
  $("#save_section_3").click(function () {
      saveSection("section3", [
          "avb_qualification", "other_related_qualification",
          "related_qualification_1", "related_qualification_2", "related_qualification_3"
      ]);
  });

  // Section 4 - Emergency Contact Person
  $("#save_section_4").click(function () {
      saveSection("section4", [
          "emergency_person_name", "relationship", "emergency_person_address",
          "emergency_contact_number", "emergency_whatsapp"
      ]);
  });

  // Section 5 - Job Confirmation
  $("#save_section_5").click(function () {
      saveSection("section5", [
          "demand_name_field", "occupation", "agency_test_date", "selection_test_result",
          "job_confirm_letter_date", "job_confirm_letter_sign_date", "job_confirm_sign_attach",
          "work_permit_document"
      ]);
  });

  // Section 6 - Visa Related Docs
  $("#save_section_6").click(function () {
      saveSection("section6", [
          "online_pcc", "online_pcc_date", "work_permit_apply_date", "work_permit_issue_date",
          "work_permit_copy", "travel_insurance_copy", "travel_insurance_submit_date",
          "travel_insurance2_copy", "travel_insurance2_submit_date", "visa_file_send_date",
          "embassy_appointment_date", "job_contract_copy", "job_contract_copy_file",
          "english_copy_attach_date", "job_offer_letter_english", "job_offer_letter_romania",
          "guarantee_letter_english", "guarantee_letter_romania", "accommodation_confirmation"
      ]);
  });

  // Section 7 - Final Visa Info
  $("#save_section_7").click(function () {
      saveSection("section7", [
          "visa_status", "visa_approved_date", "beauro_training_date", "beauro_training_file",
          "final_approval_date", "final_bureau_date", "air_ticket_date", "air_ticket_copy",
          "is_completed", "note"
      ],); 
  });

  $("#save_section_8").click(function () {
    validateAndSubmitFinalSection();
});

  // Interview Details Save (Romania)
  $("#save_interview_details").click(function (e) {
      e.preventDefault();
      saveAssessmentDetails('interview');
  });

  // Pre-test Details Save (Other countries)
  $("#save_pretest_details").click(function (e) {
      e.preventDefault();
      saveAssessmentDetails('pretest');
  });

  // Function to save assessment details (interview or pretest)
  function saveAssessmentDetails(type) {
      const studentDbId = $("#student_db_id").val();
      
      if (!studentDbId) {
          swal({
              title: "Error!",
              text: "Please save Section 1 (Personal Details) first to get a student ID.",
              type: "error",
              timer: 3000,
              showConfirmButton: true
          });
          return;
      }

      let dateField, resultField;
      if (type === 'interview') {
          dateField = 'interview_date';
          resultField = 'interview_result';
      } else {
          dateField = 'pretest_date';
          resultField = 'pretest_result';
      }

      const assessmentDate = $("#" + dateField).val();
      const assessmentResult = $("#" + resultField).val();

      if (!assessmentDate) {
          swal({
              title: "Error!",
              text: "Please select the " + type + " date.",
              type: "error",
              timer: 2000,
              showConfirmButton: false
          });
          $("#" + dateField).focus();
          return;
      }

      if (!assessmentResult) {
          swal({
              title: "Error!",
              text: "Please select the " + type + " result.",
              type: "error",
              timer: 2000,
              showConfirmButton: false
          });
          $("#" + resultField).focus();
          return;
      }

      // Show loading state
      const $saveBtn = $("#save_" + type + "_details");
      const originalText = $saveBtn.html();
      $saveBtn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Saving...');

      // Prepare form data
      let formData = new FormData();
      formData.append('action', 'SAVE_ASSESSMENT');
      formData.append('agancy_student_id', studentDbId);
      formData.append('assessment_type', type);
      formData.append('assessment_date', assessmentDate);
      formData.append('assessment_result', assessmentResult);

      $.ajax({
          url: "ajax/php/agancy-student.php",
          type: "POST",
          data: formData,
          contentType: false,
          processData: false,
          dataType: "json",
          success: function(response) {
              if (response.status === "success") {
                  swal({
                      title: "Success!",
                      text: type.charAt(0).toUpperCase() + type.slice(1) + " details saved successfully!",
                      type: "success",
                      timer: 2000,
                      showConfirmButton: false
                  });
              } else {
                  swal({
                      title: "Error!",
                      text: response.message || "Failed to save " + type + " details. Please try again.",
                      type: "error",
                      timer: 3000,
                      showConfirmButton: true
                  });
              }
          },
          error: function(xhr, status, error) {
              console.error("AJAX Error:", error);
              swal({
                  title: "Error!",
                  text: "An error occurred while saving. Please try again.",
                  type: "error",
                  timer: 3000,
                  showConfirmButton: true
              });
          },
          complete: function() {
              $saveBtn.prop('disabled', false).html(originalText);
          }
      });
  }

      function validateAndSubmitFinalSection() {
    if (!$("#student_id").val() || $("#student_id").val().length === 0) {
        swal({
            title: "Error!",
            text: "Please Enter Student Id.",
            type: "error",
            timer: 2000,
            showConfirmButton: false,
        });
        return;
    }

    if (!$("#is_completed").val() || $("#is_completed").val().length === 0) {
        swal({
            title: "Error!",
            text: "Please select details complete or not complete..!",
            type: "error",
            timer: 2000,
            showConfirmButton: false,
        });
        return;
    }

    let formData = new FormData();
    formData.append("id", $("#student_db_id").val());
    formData.append("student_id", $("#student_id").val());
    formData.append("is_completed", $("#is_completed").val());
    formData.append("note", $("#note").val()); // ✅ only if 'note' exists in DB
    formData.append("section", "section8");

    $.ajax({
        url: "ajax/php/agancy-student.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (result) {
            if (result.status === "success") {
                swal({
                    title: "Success!",
                    text: "Your data saved successfully!",
                    type: "success",
                    timer: 2000,
                    showConfirmButton: false,
                });

                setTimeout(function () {
                    window.location.replace(
                        "manage-student-payments.php?id=" + result.id
                    );
                }, 2000);
            } else {
                swal({
                    title: "Error!",
                    text: "Something went wrong",
                    type: "error",
                    timer: 2000,
                    showConfirmButton: false,
                });
            }
        },
    });
}

//----------------------------------------------------------------------------

});