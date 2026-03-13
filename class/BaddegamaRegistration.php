<?php

class BaddegamaRegistration
{

    public $id;
    public $full_name;
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
    public $experience;
    public $destination_country;


    public function __construct($id)
    {
        if ($id) {
            $query = "SELECT * FROM baddegama_registration WHERE id=" . (int)$id;
            $db = new Database();
            $result = mysqli_fetch_array($db->readQuery($query));

            if ($result) {
                $this->id = $result['id'];
                $this->full_name = $result['full_name'];
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
                $this->experience = $result['experience'];
                $this->destination_country = $result['destination_country'];
            }
        }
    }

    public function create()
    {
        $db = new Database();
        $query = "INSERT INTO baddegama_registration (full_name, nic, passport_number, birthday, age, gender, marital_status, mobile_number, whatsapp_number, province_id, current_job, job_abroad, type, created_at, experience, destination_country) VALUES ('"
            . mysqli_real_escape_string($db->DB_CON, (string)$this->full_name) . "', '"
            . mysqli_real_escape_string($db->DB_CON, (string)$this->nic) . "', '"
            . mysqli_real_escape_string($db->DB_CON, (string)$this->passport_number) . "', '"
            . mysqli_real_escape_string($db->DB_CON, (string)$this->birthday) . "', '"
            . mysqli_real_escape_string($db->DB_CON, (string)$this->age) . "', '"
            . mysqli_real_escape_string($db->DB_CON, (string)$this->gender) . "', '"
            . mysqli_real_escape_string($db->DB_CON, (string)$this->marital_status) . "', '"
            . mysqli_real_escape_string($db->DB_CON, (string)$this->mobile_number) . "', '"
            . mysqli_real_escape_string($db->DB_CON, (string)$this->whatsapp_number) . "', '"
            . mysqli_real_escape_string($db->DB_CON, (string)$this->province_id) . "', '"
            . mysqli_real_escape_string($db->DB_CON, (string)$this->current_job) . "', '"
            . mysqli_real_escape_string($db->DB_CON, (string)$this->job_abroad) . "', '"
            . mysqli_real_escape_string($db->DB_CON, (string)$this->type) . "', '"
            . mysqli_real_escape_string($db->DB_CON, (string)$this->created_at) . "', '"
            . mysqli_real_escape_string($db->DB_CON, (string)$this->experience) . "', '"
            . mysqli_real_escape_string($db->DB_CON, (string)$this->destination_country) . "')";


        $result = $db->readQuery($query);

        if ($result) {
            return mysqli_insert_id($db->DB_CON);
        } else {
            return false;
        }
    }

    public function update()
    {
        $db = new Database();
        $query = "UPDATE baddegama_registration SET "
            . "full_name = '" . mysqli_real_escape_string($db->DB_CON, (string)$this->full_name) . "', "
            . "nic = '" . mysqli_real_escape_string($db->DB_CON, (string)$this->nic) . "', "
            . "passport_number = '" . mysqli_real_escape_string($db->DB_CON, (string)$this->passport_number) . "', "
            . "birthday = '" . mysqli_real_escape_string($db->DB_CON, (string)$this->birthday) . "', "
            . "age = '" . mysqli_real_escape_string($db->DB_CON, (string)$this->age) . "', "
            . "gender = '" . mysqli_real_escape_string($db->DB_CON, (string)$this->gender) . "', "
            . "marital_status = '" . mysqli_real_escape_string($db->DB_CON, (string)$this->marital_status) . "', "
            . "mobile_number = '" . mysqli_real_escape_string($db->DB_CON, (string)$this->mobile_number) . "', "
            . "whatsapp_number = '" . mysqli_real_escape_string($db->DB_CON, (string)$this->whatsapp_number) . "', "
            . "province_id = '" . mysqli_real_escape_string($db->DB_CON, (string)$this->province_id) . "', "
            . "current_job = '" . mysqli_real_escape_string($db->DB_CON, (string)$this->current_job) . "', "
            . "job_abroad = '" . mysqli_real_escape_string($db->DB_CON, (string)$this->job_abroad) . "', "
            . "type = '" . mysqli_real_escape_string($db->DB_CON, (string)$this->type) . "', "
            . "created_at = '" . mysqli_real_escape_string($db->DB_CON, (string)$this->created_at) . "' ,"
            . "call_date_time = '" . mysqli_real_escape_string($db->DB_CON, (string)$this->call_date_time) . "' ,"
            . "call_status = '" . mysqli_real_escape_string($db->DB_CON, (string)$this->call_status) . "' ,"
            . "employee_status = '" . mysqli_real_escape_string($db->DB_CON, (string)$this->employee_status) . "' ,"
            . "call_notes = '" . mysqli_real_escape_string($db->DB_CON, (string)$this->call_notes) . "', "
            . "experience = '" . mysqli_real_escape_string($db->DB_CON, (string)$this->experience) . "', "
            . "destination_country = '" . mysqli_real_escape_string($db->DB_CON, (string)$this->destination_country) . "' "
            . "WHERE id = '" . (int)$this->id . "'";

        return $db->readQuery($query);
    }

    public function delete()
    {
        $query = "DELETE FROM baddegama_registration WHERE id='" . (int)$this->id . "'";
        $db = new Database();
        return $db->readQuery($query);
    }

    public function all()
    {
        $query = "SELECT * FROM baddegama_registration ORDER BY created_at DESC";
        $db = new Database();
        $result = $db->readQuery($query);

        $array_res = array();
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }
}
