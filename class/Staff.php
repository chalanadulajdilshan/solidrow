<?php
class Staff
{
    public $id;
    public $district;
    public $province;
    public $company;
    public $join_date;
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

    private $upload_dir = '../../upload/staff/id-copy/';

    public function __construct($id = null)
    {
        if ($id) $this->load($id);
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

        $query = "INSERT INTO `staff` (
            `name`, `position`, `contact_no`, `whatsapp_no`, `nic`,
            `education_qualification`, `position_qualification`, `service_experience`,
            `id_copy`, `epf_no`, `salary`, `district`, `province`, `company`, `join_date`
        ) VALUES (
            '" . $this->name . "', 
            '" . $this->position . "', 
            '" . $this->contact_no . "', 
            '" . $this->whatsapp_no . "', 
            '" . $this->nic . "',
            '" . $this->education_qualification . "', 
            '" . $this->position_qualification . "', 
            '" . $this->service_experience . "',
            '" . $this->id_copy . "', 
            '" . $this->epf_no . "', 
            '" . $this->salary . "', 
            '" . $this->district . "', 
            '" . $this->province . "', 
            '" . $this->company . "', 
            '" . $this->join_date . "'
        )";

        $result = $db->readQuery($query);

        if ($result) {
            return mysqli_insert_id($db->DB_CON);
        }
        return false;
    }

    public function update()
    {
        if (!$this->id) return false;

        $db = new Database();

        $query = "UPDATE `staff` SET
            `name` = '" . $this->name . "',
            `position` = '" . $this->position . "',
            `contact_no` = '" . $this->contact_no . "',
            `whatsapp_no` = '" . $this->whatsapp_no . "',
            `nic` = '" . $this->nic . "',
            `education_qualification` = '" . $this->education_qualification . "',
            `position_qualification` = '" . $this->position_qualification . "',
            `service_experience` = '" . $this->service_experience . "',
            `id_copy` = '" . $this->id_copy . "',
            `epf_no` = '" . $this->epf_no . "',
            `salary` = '" . $this->salary . "',
            `district` = '" . $this->district . "',
            `province` = '" . $this->province . "',
            `company` = '" . $this->company . "',
            `join_date` = '" . $this->join_date . "'
        WHERE `id` = " . (int)$this->id;

        return $db->readQuery($query);
    }

    public function delete()
    {
        if (!$this->id) return false;

        if (!empty($this->id_copy)) {
            $file_path = $this->upload_dir . $this->id_copy;
            if (file_exists($file_path) && is_file($file_path)) {
                unlink($file_path);
            }
        }

        $db = new Database();
        $query = "DELETE FROM `staff` WHERE `id` = " . (int)$this->id;
        return $db->readQuery($query);
    }

    public function all($orderBy = 'id', $order = 'DESC')
    {
        $db = new Database();
        $allowedColumns = ['id', 'name', 'position', 'district', 'company'];
        $orderBy = in_array(strtolower($orderBy), $allowedColumns) ? $orderBy : 'id';
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
