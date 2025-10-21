<?php

/**

 * Description of User

 *

 * @author sublime holdings

 * @web www.sublime.lk

 */
class AgancyStudent
{

    public $id;
    public $student_id;
    public $full_name;
    public $address;
    public $nic;
    public $nic_doc;
    public $birth_date;
    public $gender;
    public $passport_number;
    public $passport_image;
    public $passport_doc;
    public $professional_certificate_1;
    public $email;
    public $phone_number;
    public $whatsapp_number;
    public $emergency_contact_number;
    public $province;
    public $district;
    public $dsdivision_id;
    public $gn_division;
    public $school_attendant;
    public $other_related_qualification;
    public $related_qualification_1;
    public $related_qualification_2;
    public $related_qualification_3;
    public $emergency_person_name;
    public $relationship;
    public $emergency_person_address;
    public $emergency_whatsapp;
    public $demand_name_field;
    public $occupation;
    public $agency_test_date;
    public $selection_test_result;
    public $job_confirm_letter_date;
    public $job_confirm_letter_sign_date;
    public $job_confirm_sign_attach;
    public $work_permit_document;
    public $pcc_submit_date;
    public $pcc_color_copy;
    public $work_permit_apply_date;
    public $work_permit_issue_date;
    public $work_permit_copy;
    public $travel_insurance_copy;
    public $travel_insurance_submit_date;
    public $travel_insurance2_copy;
    public $travel_insurance2_submit_date;
    public $visa_file_send_date;
    public $embassy_appointment_date;
    public $job_contract_copy;
    public $job_contract_copy_file;
    public $english_copy_attach_date;
    public $job_offer_letter_english;
    public $job_offer_letter_romania;
    public $guarantee_letter_english;
    public $guarantee_letter_romania;
    public $accommodation_confirmation;
    public $visa_status;
    public $visa_approved_date;
    public $beauro_training_date;
    public $beauro_training_file;
    public $final_approval_date;
    public $final_bureau_date;
    public $air_ticket_date;
    public $air_ticket_copy;
    public $working_experience;
    public $cv_copy;
    public $local_pcc;
    public $online_pcc;
    public $local_pcc_date;
    public $online_pcc_date;
    public $note;
    public $createdAt;
    public $name_with_initials;
    public $is_completed;

