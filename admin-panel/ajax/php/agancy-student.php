<?php

include '../../../class/include.php';
header('Content-Type: application/json; charset=UTF8');

//------------------------------------------------------------------
 
if (isset($_POST['section'])) {
    $SECTION = $_POST['section'];
    $STUDENT = !empty($_POST['id']) ? new AgancyStudent($_POST['id']) : new AgancyStudent(NULL);

    $fields = [];


    // SECTION 1: PERSONAL INFO
    if ($SECTION === "section1") {
        $fields = [
            'student_id' => strtoupper($_POST['student_id']),
            'full_name' => strtoupper($_POST['full_name']),
            'name_with_initials' => $_POST['name_with_initials'],
            'address' => $_POST['address'],
            'nic' => $_POST['nic'],
            'passport_number' => $_POST['passport_number'],
            'birth_date' => $_POST['birth_date'],
            'gender' => $_POST['gender'],
            'email' => $_POST['email'],
            'phone_number' => $_POST['phone_number'],
            'whatsapp_number' => $_POST['whatsapp_number'],
            'province' => $_POST['province'],
            'district' => $_POST['district'],
            'dsdivision_id' => $_POST['dsdivision_id'],
            'gn_division' => $_POST['gn_division'],
            'school_attendant' => $_POST['school_attendant'],
            'country' => $_POST['country'],
            'registration_date' => $_POST['registration_date']
        ];

        if (!empty($_POST['id'])) {
            $STUDENT->updateSection($fields);
            echo json_encode(["status" => "success", "id" => $_POST['id']]);
        } else {
            foreach ($fields as $key => $value) {
                $STUDENT->$key = $value;
            }
            $inserted_id = $STUDENT->create();
            echo json_encode(["status" => "success", "id" => $inserted_id]);
        }
        exit();
    }

    // SECTION 2: ATTACHMENTS
    if ($SECTION === "section2") {
        $upload_dir = "../../../upload/agancy/files/";
        $upload_fields = [
            'nic_doc', 'passport_doc', 'professional_certificate_1',
            'working_experience', 'cv_copy', 'local_pcc', 'pcc_color_copy'
        ];

        foreach ($upload_fields as $field) {
            if (isset($_FILES[$field]) && $_FILES[$field]['name']) {
                $ext = pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION);
                $filename = uniqid() . '.' . $ext;
                move_uploaded_file($_FILES[$field]['tmp_name'], $upload_dir . $filename);
                $fields[$field] = $filename;
            }
        }

        // ✅ Special handling for passport_image with cropping
        if (isset($_FILES['passport_image']) && $_FILES['passport_image']['name']) {
            $dir_dest = '../../../upload/agancy/passport/';
            $handle = new Upload($_FILES['passport_image']);
            $HELP = new Helper();
            $imgName = null;

            if ($handle->uploaded) {
                $handle->image_resize = true;
                $handle->file_new_name_ext = 'jpg';
                $handle->image_ratio_crop = 'C';
                $handle->file_new_name_body = $HELP->randamId();
                $handle->image_x = 600;
                $handle->image_y = 600;

                $handle->Process($dir_dest);

                if ($handle->processed) {
                    $imgName = $handle->file_dst_name;
                    $fields['passport_image'] = $imgName;
                }
            }
        }

        $fields['local_pcc_date'] = $_POST['local_pcc_date'] ?? '';
        $fields['pcc_submit_date'] = $_POST['pcc_submit_date'] ?? '';

        if (!empty($_POST['id'])) {
            $STUDENT->updateSection($fields);
            echo json_encode(["status" => "success", "id" => $_POST['id']]);
        } else {
            foreach ($fields as $key => $value) {
                $STUDENT->$key = $value;
            }
            $inserted_id = $STUDENT->create();
            echo json_encode(["status" => "success", "id" => $inserted_id]);
        }
        exit();
    }

        // SECTION 3: Other Qualifications
        if ($SECTION === "section3") {
            $upload_dir = "../../../upload/agancy/files/";
            $fields = [
                'other_related_qualification' => $_POST['other_related_qualification'] ?? ''
            ];

            $upload_fields = [
                'related_qualification_1',
                'related_qualification_2',
                'related_qualification_3'
            ];

            foreach ($upload_fields as $field) {
                if (isset($_FILES[$field]) && $_FILES[$field]['name']) {
                    $ext = pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION);
                    $filename = uniqid() . '.' . $ext;
                    move_uploaded_file($_FILES[$field]['tmp_name'], $upload_dir . $filename);
                    $fields[$field] = $filename;
                }
            }

            $STUDENT->updateSection($fields);
            echo json_encode(["status" => "success", "id" => $STUDENT->id]);
            exit();
        }

        // SECTION 4: Emergency Contact
        if ($SECTION === "section4") {
            $fields = [
                'emergency_person_name' => $_POST['emergency_person_name'],
                'relationship' => $_POST['relationship'],
                'emergency_person_address' => $_POST['emergency_person_address'],
                'emergency_contact_number' => $_POST['emergency_contact_number'],
                'emergency_whatsapp' => $_POST['emergency_whatsapp']
            ];
            $STUDENT->updateSection($fields);
            echo json_encode(["status" => "success", "id" => $STUDENT->id]);
            exit();
        }

        // SECTION 5: Job Confirmation
        if ($SECTION === "section5") {
            $upload_dir = "../../../upload/agancy/files/";
            $fields = [
                'demand_name_field' => $_POST['demand_name_field'],
                'occupation' => $_POST['occupation'],
                'agency_test_date' => $_POST['agency_test_date'],
                'selection_test_result' => $_POST['selection_test_result'],
                'job_confirm_letter_date' => $_POST['job_confirm_letter_date'],
                'job_confirm_letter_sign_date' => $_POST['job_confirm_letter_sign_date'],
                'work_permit_document' => $_POST['work_permit_document']
            ];

            if (isset($_FILES['job_confirm_sign_attach']) && $_FILES['job_confirm_sign_attach']['name']) {
                $ext = pathinfo($_FILES['job_confirm_sign_attach']['name'], PATHINFO_EXTENSION);
                $filename = uniqid() . '.' . $ext;
                move_uploaded_file($_FILES['job_confirm_sign_attach']['tmp_name'], $upload_dir . $filename);
                $fields['job_confirm_sign_attach'] = $filename;
            }

            $STUDENT->updateSection($fields);
            echo json_encode(["status" => "success", "id" => $STUDENT->id]);
            exit();
        }

        // SECTION 6: Visa Documents
        if ($SECTION === "section6") {
            $upload_dir = "../../../upload/agancy/files/";
            $fields = [
                'online_pcc_date' => $_POST['online_pcc_date'],
                'work_permit_apply_date' => $_POST['work_permit_apply_date'],
                'work_permit_issue_date' => $_POST['work_permit_issue_date'],
                'travel_insurance_submit_date' => $_POST['travel_insurance_submit_date'],
                'travel_insurance2_submit_date' => $_POST['travel_insurance2_submit_date'],
                'visa_file_send_date' => $_POST['visa_file_send_date'],
                'embassy_appointment_date' => $_POST['embassy_appointment_date'],
                'job_contract_copy' => $_POST['job_contract_copy'],
                'english_copy_attach_date' => $_POST['english_copy_attach_date']
            ];

            $uploads = [
                'online_pcc', 'work_permit_copy', 'travel_insurance_copy',
                'travel_insurance2_copy', 'job_contract_copy_file',
                'job_offer_letter_english', 'job_offer_letter_romania',
                'guarantee_letter_english', 'guarantee_letter_romania',
                'accommodation_confirmation'
            ];

            foreach ($uploads as $field) {
                if (isset($_FILES[$field]) && $_FILES[$field]['name']) {
                    $ext = pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION);
                    $filename = uniqid() . '.' . $ext;
                    move_uploaded_file($_FILES[$field]['tmp_name'], $upload_dir . $filename);
                    $fields[$field] = $filename;
                }
            }

            $STUDENT->updateSection($fields);
            echo json_encode(["status" => "success", "id" => $STUDENT->id]);
            exit();
        }

        // SECTION 7: Visa Final Info
        if ($SECTION === "section7") {
            $upload_dir = "../../../upload/agancy/files/";
            $fields = [
                'visa_status' => $_POST['visa_status'],
                'visa_approved_date' => $_POST['visa_approved_date'],
                'beauro_training_date' => $_POST['beauro_training_date'],
                'final_approval_date' => $_POST['final_approval_date'],
                'final_bureau_date' => $_POST['final_bureau_date'],
                'air_ticket_date' => $_POST['air_ticket_date'],
                'is_completed' => $_POST['is_completed'],
                'note' => $_POST['note']
            ];

            if (isset($_FILES['beauro_training_file']) && $_FILES['beauro_training_file']['name']) {
                $filename = uniqid() . '.' . pathinfo($_FILES['beauro_training_file']['name'], PATHINFO_EXTENSION);
                move_uploaded_file($_FILES['beauro_training_file']['tmp_name'], $upload_dir . $filename);
                $fields['beauro_training_file'] = $filename;
            }

            if (isset($_FILES['air_ticket_copy']) && $_FILES['air_ticket_copy']['name']) {
                $filename = uniqid() . '.' . pathinfo($_FILES['air_ticket_copy']['name'], PATHINFO_EXTENSION);
                move_uploaded_file($_FILES['air_ticket_copy']['tmp_name'], $upload_dir . $filename);
                $fields['air_ticket_copy'] = $filename;
            }

            $STUDENT->updateSection($fields);
            echo json_encode(["status" => "success", "id" => $STUDENT->id]);
            exit();
        }

        // SECTION 8: Final Submission & Remarks
        if ($SECTION === "section8") {
            $fields = [
                'is_completed' => $_POST['is_completed'] ?? '',
                'note' => $_POST['note'] ?? ''
            ];

            $STUDENT->updateSection($fields);
            echo json_encode(["status" => "success", "id" => $STUDENT->id]);
            exit();
}


}



