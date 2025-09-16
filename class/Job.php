<?php

class Job
{
    public $id;
    public $title;
    public $position;
    public $description;
    public $country;
    public $image;
    public $respons_person;

    public function __construct($id = null)
    {
        if ($id) {
            $query = "SELECT * FROM `jobs` WHERE `id` = " . (int)$id;
            $db = new Database();
            $result = mysqli_fetch_array($db->readQuery($query));

            if ($result) {
                $this->id = $result['id'];
                $this->title = $result['title'];
                $this->position = $result['position'];
                $this->description = $result['description'];
                $this->country = $result['country'];
                $this->image = $result['image'];
                $this->respons_person = $result['respons_person'];
            }
        }
    }

    public function create()
    {
        $query = "INSERT INTO `jobs` (
            `title`, `position`, `description`, `country`, `image`, `respons_person`
        ) VALUES (
            '$this->title', '$this->position', '$this->description', '$this->country', '$this->image', '$this->respons_person'
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
        $query = "UPDATE `jobs` SET 
            `title` = '$this->title',
            `position` = '$this->position',
            `description` = '$this->description',
            `country` = '$this->country',
            `image` = '$this->image',
            `respons_person` = '$this->respons_person'
        WHERE `id` = '$this->id'";

        $db = new Database();
        return $db->readQuery($query);
    }

    public function delete()
    {
        $query = "DELETE FROM `jobs` WHERE `id` = '$this->id'";
        $db = new Database();
        return $db->readQuery($query);
    }

    public function all()
    {
        $query = "SELECT * FROM `jobs` ORDER BY `id` DESC";
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
        $query = "SELECT * FROM `jobs` ORDER BY `id` DESC LIMIT 1";
        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));
        return $result['id'] ?? null;
    }

    /**
     * Get all distinct positions from jobs table
     * @return array List of distinct positions
     */
    public function getPositions()
    {
        $query = "SELECT DISTINCT position FROM `jobs` WHERE position IS NOT NULL AND position != '' ORDER BY position ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        
        $positions = [];
        while ($row = mysqli_fetch_array($result)) {
            $positions[] = $row['position'];
        }
        
        return $positions;
    }
    
    /**
     * Get all jobs with their details
     * @return array List of jobs with all details
     */
    public function getAllJobs()
    {
        $query = "SELECT * FROM `jobs` WHERE title IS NOT NULL AND title != '' ORDER BY id DESC";
        $db = new Database();
        $result = $db->readQuery($query);
        
        $jobs = [];
        while ($row = mysqli_fetch_array($result)) {
            $jobs[] = [
                'id' => $row['id'],
                'title' => $row['title'],
                'position' => $row['position'],
                'description' => $row['description'],
                'country' => $row['country'],
                'location' => $row['country'], // Using country as location for now
                'type' => 'Full-time', // Default to Full-time if not specified
                'image' => $row['image']
            ];
        }
        
        return $jobs;
    }
}