    public function __construct($id)
    {

        if ($id) {

            $query = "SELECT * FROM `agencystudent` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysqli_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->student_id = $result['student_id'];
            $this->full_name = $result['full_name'];
            $this->address = $result['address'];
            $this->nic = $result['nic'];
            $this->nic_doc = $result['nic_doc'];
            $this->birth_date = $result['birth_date'];
            $this->gender = $result['gender'];
            $this->passport_number = $result['passport_number'];
            $this->passport_image = $result['passport_image'];
            $this->passport_doc = $result['passport_doc'];
            $this->professional_certificate_1 = $result['professional_certificate_1'];
            $this->email = $result['email'];
            $this->phone_number = $result['phone_number'];
            $this->whatsapp_number = $result['whatsapp_number'];
            $this->emergency_contact_number = $result['emergency_contact_number'];
            $this->province = $result['province'];
            $this->district = $result['district'];
            $this->dsdivision_id = $result['dsdivision_id'];
            $this->gn_division = $result['gn_division'];
            $this->school_attendant = $result['school_attendant'];
            $this->other_related_qualification = $result['other_related_qualification'];
            $this->related_qualification_1 = $result['related_qualification_1'];
            $this->related_qualification_2 = $result['related_qualification_2'];
            $this->related_qualification_3 = $result['related_qualification_3'];
            $this->emergency_person_name = $result['emergency_person_name'];
            $this->relationship = $result['relationship'];
            $this->emergency_person_address = $result['emergency_person_address'];
            $this->emergency_whatsapp = $result['emergency_whatsapp'];
            $this->demand_name_field = $result['demand_name_field'];
            $this->occupation = $result['occupation'];
            $this->agency_test_date = $result['agency_test_date'];
            $this->selection_test_result = $result['selection_test_result'];
            $this->job_confirm_letter_date = $result['job_confirm_letter_date'];
            $this->job_confirm_letter_sign_date = $result['job_confirm_letter_sign_date'];
            $this->job_confirm_sign_attach = $result['job_confirm_sign_attach'];
            $this->work_permit_document = $result['work_permit_document'];
            $this->pcc_submit_date = $result['pcc_submit_date'];
            $this->pcc_color_copy = $result['pcc_color_copy'];
            $this->work_permit_apply_date = $result['work_permit_apply_date'];
            $this->work_permit_issue_date = $result['work_permit_issue_date'];
            $this->work_permit_copy = $result['work_permit_copy'];
            $this->travel_insurance_copy = $result['travel_insurance_copy'];
            $this->travel_insurance_submit_date = $result['travel_insurance_submit_date'];
            $this->travel_insurance2_copy = $result['travel_insurance2_copy'];
            $this->travel_insurance2_submit_date = $result['travel_insurance2_submit_date'];
            $this->visa_file_send_date = $result['visa_file_send_date'];
            $this->embassy_appointment_date = $result['embassy_appointment_date'];
            $this->job_contract_copy = $result['job_contract_copy'];
            $this->job_contract_copy_file = $result['job_contract_copy_file'];
            $this->english_copy_attach_date = $result['english_copy_attach_date'];
            $this->job_offer_letter_english = $result['job_offer_letter_english'];
            $this->job_offer_letter_romania = $result['job_offer_letter_romania'];
            $this->guarantee_letter_english = $result['guarantee_letter_english'];
            $this->guarantee_letter_romania = $result['guarantee_letter_romania'];
            $this->accommodation_confirmation = $result['accommodation_confirmation'];
            $this->visa_status = $result['visa_status'];
            $this->visa_approved_date = $result['visa_approved_date'];
            $this->beauro_training_date = $result['beauro_training_date'];
            $this->beauro_training_file = $result['beauro_training_file'];
            $this->final_approval_date = $result['final_approval_date'];
            $this->final_bureau_date = $result['final_bureau_date'];
            $this->air_ticket_date = $result['air_ticket_date'];
            $this->air_ticket_copy = $result['air_ticket_copy'];
            $this->working_experience = $result['working_experience'];
            $this->cv_copy = $result['cv_copy'];
            $this->local_pcc = $result['local_pcc'];
            $this->online_pcc = $result['online_pcc'];
            $this->local_pcc_date = $result['local_pcc_date'];
            $this->online_pcc_date = $result['online_pcc_date'];
            $this->note = $result['note'];
            $this->name_with_initials = $result['name_with_initials'];
            $this->is_completed = $result['is_completed'];



            return $result;
        }
    }

