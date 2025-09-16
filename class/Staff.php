<?php

class Staff
{
    public $id;
    public $name;
    public $position;
    public $contact_no;
    public $whatsapp_no;
    public $nic;
    public $education_qualification;
    public $position_qualification;
    public $service_experience;
    public $id_copy;
    public $epf_no;
    public $salary;
    public $district;
    public $province;
    public $company;

    public function __construct($id = null)
    {
        if ($id) {
            $query = "SELECT * FROM `staff` WHERE `id` = " . (int)$id;
            $db = new Database();
            $result = mysqli_fetch_array($db->readQuery($query));

            if ($result) {
                $this->id = $result['id'];
                $this->name = $result['name'];
                $this->position = $result['position'];
                $this->contact_no = $result['contact_no'];
                $this->whatsapp_no = $result['whatsapp_no'];
                $this->nic = $result['nic'];
                $this->education_qualification = $result['education_qualification'];
                $this->position_qualification = $result['position_qualification'];
                $this->service_experience = $result['service_experience'];
                $this->id_copy = $result['id_copy'];
                $this->epf_no = $result['epf_no'];
                $this->salary = $result['salary'];
                $this->district = $result['district'];
                $this->province = $result['province'];
                $this->company = $result['company'];
            }
        }
    }

    public function create()
    {
        $query = "INSERT INTO `staff` (
            `name`, `position`, `contact_no`, `whatsapp_no`, `nic`, 
            `education_qualification`, `position_qualification`, `service_experience`, 
            `id_copy`, `epf_no`, `salary`, `district`, `province`, `company`
        ) VALUES (
            '$this->name', '$this->position', '$this->contact_no', '$this->whatsapp_no', '$this->nic',
            '$this->education_qualification', '$this->position_qualification', '$this->service_experience',
            '$this->id_copy', '$this->epf_no', '$this->salary', '$this->district', '$this->province', '$this->company'
        )";

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
        $query = "UPDATE `staff` SET 
            `name` = '$this->name',
            `position` = '$this->position',
            `contact_no` = '$this->contact_no',
            `whatsapp_no` = '$this->whatsapp_no',
            `nic` = '$this->nic',
            `education_qualification` = '$this->education_qualification',
            `position_qualification` = '$this->position_qualification',
            `service_experience` = '$this->service_experience',
            `id_copy` = '$this->id_copy',
            `epf_no` = '$this->epf_no',
            `salary` = '$this->salary',
            `district` = '$this->district',
            `province` = '$this->province',
            `company` = '$this->company'
        WHERE `id` = '$this->id'";

        $db = new Database();
        return $db->readQuery($query);
    }

    public function delete()
    {
        $query = "DELETE FROM `staff` WHERE `id` = '$this->id'";
        $db = new Database();
        return $db->readQuery($query);
    }

    public function all()
    {
        $query = "SELECT * FROM `staff` ORDER BY `id` DESC";
        $db = new Database();
        $result = $db->readQuery($query);

        $array_res = [];
        while ($row = mysqli_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function getLastID()
    {
        $query = "SELECT * FROM `staff` ORDER BY `id` DESC LIMIT 1";
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['id'] ?? null;
    }

    
    public function get_staff_by_type()
    {
        $query = "SELECT id, name FROM `staff` WHERE isActive = 1";

        $db = new Database();
        $result = $db->readQuery($query);
        $users = array();

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $users[] = array(
                    'id' => $row['id'],
                    'name' => $row['name']
                );
            }
        }

        return $users;
    }

}