//-----------------------------------------------------------------




if (isset($_POST['create'])) {

    $STUDENT = new AgancyStudent(NULL);

    $STUDENT->student_id = strtoupper($_POST['student_id']);
    $STUDENT->full_name = strtoupper($_POST['full_name']);
    $STUDENT->name_with_initials = $_POST['name_with_initials'];
    $STUDENT->address = ucfirst($_POST['address']);
    $STUDENT->nic = $_POST['nic'];

    $finalDir = "../../../upload/students/";

    

    $uploadDir = '../../../upload/agancy/files/';
    //nic doc

    $fileName = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['nic_doc']['name']);
    $uploadFilePath = $uploadDir . $fileName;


    if (move_uploaded_file($_FILES['nic_doc']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 

        $STUDENT->nic_doc = $fileName;
    }

    $STUDENT->birth_date = $_POST['birth_date'];
    $STUDENT->gender = $_POST['gender'];
    $STUDENT->passport_number = $_POST['passport_number'];
    $STUDENT->local_pcc_date = $_POST['local_pcc_date'];
    $STUDENT->online_pcc_date = $_POST['online_pcc_date'];

    //passport doc 
    $fileName1 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['passport_doc']['name']);
    $uploadFilePath = $uploadDir . $fileName1;


    if (move_uploaded_file($_FILES['passport_doc']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->passport_doc = $fileName1;
    }

    //professional_certificate_1 
    $fileName9 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['professional_certificate_1']['name']);
    $uploadFilePath = $uploadDir . $fileName9;


    if (move_uploaded_file($_FILES['professional_certificate_1']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->professional_certificate_1 = $fileName9;
    }


    //working_experience
    $fileName13 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['working_experience']['name']);
    $uploadFilePath = $uploadDir . $fileName13;


    if (move_uploaded_file($_FILES['working_experience']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->working_experience = $fileName13;
    }

    //cv_copy
    $fileName14 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['cv_copy']['name']);
    $uploadFilePath = $uploadDir . $fileName14;


    if (move_uploaded_file($_FILES['cv_copy']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->cv_copy = $fileName14;
    }

    //local_pcc
    $fileName15 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['local_pcc']['name']);
    $uploadFilePath = $uploadDir . $fileName15;


    if (move_uploaded_file($_FILES['local_pcc']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->local_pcc = $fileName15;
    }


    //online_pcc
    $fileName16 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['online_pcc']['name']);
    $uploadFilePath = $uploadDir . $fileName16;


    if (move_uploaded_file($_FILES['online_pcc']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->online_pcc = $fileName16;
    }

    //job_confirm_sign_attach
    $fileName17 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['job_confirm_sign_attach']['name']);
    $uploadFilePath = $uploadDir . $fileName17;


    if (move_uploaded_file($_FILES['job_confirm_sign_attach']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->job_confirm_sign_attach = $fileName17;
    }

    
    //pcc_color_copy
    $fileName18 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['pcc_color_copy']['name']);
    $uploadFilePath = $uploadDir . $fileName18;


    if (move_uploaded_file($_FILES['pcc_color_copy']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->pcc_color_copy = $fileName18;
    }


    //work_permit_copy
    $fileName19 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['work_permit_copy']['name']);
    $uploadFilePath = $uploadDir . $fileName19;


    if (move_uploaded_file($_FILES['work_permit_copy']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->work_permit_copy = $fileName19;
    }


    //travel_insurance_copy
    $fileName20 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['travel_insurance_copy']['name']);
    $uploadFilePath = $uploadDir . $fileName20;


    if (move_uploaded_file($_FILES['travel_insurance_copy']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->travel_insurance_copy = $fileName20;
    }


    //travel_insurance2_copy
    $fileName21 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['travel_insurance2_copy']['name']);
    $uploadFilePath = $uploadDir . $fileName21;


    if (move_uploaded_file($_FILES['travel_insurance2_copy']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->travel_insurance2_copy = $fileName21;
    }


    //job_contract_copy_file
    $fileName22 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['job_contract_copy_file']['name']);
    $uploadFilePath = $uploadDir . $fileName22;


    if (move_uploaded_file($_FILES['job_contract_copy_file']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->job_contract_copy_file = $fileName22;
    }


    //job_offer_letter_english
    $fileName23 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['job_offer_letter_english']['name']);
    $uploadFilePath = $uploadDir . $fileName23;


    if (move_uploaded_file($_FILES['job_offer_letter_english']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->job_offer_letter_english = $fileName23;
    }


    //job_offer_letter_romania
    $fileName24 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['job_offer_letter_romania']['name']);
    $uploadFilePath = $uploadDir . $fileName24;


    if (move_uploaded_file($_FILES['job_offer_letter_romania']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->job_offer_letter_romania = $fileName24;
    }


    //guarantee_letter_english
    $fileName25 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['guarantee_letter_english']['name']);
    $uploadFilePath = $uploadDir . $fileName25;


    if (move_uploaded_file($_FILES['guarantee_letter_english']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->guarantee_letter_english = $fileName25;
    }


    //guarantee_letter_romania
    $fileName26 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['guarantee_letter_romania']['name']);
    $uploadFilePath = $uploadDir . $fileName26;


    if (move_uploaded_file($_FILES['guarantee_letter_romania']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->guarantee_letter_romania = $fileName26;
    }


    //accommodation_confirmation
    $fileName27 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['accommodation_confirmation']['name']);
    $uploadFilePath = $uploadDir . $fileName27;


    if (move_uploaded_file($_FILES['accommodation_confirmation']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->accommodation_confirmation = $fileName27;
    }


    //beauro_training_file
    $fileName28 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['beauro_training_file']['name']);
    $uploadFilePath = $uploadDir . $fileName28;


    if (move_uploaded_file($_FILES['beauro_training_file']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->beauro_training_file = $fileName28;
    }


    //beauro_training_file
    $fileName29 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['air_ticket_copy']['name']);
    $uploadFilePath = $uploadDir . $fileName29;


    if (move_uploaded_file($_FILES['air_ticket_copy']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->air_ticket_copy = $fileName29;
    }


    //related_qualification_1
    $fileName6 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['related_qualification_1']['name']);
    $uploadFilePath = $uploadDir . $fileName6;


    if (move_uploaded_file($_FILES['related_qualification_1']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->related_qualification_1 = $fileName6;
    }



    //professional_certificate_3
    $fileName7 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['related_qualification_2']['name']);
    $uploadFilePath = $uploadDir . $fileName7;


    if (move_uploaded_file($_FILES['related_qualification_2']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->related_qualification_2 = $fileName7;
    }



    //related_qualification_3
    $fileName8 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['related_qualification_3']['name']);
    $uploadFilePath = $uploadDir . $fileName8;


    if (move_uploaded_file($_FILES['related_qualification_3']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->related_qualification_3 = $fileName8;
    }



    $dir_dest = '../../../upload/agancy/passport/';

    $handle = new Upload($_FILES['passport_image']);
    $HELP = new Helper();
    $imgName = null;

    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_ext = 'jpg';
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = $HELP->randamId();
        $handle->image_x = 600;
        $handle->image_y = 600;

        $handle->Process($dir_dest);

        if ($handle->processed) {
            $info = getimagesize($handle->file_dst_pathname);
            $imgName = $handle->file_dst_name;
        }
    }

    $STUDENT->passport_image = $imgName;

    $STUDENT->email = $_POST['email'];
    $STUDENT->phone_number = $_POST['phone_number'];
    $STUDENT->whatsapp_number = $_POST['whatsapp_number'];
    $STUDENT->emergency_contact_number = $_POST['emergency_contact_number'];
    $STUDENT->province = $_POST['province'];
    $STUDENT->district = $_POST['district'];
    $STUDENT->dsdivision_id = $_POST['dsdivision_id'];
    $STUDENT->gn_division = $_POST['gn_division'];
    $STUDENT->school_attendant = ucfirst($_POST['school_attendant']);
    $STUDENT->other_related_qualification = ucfirst($_POST['other_related_qualification']);
    $STUDENT->emergency_person_name = ucfirst($_POST['emergency_person_name']);
    $STUDENT->relationship = ucfirst($_POST['relationship']);
    $STUDENT->emergency_person_address = ucfirst($_POST['emergency_person_address']);
    $STUDENT->emergency_whatsapp = ucfirst($_POST['emergency_whatsapp']);
    $STUDENT->demand_name_field = ucfirst($_POST['demand_name_field']);
    $STUDENT->occupation = ucfirst($_POST['occupation']);
    $STUDENT->agency_test_date = ucfirst($_POST['agency_test_date']);
    $STUDENT->selection_test_result = ucfirst($_POST['selection_test_result']);
    $STUDENT->job_confirm_letter_date = ucfirst($_POST['job_confirm_letter_date']);
    $STUDENT->job_confirm_letter_sign_date = ucfirst($_POST['job_confirm_letter_sign_date']);
    $STUDENT->work_permit_document = ucfirst($_POST['work_permit_document']);
    $STUDENT->pcc_submit_date = ucfirst($_POST['pcc_submit_date']);
    $STUDENT->work_permit_apply_date = ucfirst($_POST['work_permit_apply_date']);
    $STUDENT->work_permit_issue_date = ucfirst($_POST['work_permit_issue_date']);
    $STUDENT->travel_insurance_submit_date = ucfirst($_POST['travel_insurance_submit_date']);
    $STUDENT->travel_insurance2_submit_date = ucfirst($_POST['travel_insurance2_submit_date']);
    $STUDENT->visa_file_send_date = ucfirst($_POST['visa_file_send_date']);
    $STUDENT->embassy_appointment_date = ucfirst($_POST['embassy_appointment_date']);
    $STUDENT->job_contract_copy = ucfirst($_POST['job_contract_copy']);
    $STUDENT->english_copy_attach_date = ucfirst($_POST['english_copy_attach_date']);
    $STUDENT->visa_status = ucfirst($_POST['visa_status']);
    $STUDENT->visa_approved_date = ucfirst($_POST['visa_approved_date']);
    $STUDENT->beauro_training_date = ucfirst($_POST['beauro_training_date']);
    $STUDENT->final_approval_date = ucfirst($_POST['final_approval_date']);
    $STUDENT->final_bureau_date = ucfirst($_POST['final_bureau_date']);
    $STUDENT->air_ticket_date = ucfirst($_POST['air_ticket_date']);
    $STUDENT->note = $_POST['note'];
    $STUDENT->is_completed = $_POST['is_completed'];
    //Working Experience CV uploard


    // if (isset($_POST['certificate_01'])) {
    //     $STUDENT->certificate_01 = 1;
    // } else {
    //     $STUDENT->certificate_01 = 0;
    // }
    // if (isset($_POST['certificate_02'])) {
    //     $STUDENT->certificate_02 = 1;
    // } else {
    //     $STUDENT->certificate_02 = 0;
    // }
    // if (isset($_POST['certificate_03'])) {
    //     $STUDENT->certificate_03 = 1;
    // } else {
    //     $STUDENT->certificate_03 = 0;
    // }



    $res = $STUDENT->create();

    if ($res) {
        $result = [
            "status" => 'success',
            "id" => $res,
        ];
        echo json_encode($result);
        exit();
    } else {
        $result = [
            "status" => 'error'
        ];
        echo json_encode($result);
        exit();
    }

    
}