    public function create()
    {

        $query = "INSERT INTO `agencystudent` ("
            . "`student_id`,`full_name`,`address`,`nic`,`nic_doc`,`birth_date`,`gender`,`passport_number`,`passport_image`,`passport_doc`,`professional_certificate_1`,`email`,`phone_number`,`whatsapp_number`,`emergency_contact_number`,"
            . "`province`,`district`,`dsdivision_id`,`gn_division`,`school_attendant`,"
            . "`other_related_qualification`,"
            . "`related_qualification_1`,`related_qualification_2`,`related_qualification_3`,`emergency_person_name`,`relationship`,`emergency_person_address`,`emergency_whatsapp`,`demand_name_field`,`occupation`,`agency_test_date`,`selection_test_result`,`job_confirm_letter_date`,`job_confirm_letter_sign_date`,`job_confirm_sign_attach`,`work_permit_document`,`pcc_submit_date`,`pcc_color_copy`,`work_permit_apply_date`,`work_permit_issue_date`,`work_permit_copy`,`travel_insurance_copy`,`travel_insurance_submit_date`,`travel_insurance2_copy`,`travel_insurance2_submit_date`,`visa_file_send_date`,`embassy_appointment_date`,`job_contract_copy`,`job_contract_copy_file`,`english_copy_attach_date`,`job_offer_letter_english`,`job_offer_letter_romania`,`guarantee_letter_english`,`guarantee_letter_romania`,`accommodation_confirmation`,`visa_status`,`visa_approved_date`,`beauro_training_date`,`beauro_training_file`,`final_approval_date`,`final_bureau_date`,`air_ticket_date`,`air_ticket_copy`,`working_experience`,`cv_copy`,`local_pcc`,`online_pcc`,`local_pcc_date`,`online_pcc_date`,"
            . "`note`, `name_with_initials`, `is_completed`) VALUES  ('"
            . $this->student_id . "','"
            . $this->full_name . "','"
            . $this->address . "','"
            . $this->nic . "','"
            . $this->nic_doc . "','"
            . $this->birth_date . "','"
            . $this->gender . "','"
            . $this->passport_number . "','"
            . $this->passport_image . "','"
            . $this->passport_doc . "','"
            . $this->professional_certificate_1 . "','"
            . $this->email . "','"
            . $this->phone_number . "','"
            . $this->whatsapp_number . "','"
            . $this->emergency_contact_number . "','"
            . $this->province . "','"
            . $this->district . "','"
            . $this->dsdivision_id . "','"
            . $this->gn_division . "','"
            . $this->school_attendant . "','"
            . $this->other_related_qualification . "','"
            . $this->related_qualification_1 . "','"
            . $this->related_qualification_2 . "','"
            . $this->related_qualification_3 . "','"
            . $this->emergency_person_name . "','"
            . $this->relationship . "','"
            . $this->emergency_person_address . "','"
            . $this->emergency_whatsapp . "','"
            . $this->demand_name_field . "','"
            . $this->occupation . "','"
            . $this->agency_test_date . "','"
            . $this->selection_test_result . "','"
            . $this->job_confirm_letter_date . "','"
            . $this->job_confirm_letter_sign_date . "','"
            . $this->job_confirm_sign_attach . "','"
            . $this->work_permit_document . "','"
            . $this->pcc_submit_date . "','"
            . $this->pcc_color_copy . "','"
            . $this->work_permit_apply_date . "','"
            . $this->work_permit_issue_date . "','"
            . $this->work_permit_copy . "','"
            . $this->travel_insurance_copy . "','"
            . $this->travel_insurance_submit_date . "','"
            . $this->travel_insurance2_copy . "','"
            . $this->travel_insurance2_submit_date . "','"
            . $this->visa_file_send_date . "','"
            . $this->embassy_appointment_date . "','"
            . $this->job_contract_copy . "','"
            . $this->job_contract_copy_file . "','"
            . $this->english_copy_attach_date . "','"
            . $this->job_offer_letter_english . "','"
            . $this->job_offer_letter_romania . "','"
            . $this->guarantee_letter_english . "','"
            . $this->guarantee_letter_romania . "','"
            . $this->accommodation_confirmation . "','"
            . $this->visa_status . "','"
            . $this->visa_approved_date . "','"
            . $this->beauro_training_date . "','"
            . $this->beauro_training_file . "','"
            . $this->final_approval_date . "','"
            . $this->final_bureau_date . "','"
            . $this->air_ticket_date . "','"
            . $this->air_ticket_copy . "','"
            . $this->working_experience . "','"
            . $this->cv_copy . "','"
            . $this->local_pcc . "','"
            . $this->online_pcc . "','"
            . $this->local_pcc_date . "','"
            . $this->online_pcc_date . "','"
            . $this->note . "','"
            . $this->name_with_initials . "','"
            . $this->is_completed . "')";


 
        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return mysqli_insert_id($db->DB_CON);
        } else {
            return FALSE;
        }
    }

    public function all()
    {



        $query = "SELECT * FROM `agencystudent` ORDER BY `student_id` ASC";

        $db = new Database();

        $result = $db->readQuery($query);

        $array_res = array();



        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row);
        }



        return $array_res;
    }

    public function getStudentByid($id)
    {
        $query = 'SELECT * FROM `agencystudent` WHERE is_certificate="' . $id . '"   ORDER BY queue ASC';
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {

            array_push($array_res, $row);
        }

        return $array_res;
    }
    public function getStudentByStudentID($student_id)
    {
        $query = 'SELECT * FROM `agencystudent` WHERE `student_id`="' . $student_id . '"';
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result;
    }
    public function getStudentByNIC($nic)
    {
        $query = 'SELECT * FROM `agencystudent` WHERE `nic`="' . $nic . '"';
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result;
    }

    public function login($username, $password)
    {



        $enPass = md5($password);

        $query = "SELECT `id`,`student_id`,`full_name`,`phone_number`,`address`,`nic`,`birth_date` FROM `agencystudent` WHERE `username`= '" . $username . "' AND `password`= '" . $enPass . "'";


        $db = new Database();

        $result = mysqli_fetch_array($db->readQuery($query));

        if (!$result) {

            return FALSE;
        } else {

            $this->id = $result['id'];
            $students = $this->__construct($this->id);
            $this->setUserSession($students);
            return $students;
        }
    }

    public function checkOldPass($id, $password)
    {



        $enPass = md5($password);



        $query = "SELECT `id` FROM `agencystudent` WHERE `id`= '" . $id . "' AND `password`= '" . $enPass . "'";



        $db = new Database();



        $result = mysqli_fetch_array($db->readQuery($query));



        if (!$result) {

            return FALSE;
        } else {

            return TRUE;
        }
    }

    public function changePassword($id, $password)
    {



        $enPass = md5($password);



        $query = "UPDATE  `agencystudent` SET "
            . "`password` ='" . $enPass . "' "
            . "WHERE `id` = '" . $id . "'";



        $db = new Database();



        $result = $db->readQuery($query);



        if ($result) {

            return TRUE;
        } else {

            return FALSE;
        }
    }

    public function authenticate()
    {



        if (!isset($_SESSION)) {

            session_start();
        }



        $id = NULL;




        if (isset($_SESSION["id"])) {

            $id = $_SESSION["id"];
        }



        $db = new Database();



        $result = mysqli_fetch_array($db->readQuery($query));



        if (!$result) {

            return FALSE;
        } else {



            return TRUE;
        }
    }

    public function logOut()
    {



        if (!isset($_SESSION)) {

            session_start();
        }



        unset($_SESSION["id"]);

        unset($_SESSION["student_id"]);

        unset($_SESSION["full_name"]);

        unset($_SESSION["phone_number"]);

        unset($_SESSION["address"]);
        unset($_SESSION["nic"]);

        unset($_SESSION["username"]);



        return TRUE;
    }




    public function update()
    {

        $query = "UPDATE  `agencystudent` SET "
            . "`student_id` ='" . $this->student_id . "', "
            . "`full_name` ='" . $this->full_name . "', "
            . "`address` ='" . $this->address . "', "
            . "`nic` ='" . $this->nic . "', "
            . "`nic_doc` ='" . $this->nic_doc . "', "
            . "`birth_date` ='" . $this->birth_date . "', "
            . "`gender` ='" . $this->gender . "', "
            . "`passport_number` ='" . $this->passport_number . "', "
            . "`passport_image` ='" . $this->passport_image . "', "
            . "`passport_doc` ='" . $this->passport_doc . "', "
            . "`professional_certificate_1` ='" . $this->professional_certificate_1 . "', "
            . "`email` ='" . $this->email . "', "
            . "`phone_number` ='" . $this->phone_number . "', "
            . "`whatsapp_number` ='" . $this->whatsapp_number . "', "
            . "`emergency_contact_number` ='" . $this->emergency_contact_number . "', "
            . "`province` ='" . $this->province . "', "
            . "`district` ='" . $this->district . "', "
            . "`dsdivision_id` ='" . $this->dsdivision_id . "', "
            . "`gn_division` ='" . $this->gn_division . "', "
            . "`school_attendant` ='" . $this->school_attendant . "', "
            . "`other_related_qualification` ='" . $this->other_related_qualification . "', "
            . "`related_qualification_1` ='" . $this->related_qualification_1 . "', "
            . "`related_qualification_2` ='" . $this->related_qualification_2 . "', "
            . "`related_qualification_3` ='" . $this->related_qualification_3 . "', "
            . "`emergency_person_name` ='" . $this->emergency_person_name . "', "
            . "`relationship` ='" . $this->relationship . "', "
            . "`emergency_person_address` ='" . $this->emergency_person_address . "', "
            . "`emergency_whatsapp` ='" . $this->emergency_whatsapp . "', "
            . "`demand_name_field` ='" . $this->demand_name_field . "', "
            . "`occupation` ='" . $this->occupation . "', "
            . "`agency_test_date` ='" . $this->agency_test_date . "', "
            . "`selection_test_result` ='" . $this->selection_test_result . "', "
            . "`job_confirm_letter_date` ='" . $this->job_confirm_letter_date . "', "
            . "`job_confirm_letter_sign_date` ='" . $this->job_confirm_letter_sign_date . "', "
            . "`job_confirm_sign_attach` ='" . $this->job_confirm_sign_attach . "', "
            . "`work_permit_document` ='" . $this->work_permit_document . "', "
            . "`pcc_submit_date` ='" . $this->pcc_submit_date . "', "
            . "`pcc_color_copy` ='" . $this->pcc_color_copy . "', "
            . "`work_permit_apply_date` ='" . $this->work_permit_apply_date . "', "
            . "`work_permit_issue_date` ='" . $this->work_permit_issue_date . "', "
            . "`work_permit_copy` ='" . $this->work_permit_copy . "', "
            . "`travel_insurance_copy` ='" . $this->travel_insurance_copy . "', "
            . "`travel_insurance_submit_date` ='" . $this->travel_insurance_submit_date . "', "
            . "`travel_insurance2_copy` ='" . $this->travel_insurance2_copy . "', "
            . "`travel_insurance2_submit_date` ='" . $this->travel_insurance2_submit_date . "', "
            . "`visa_file_send_date` ='" . $this->visa_file_send_date . "', "
            . "`embassy_appointment_date` ='" . $this->embassy_appointment_date . "', "
            . "`job_contract_copy` ='" . $this->job_contract_copy . "', "
            . "`job_contract_copy_file` ='" . $this->job_contract_copy_file . "', "
            . "`english_copy_attach_date` ='" . $this->english_copy_attach_date . "', "
            . "`job_offer_letter_english` ='" . $this->job_offer_letter_english . "', "
            . "`job_offer_letter_romania` ='" . $this->job_offer_letter_romania . "', "
            . "`guarantee_letter_english` ='" . $this->guarantee_letter_english . "', "
            . "`guarantee_letter_romania` ='" . $this->guarantee_letter_romania . "', "
            . "`accommodation_confirmation` ='" . $this->accommodation_confirmation . "', "
            . "`visa_status` ='" . $this->visa_status . "', "
            . "`visa_approved_date` ='" . $this->visa_approved_date . "', "
            . "`beauro_training_date` ='" . $this->beauro_training_date . "', "
            . "`beauro_training_file` ='" . $this->beauro_training_file . "', "
            . "`final_approval_date` ='" . $this->final_approval_date . "', "
            . "`final_bureau_date` ='" . $this->final_bureau_date . "', "
            . "`air_ticket_date` ='" . $this->air_ticket_date . "', "
            . "`air_ticket_copy` ='" . $this->air_ticket_copy . "', "
            . "`working_experience` ='" . $this->working_experience . "', "
            . "`cv_copy` ='" . $this->cv_copy . "', "
            . "`local_pcc` ='" . $this->local_pcc . "', "
            . "`online_pcc` ='" . $this->online_pcc . "', "
            . "`local_pcc_date` ='" . $this->local_pcc_date . "', "
            . "`online_pcc_date` ='" . $this->online_pcc_date . "', "
            . "`note` ='" . $this->note . "', "
            . "`name_with_initials` ='" . $this->name_with_initials . "', "
            . "`is_completed` ='" . $this->is_completed . "' "
            . "WHERE `id` = '" . $this->id . "'";


        $db = new Database();



        $result = $db->readQuery($query);



        if ($result) {

            return $this->__construct($this->id);
        } else {

            return FALSE;
        }
    }


    private function setUserSession($students)
    {



        if (!isset($_SESSION)) {

            session_start();
        }



        $_SESSION["id"] = $students['id'];

        $_SESSION["student_id"] = $students['student_id'];

        $_SESSION["full_name"] = $students['full_name'];

        $_SESSION["phone_number"] = $students['phone_number'];

        $_SESSION["address"] = $students['address'];

        $_SESSION["nic"] = $students['nic'];

        $_SESSION["birth_date"] = $students['birth_date'];

        $_SESSION["username"] = $students['username'];
    }


    

    public function SelectForgetUser($email)
    {



        if ($email) {



            $query = "SELECT `email`,`username` FROM `agencystudent` WHERE `email`= '" . $email . "'";



            $db = new Database();



            $result = mysqli_fetch_array($db->readQuery($query));



            $this->username = $result['username'];

            $this->email = $result['email'];




            return $result;
        }
    }


    //-----------------------------------------------------------------------

    public function updateSection($fields = [])
    {
        if (empty($fields) || empty($this->id)) {
            return false;
        }

        $setParts = [];
        foreach ($fields as $column => $value) {
            $setParts[] = "`$column` = '" . addslashes($value) . "'";
        }

        $setQuery = implode(", ", $setParts);
        $query = "UPDATE `agencystudent` SET $setQuery WHERE `id` = '{$this->id}'";

        $db = new Database();
        $result = $db->readQuery($query);

        return $result ? true : false;
    }


}
