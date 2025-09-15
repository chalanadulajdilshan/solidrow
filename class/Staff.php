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
    public $join_date;

    private $upload_dir = '../../upload/staff/id-copy/';
    private $allowed_image_types = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
    private $max_file_size = 5 * 1024 * 1024; // 5MB

    public function __construct($id = null)
    {
        if ($id) {
            $this->load($id);
        }
    }

    private function load($id)
    {
        $db = new Database();
        $id = (int)$id;
        $query = "SELECT * FROM `staff` WHERE `id` = $id";
        $result = mysqli_fetch_assoc($db->readQuery($query));

        if ($result) {
            foreach ($result as $key => $value) {
                $this->$key = $value;
            }
            return true;
        }
        return false;
    }

    public function create()
    {
        $db = new Database();
        
        $name = mysqli_real_escape_string($db->DB_CON, $this->name);
        $position = mysqli_real_escape_string($db->DB_CON, $this->position);
        $contact_no = mysqli_real_escape_string($db->DB_CON, $this->contact_no);
        $whatsapp_no = mysqli_real_escape_string($db->DB_CON, $this->whatsapp_no ?? '');
        $nic = mysqli_real_escape_string($db->DB_CON, $this->nic);
        $education_qualification = mysqli_real_escape_string($db->DB_CON, $this->education_qualification ?? '');
        $position_qualification = mysqli_real_escape_string($db->DB_CON, $this->position_qualification ?? '');
        $service_experience = mysqli_real_escape_string($db->DB_CON, $this->service_experience ?? '');
        $id_copy = mysqli_real_escape_string($db->DB_CON, $this->id_copy ?? '');
        $epf_no = mysqli_real_escape_string($db->DB_CON, $this->epf_no);
        $salary = (float)$this->salary;
        $district = (int)$this->district;
        $province = (int)$this->province;
        $company = (int)$this->company;
        $join_date = mysqli_real_escape_string($db->DB_CON, $this->join_date);

        $query = "INSERT INTO `staff` (
            `name`, `position`, `contact_no`, `whatsapp_no`, `nic`, 
            `education_qualification`, `position_qualification`, `service_experience`, 
            `id_copy`, `epf_no`, `salary`, `district`, `province`, `company`, `join_date`
        ) VALUES (
            '$name', '$position', '$contact_no', '$whatsapp_no', '$nic',
            '$education_qualification', '$position_qualification', '$service_experience',
            '$id_copy', '$epf_no', $salary, $district, $province, $company, '$join_date'
        )";

        if ($db->readQuery($query)) {
            $this->id = mysqli_insert_id($db->DB_CON);
            return $this->id;
        }
        return false;
    }

    public function update()
    {
        if (!$this->id) {
            return false;
        }

        $db = new Database();
        
        $name = mysqli_real_escape_string($db->DB_CON, $this->name);
        $position = mysqli_real_escape_string($db->DB_CON, $this->position);
        $contact_no = mysqli_real_escape_string($db->DB_CON, $this->contact_no);
        $whatsapp_no = mysqli_real_escape_string($db->DB_CON, $this->whatsapp_no ?? '');
        $nic = mysqli_real_escape_string($db->DB_CON, $this->nic);
        $education_qualification = mysqli_real_escape_string($db->DB_CON, $this->education_qualification ?? '');
        $position_qualification = mysqli_real_escape_string($db->DB_CON, $this->position_qualification ?? '');
        $service_experience = mysqli_real_escape_string($db->DB_CON, $this->service_experience ?? '');
        $id_copy = mysqli_real_escape_string($db->DB_CON, $this->id_copy ?? '');
        $epf_no = mysqli_real_escape_string($db->DB_CON, $this->epf_no);
        $salary = (float)$this->salary;
        $district = (int)$this->district;
        $province = (int)$this->province;
        $company = (int)$this->company;
        $join_date = mysqli_real_escape_string($db->DB_CON, $this->join_date);
        $id = (int)$this->id;

        $query = "UPDATE `staff` SET 
            `name` = '$name',
            `position` = '$position',
            `contact_no` = '$contact_no',
            `whatsapp_no` = '$whatsapp_no',
            `nic` = '$nic',
            `education_qualification` = '$education_qualification',
            `position_qualification` = '$position_qualification',
            `service_experience` = '$service_experience',
            `id_copy` = '$id_copy',
            `epf_no` = '$epf_no',
            `salary` = $salary,
            `district` = $district,
            `province` = $province,
            `company` = $company,
            `join_date` = '$join_date'
        WHERE `id` = $id";

        return $db->readQuery($query);
    }

    public function delete()
    {
        if (!$this->id) {
            return false;
        }

        if (!empty($this->id_copy)) {
            $file_path = $this->upload_dir . $this->id_copy;
            if (file_exists($file_path) && is_file($file_path)) {
                unlink($file_path);
            }
        }

        $db = new Database();
        $id = (int)$this->id;
        $query = "DELETE FROM `staff` WHERE `id` = $id";
        
        return $db->readQuery($query);
    }

    public function all($orderBy = 'id', $order = 'DESC')
    {
        $db = new Database();
        $orderBy = in_array(strtolower($orderBy), ['id', 'name', 'position']) ? $orderBy : 'id';
        $order = strtoupper($order) === 'ASC' ? 'ASC' : 'DESC';
        
        $query = "SELECT * FROM `staff` ORDER BY `$orderBy` $order";
        $result = $db->readQuery($query);

        $staff = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $staff[] = $row;
        }

        return $staff;
    }
}