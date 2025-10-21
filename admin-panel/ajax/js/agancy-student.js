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



  // Section 1 - Personal
  $("#save_section_1").click(function () {
      saveSection("section1", [
          "student_id", "full_name", "name_with_initials", "address", "nic",
          "passport_number", "birth_date", "gender", "email", "phone_number",
          "whatsapp_number", "province", "district", "dsdivision_id", "gn_division",
          "school_attendant"
      ]);
  });

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