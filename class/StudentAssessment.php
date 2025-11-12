<?php

/**
 * StudentAssessment Class
 * Handles interview and pretest details for agency students
 *
 * @author sublime holdings
 * @web www.sublime.lk
 */
require_once 'AgancyStudent.php';

class StudentAssessment {
    public $id;
    public $student_id;
    public $assessment_type;
    public $assessment_date;
    public $assessment_result;
    public $created_at;
    public $updated_at;

    public function __construct($id = null) {
        if ($id) {
            $query = "SELECT * FROM `student_assessment` WHERE `id` = " . intval($id);
            $db = new Database();
            $result = mysqli_fetch_array($db->readQuery($query));

            if ($result) {
                $this->id = $result['id'];
                $this->student_id = $result['student_id'];
                $this->assessment_type = $result['assessment_type'];
                $this->assessment_date = $result['assessment_date'];
                $this->assessment_result = $result['assessment_result'];
                $this->created_at = $result['created_at'];
                $this->updated_at = $result['updated_at'];
            }
        }
    }

    public function create() {
        $db = new Database();
        $con = $db->DB_CON;
        
        $query = "INSERT INTO `student_assessment` (
            `student_id`, 
            `assessment_type`, 
            `assessment_date`, 
            `assessment_result`
        ) VALUES ("
            . ($this->student_id !== null ? "'" . mysqli_real_escape_string($con, $this->student_id) . "'" : "NULL") . ", "
            . "'" . mysqli_real_escape_string($con, $this->assessment_type) . "', "
            . (!empty($this->assessment_date) ? "'" . mysqli_real_escape_string($con, $this->assessment_date) . "'" : "NULL") . ", "
            . (!empty($this->assessment_result) ? "'" . mysqli_real_escape_string($con, $this->assessment_result) . "'" : "NULL")
        . ")";

        $result = $db->readQuery($query);

        if ($result) {
            $this->id = mysqli_insert_id($con);
            error_log("Created assessment with ID: " . $this->id . " for student_id: " . ($this->student_id ?? 'NULL'));
            return $this->id;
        } else {
            error_log("Failed to create assessment. Error: " . mysqli_error($con));
            return false;
        }
    }

    public function update() {
        $db = new Database();
        $con = $db->DB_CON;
        
        $query = "UPDATE `student_assessment` SET 
            `student_id` = " . ($this->student_id !== null ? "'" . mysqli_real_escape_string($con, $this->student_id) . "'" : "NULL") . ",
            `assessment_type` = '" . mysqli_real_escape_string($con, $this->assessment_type) . "',
            `assessment_date` = " . (!empty($this->assessment_date) ? "'" . mysqli_real_escape_string($con, $this->assessment_date) . "'" : "NULL") . ",
            `assessment_result` = " . (!empty($this->assessment_result) ? "'" . mysqli_real_escape_string($con, $this->assessment_result) . "'" : "NULL") . "
            WHERE `id` = " . intval($this->id);

        $result = $db->readQuery($query);
        
        if (!$result) {
            error_log("Failed to update assessment. Error: " . mysqli_error($con));
        } else {
            error_log("Updated assessment ID: " . $this->id . " for student_id: " . ($this->student_id ?? 'NULL'));
        }
        
        return $result ? true : false;
    }

    public function getByStudentAndType($student_id, $type) {
        // If student_id is empty, don't try to find by student_id
        if (empty($student_id)) {
            return false;
        }

        $query = "SELECT * FROM `student_assessment`
                 WHERE `student_id` = '" . mysqli_real_escape_string((new Database())->DB_CON, $student_id) . "'
                 AND `assessment_type` = '" . mysqli_real_escape_string((new Database())->DB_CON, $type) . "'
                 ORDER BY `id` DESC LIMIT 1";

        $db = new Database();
        $result = mysqli_fetch_array($db->readQuery($query));

        if ($result) {
            $this->id = $result['id'];
            $this->student_id = $result['student_id'];
            $this->assessment_type = $result['assessment_type'];
            $this->assessment_date = $result['assessment_date'];
            $this->assessment_result = $result['assessment_result'];
            return $result;
        }

        return false;
    }

    /**
     * Save a new assessment record (allows multiple assessments for same student)
     * @param int|string $agancy_student_id The ID from agencystudent table
     * @param string $type 'interview' or 'pretest'
     * @param string $date Assessment date (YYYY-MM-DD)
     * @param string $result 'pass' or 'fail'
     * @return bool|int Returns the assessment ID on success, false on failure
     */
    public function saveOrUpdate($agancy_student_id, $type, $date, $result) {
        // 1. Look up the student_id from agencystudent table if we have an agency student ID
        $this->student_id = null;
        if (!empty($agancy_student_id)) {
            $agancyStudent = new AgancyStudent($agancy_student_id);
            if ($agancyStudent && !empty($agancyStudent->student_id)) {
                $this->student_id = $agancyStudent->student_id;
                error_log("Found student_id: {$this->student_id} for agancy_student_id: {$agancy_student_id}");
            } else {
                error_log("Warning: No student_id found for agancy_student_id: {$agancy_student_id}. AgancyStudent ID: {$agancy_student_id}");
                // Don't proceed if we can't find the student_id
                return false;
            }
        } else {
            error_log("Error: No agancy_student_id provided");
            return false;
        }
        
        // 2. Set assessment details
        $this->assessment_type = $type;
        $this->assessment_date = $date;
        $this->assessment_result = $result;

        // 3. Always create new record (allow unlimited assessments for same student)
        // No need to check for existing records - each assessment should be saved separately
        if ($this->student_id !== null) {
            $newId = $this->create();
            if ($newId) {
                error_log("Created new assessment ID: {$newId} for student_id: {$this->student_id}");
                return $newId;
            } else {
                error_log("Failed to create assessment for agancy_student_id: {$agancy_student_id}");
                return false;
            }
        }
        
        error_log("Cannot create assessment: student_id is null for agancy_student_id: {$agancy_student_id}");
        return false;
    }

    /**
     * Delete assessment records with NULL student_id (cleanup method)
     * @return int Number of records deleted
     */
    public function deleteNullStudentRecords() {
        $db = new Database();
        $query = "DELETE FROM `student_assessment` WHERE `student_id` IS NULL";
        $result = $db->readQuery($query);
        
        if ($result) {
            $deletedCount = mysqli_affected_rows($db->DB_CON);
            error_log("Deleted {$deletedCount} assessment records with NULL student_id");
            return $deletedCount;
        }
        
        return 0;
    }
}
