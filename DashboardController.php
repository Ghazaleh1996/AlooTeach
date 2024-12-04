<?php
require_once '../config/database.php';
require_once '../models/User.php';

class DashboardController {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
    }

    // Load student dashboard data
    public function loadStudentDashboard($user_id) {
        // Retrieve student-specific data, like enrolled courses
        $stmt = $this->db->prepare("SELECT Courses.name, Courses.description 
                                    FROM Enrollments 
                                    JOIN Courses ON Enrollments.course_id = Courses.id 
                                    WHERE Enrollments.student_id = :user_id");
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Load employee dashboard data
    public function loadEmployeeDashboard($user_id) {
        // Retrieve assigned students and courses for the employee
        $stmt = $this->db->prepare("SELECT Students.user_id, Courses.name AS course_name 
                                    FROM ConsultantAssignments 
                                    JOIN Courses ON ConsultantAssignments.course_id = Courses.id
                                    JOIN Students ON ConsultantAssignments.student_id = Students.user_id 
                                    WHERE ConsultantAssignments.consultant_id = :user_id");
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