if (isset($_POST['update'])) {

    $STUDENT = new AgancyStudent($_POST['id']);

    $STUDENT->student_id = strtoupper($_POST['student_id']);
    $STUDENT->full_name = strtoupper($_POST['full_name']);
    $STUDENT->name_with_initials = $_POST['name_with_initials'];
    $STUDENT->address = ucfirst($_POST['address']);
    $STUDENT->nic = $_POST['nic'];

    $uploadDir = '../../../upload/agancy/files/';
    //nic doc

    $fileName = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['nic_doc']['name']);
    $uploadFilePath = $uploadDir . $fileName;


    if (move_uploaded_file($_FILES['nic_doc']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 

        $STUDENT->nic_doc = $fileName;
    }


    $STUDENT->birth_date = $_POST['birth_date'];
    $STUDENT->gender = $_POST['gender'];
    $STUDENT->passport_number = $_POST['passport_number'];
    $STUDENT->local_pcc_date = $_POST['local_pcc_date'];
    $STUDENT->online_pcc_date = $_POST['online_pcc_date'];

    //passport doc 
    $fileName1 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['passport_doc']['name']);
    $uploadFilePath = $uploadDir . $fileName1;


    if (move_uploaded_file($_FILES['passport_doc']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->passport_doc = $fileName1;
    }


    //passport doc 
    $fileName1 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['passport_doc']['name']);
    $uploadFilePath = $uploadDir . $fileName1;


    if (move_uploaded_file($_FILES['passport_doc']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->passport_doc = $fileName1;
    }

    //professional_certificate_1 
    $fileName9 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['professional_certificate_1']['name']);
    $uploadFilePath = $uploadDir . $fileName9;


    if (move_uploaded_file($_FILES['professional_certificate_1']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->professional_certificate_1 = $fileName9;
    }


    //working_experience
    $fileName13 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['working_experience']['name']);
    $uploadFilePath = $uploadDir . $fileName13;


    if (move_uploaded_file($_FILES['working_experience']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->working_experience = $fileName13;
    }

    //cv_copy
    $fileName14 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['cv_copy']['name']);
    $uploadFilePath = $uploadDir . $fileName14;


    if (move_uploaded_file($_FILES['cv_copy']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->cv_copy = $fileName14;
    }

    //local_pcc
    $fileName15 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['local_pcc']['name']);
    $uploadFilePath = $uploadDir . $fileName15;


    if (move_uploaded_file($_FILES['local_pcc']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->local_pcc = $fileName15;
    }


    //online_pcc
    $fileName16 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['online_pcc']['name']);
    $uploadFilePath = $uploadDir . $fileName16;


    if (move_uploaded_file($_FILES['online_pcc']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->online_pcc = $fileName16;
    }

    //job_confirm_sign_attach
    $fileName17 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['job_confirm_sign_attach']['name']);
    $uploadFilePath = $uploadDir . $fileName17;


    if (move_uploaded_file($_FILES['job_confirm_sign_attach']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->job_confirm_sign_attach = $fileName17;
    }

    
    //pcc_color_copy
    $fileName18 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['pcc_color_copy']['name']);
    $uploadFilePath = $uploadDir . $fileName18;


    if (move_uploaded_file($_FILES['pcc_color_copy']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->pcc_color_copy = $fileName18;
    }


    //work_permit_copy
    $fileName19 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['work_permit_copy']['name']);
    $uploadFilePath = $uploadDir . $fileName19;


    if (move_uploaded_file($_FILES['work_permit_copy']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->work_permit_copy = $fileName19;
    }


    //travel_insurance_copy
    $fileName20 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['travel_insurance_copy']['name']);
    $uploadFilePath = $uploadDir . $fileName20;


    if (move_uploaded_file($_FILES['travel_insurance_copy']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->travel_insurance_copy = $fileName20;
    }


    //travel_insurance2_copy
    $fileName21 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['travel_insurance2_copy']['name']);
    $uploadFilePath = $uploadDir . $fileName21;


    if (move_uploaded_file($_FILES['travel_insurance2_copy']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->travel_insurance2_copy = $fileName21;
    }


    //job_contract_copy_file
    $fileName22 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['job_contract_copy_file']['name']);
    $uploadFilePath = $uploadDir . $fileName22;


    if (move_uploaded_file($_FILES['job_contract_copy_file']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->job_contract_copy_file = $fileName22;
    }


    //job_offer_letter_english
    $fileName23 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['job_offer_letter_english']['name']);
    $uploadFilePath = $uploadDir . $fileName23;


    if (move_uploaded_file($_FILES['job_offer_letter_english']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->job_offer_letter_english = $fileName23;
    }


    //job_offer_letter_romania
    $fileName24 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['job_offer_letter_romania']['name']);
    $uploadFilePath = $uploadDir . $fileName24;


    if (move_uploaded_file($_FILES['job_offer_letter_romania']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->job_offer_letter_romania = $fileName24;
    }


    //guarantee_letter_english
    $fileName25 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['guarantee_letter_english']['name']);
    $uploadFilePath = $uploadDir . $fileName25;


    if (move_uploaded_file($_FILES['guarantee_letter_english']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->guarantee_letter_english = $fileName25;
    }


    //guarantee_letter_romania
    $fileName26 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['guarantee_letter_romania']['name']);
    $uploadFilePath = $uploadDir . $fileName26;


    if (move_uploaded_file($_FILES['guarantee_letter_romania']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->guarantee_letter_romania = $fileName26;
    }


    //accommodation_confirmation
    $fileName27 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['accommodation_confirmation']['name']);
    $uploadFilePath = $uploadDir . $fileName27;


    if (move_uploaded_file($_FILES['accommodation_confirmation']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->accommodation_confirmation = $fileName27;
    }


    //beauro_training_file
    $fileName28 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['beauro_training_file']['name']);
    $uploadFilePath = $uploadDir . $fileName28;


    if (move_uploaded_file($_FILES['beauro_training_file']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->beauro_training_file = $fileName28;
    }


    //beauro_training_file
    $fileName29 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['air_ticket_copy']['name']);
    $uploadFilePath = $uploadDir . $fileName29;


    if (move_uploaded_file($_FILES['air_ticket_copy']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->air_ticket_copy = $fileName29;
    }


    //related_qualification_1
    $fileName6 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['related_qualification_1']['name']);
    $uploadFilePath = $uploadDir . $fileName6;


    if (move_uploaded_file($_FILES['related_qualification_1']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->related_qualification_1 = $fileName6;
    }



    //professional_certificate_3
    $fileName7 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['related_qualification_2']['name']);
    $uploadFilePath = $uploadDir . $fileName7;


    if (move_uploaded_file($_FILES['related_qualification_2']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->related_qualification_2 = $fileName7;
    }



    //related_qualification_3
    $fileName8 = round(microtime(true) * 1000) . '_' . rand(1111, 9999) . '.' . basename($_FILES['related_qualification_3']['name']);
    $uploadFilePath = $uploadDir . $fileName8;


    if (move_uploaded_file($_FILES['related_qualification_3']['tmp_name'], $uploadFilePath)) {
        // Insert file information in the database 


        $STUDENT->related_qualification_3 = $fileName8;
    }



    $dir_dest = '../../../upload/agancy/passport/';
    $handle = new Upload($_FILES['passport_image']);
    $HELP = new Helper();

    if ($handle->uploaded) {
        $handle->image_resize = true;
        $handle->file_new_name_ext = 'jpg';
        $handle->image_ratio_crop = 'C';
        $handle->file_new_name_body = $HELP->randamId();
        $handle->image_x = 600;
        $handle->image_y = 600;

        $handle->Process($dir_dest);

        if ($handle->processed) {
            $STUDENT->passport_image = $handle->file_dst_name;
        }
    } else {
        // Keep old image if no new one uploaded
        $STUDENT->passport_image = $STUDENT->passport_image;
    }


    $STUDENT->email = $_POST['email'];
    $STUDENT->phone_number = $_POST['phone_number'];
    $STUDENT->whatsapp_number = $_POST['whatsapp_number'];
    $STUDENT->emergency_contact_number = $_POST['emergency_contact_number'];
    $STUDENT->province = $_POST['province'];
    $STUDENT->district = $_POST['district'];
    $STUDENT->dsdivision_id = $_POST['dsdivision_id'];
    $STUDENT->gn_division = $_POST['gn_division'];
    $STUDENT->school_attendant = ucfirst($_POST['school_attendant']);
    $STUDENT->other_related_qualification = ucfirst($_POST['other_related_qualification']);
    $STUDENT->emergency_person_name = ucfirst($_POST['emergency_person_name']);
    $STUDENT->relationship = ucfirst($_POST['relationship']);
    $STUDENT->emergency_person_address = ucfirst($_POST['emergency_person_address']);
    $STUDENT->emergency_whatsapp = ucfirst($_POST['emergency_whatsapp']);
    $STUDENT->demand_name_field = ucfirst($_POST['demand_name_field']);
    $STUDENT->occupation = ucfirst($_POST['occupation']);
    $STUDENT->agency_test_date = ucfirst($_POST['agency_test_date']);
    $STUDENT->selection_test_result = ucfirst($_POST['selection_test_result']);
    $STUDENT->job_confirm_letter_date = ucfirst($_POST['job_confirm_letter_date']);
    $STUDENT->job_confirm_letter_sign_date = ucfirst($_POST['job_confirm_letter_sign_date']);
    $STUDENT->work_permit_document = ucfirst($_POST['work_permit_document']);
    $STUDENT->pcc_submit_date = ucfirst($_POST['pcc_submit_date']);
    $STUDENT->work_permit_apply_date = ucfirst($_POST['work_permit_apply_date']);
    $STUDENT->work_permit_issue_date = ucfirst($_POST['work_permit_issue_date']);
    $STUDENT->travel_insurance_submit_date = ucfirst($_POST['travel_insurance_submit_date']);
    $STUDENT->travel_insurance2_submit_date = ucfirst($_POST['travel_insurance2_submit_date']);
    $STUDENT->visa_file_send_date = ucfirst($_POST['visa_file_send_date']);
    $STUDENT->embassy_appointment_date = ucfirst($_POST['embassy_appointment_date']);
    $STUDENT->job_contract_copy = ucfirst($_POST['job_contract_copy']);
    $STUDENT->english_copy_attach_date = ucfirst($_POST['english_copy_attach_date']);
    $STUDENT->visa_status = ucfirst($_POST['visa_status']);
    $STUDENT->visa_approved_date = ucfirst($_POST['visa_approved_date']);
    $STUDENT->beauro_training_date = ucfirst($_POST['beauro_training_date']);
    $STUDENT->final_approval_date = ucfirst($_POST['final_approval_date']);
    $STUDENT->final_bureau_date = ucfirst($_POST['final_bureau_date']);
    $STUDENT->air_ticket_date = ucfirst($_POST['air_ticket_date']);
    $STUDENT->note = $_POST['note'];
    $STUDENT->is_completed = $_POST['is_completed'];



    $res = $STUDENT->update();

    if ($res) {
        $result = [
            "status" => 'success',
            "id" => $res,
        ];
        echo json_encode($result);
        exit();
    } else {
        $result = [
            "status" => 'error'
        ];
        echo json_encode($result);
        exit();
    }
}

if (isset($_POST['save-data'])) {

    foreach ($_POST['sort'] as $key => $img) {
        $key = $key + 1;

        $STUDENT = Brand::arrange($key, $img);
        header("location: ../arrange-brand.php?message=9");
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'CHECKSTUID') {

    $STUDENT = new AgancyStudent(NULL);
    $student = $STUDENT->getStudentByStudentID($_POST['student_id']);

    $arr = [];
    if ($student) {
        $arr['status'] = 'exist';
    } else {
        $arr['status'] = 'not_exist';
    }

    echo json_encode($arr);
    exit();
}

?>