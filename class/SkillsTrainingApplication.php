<?php

class SkillsTrainingApplication
{

    public $id;
    public $full_name;
    public $staff_id;
    public $nic;
    public $passport_number;
    public $birthday;
    public $age;
    public $gender;
    public $marital_status;
    public $mobile_number;
    public $whatsapp_number;
    public $province_id;
    public $current_job;
    public $job_abroad;
    public $type;
    public $created_at;
    public $call_date_time;
    public $call_status;
    public $employee_status;
    public $call_notes;


    public function __construct($id)
    {
        if ($id) {
            $query = "SELECT * FROM skill_training_applicant WHERE id=" . $id;
            $db = new Database();
            $result = mysqli_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->full_name = $result['full_name'];
            $this->staff_id = $result['staff_id'];
            $this->nic = $result['nic'];
            $this->passport_number = $result['passport_number'];
            $this->birthday = $result['birthday'];
            $this->age = $result['age'];
            $this->gender = $result['gender'];
            $this->marital_status = $result['marital_status'];
            $this->mobile_number = $result['mobile_number'];
            $this->whatsapp_number = $result['whatsapp_number'];
            $this->province_id = $result['province_id'];
            $this->current_job = $result['current_job'];
            $this->job_abroad = $result['job_abroad'];
            $this->type = $result['type'];
            $this->created_at = $result['created_at'];
            $this->call_date_time = $result['call_date_time'];
            $this->call_status = $result['call_status'];
            $this->employee_status = $result['employee_status'];
            $this->call_notes = $result['call_notes'];
        }
    }

    public function create()
    {
        $query = "INSERT INTO skill_training_applicant (full_name, staff_id, nic, passport_number, birthday, age, gender, marital_status, mobile_number, whatsapp_number, province_id, current_job, job_abroad, type, created_at) VALUES ('"
            . $this->full_name . "', '"
            . $this->staff_id . "', '"
            . $this->nic . "', '"
            . $this->passport_number . "', '"
            . $this->birthday . "', '"
            . $this->age . "', '"
            . $this->gender . "', '"
            . $this->marital_status . "', '"
            . $this->mobile_number . "', '"
            . $this->whatsapp_number . "', '"
            . $this->province_id . "', '"
            . $this->current_job . "', '"
            . $this->job_abroad . "', '"
            . $this->type . "', '"
            . $this->created_at . "')";


        $db = new Database();
        $result = $db->readQuery($query);

        if ($result) {
            return mysqli_insert_id($db->DB_CON);
        } else {
            return false;
        }
    }

    public function update()
    {
        $query = "UPDATE skill_training_applicant SET "
            . "full_name = '" . $this->full_name . "', "
            . "staff_id = '" . $this->staff_id . "', "
            . "nic = '" . $this->nic . "', "
            . "passport_number = '" . $this->passport_number . "', "
            . "birthday = '" . $this->birthday . "', "
            . "age = '" . $this->age . "', "
            . "gender = '" . $this->gender . "', "
            . "marital_status = '" . $this->marital_status . "', "
            . "mobile_number = '" . $this->mobile_number . "', "
            . "whatsapp_number = '" . $this->whatsapp_number . "', "
            . "province_id = '" . $this->province_id . "', "
            . "current_job = '" . $this->current_job . "', "
            . "job_abroad = '" . $this->job_abroad . "', "
            . "type = '" . $this->type . "', "
            . "created_at = '" . $this->created_at . "' ,"
            . "call_date_time = '" . $this->call_date_time . "' ,"
            . "call_status = '" . $this->call_status . "' ,"
            . "employee_status = '" . $this->employee_status . "' ,"
            . "call_notes = '" . $this->call_notes . "' "
            . "WHERE id = '" . $this->id . "'";

       
        $db = new Database();
        return $db->readQuery($query);
 
    }

    public function delete()
    {
        $query = "DELETE FROM skill_training_applicant WHERE id='" . $this->id . "'";
        $db = new Database();
        return $db->readQuery($query);
    }

    public function all()
    {
        $query = "SELECT * FROM skill_training_applicant ORDER BY created_at DESC";
        $db = new Database();
        $result = $db->readQuery($query);

        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getApplicationsByWithOutStaffId()
    {
        $query = "SELECT * FROM skill_training_applicant WHERE staff_id = 0 ORDER BY created_at DESC";
        $db = new Database();
        $result = $db->readQuery($query);

        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
    public function getApplicationsByWithStaffId($staff_id, $call_status = '', $employee_status = '')
    {
        $db = new Database();
        $query = "SELECT * FROM skill_training_applicant WHERE staff_id = $staff_id ";
        
        // Add call status filter if provided
        if (!empty($call_status)) {
            $call_status = mysqli_real_escape_string($db->DB_CON, $call_status);
            $query .= " AND call_status = '$call_status' ";
        }
        
        // Add employee status filter if provided
        if (!empty($employee_status)) {
            $employee_status = mysqli_real_escape_string($db->DB_CON, $employee_status);
            $query .= " AND employee_status = '$employee_status' ";
        }
        
        $query .= " ORDER BY created_at DESC";
        
        $result = $db->readQuery($query);

        $array_res = array();
        if ($result) {
            while ($row = mysqli_fetch_array($result)) {
                array_push($array_res, $row);
            }
        }

        return $array_res;
    }
}
