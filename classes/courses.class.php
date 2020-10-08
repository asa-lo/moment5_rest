<?php

class Courses
{

    private $db;


    function __construct()
    {

        // Database connection
        $this->db = new mysqli(DBHOST, DBUSER, DBPASS, DBDATABASE);
        if ($this->db->connect_errno > 0) {
            die("Anslutning misslyckades: " . $this->db->connect_error);
        }
    }

    // Get courselist
    public function getCourses()
    {
        $sql =  "SELECT * FROM courses";
        $results = $this->db->query($sql);
        $courses =  mysqli_fetch_all($results, MYSQLI_ASSOC);

        return $courses;
    }

    // Create new course in courselist
    public function createCourse($code, $name, $progression, $coursesyllabus)
    {
        $sql = "INSERT INTO courses(code, name, progression, coursesyllabus)VALUES('$code', '$name', '$progression', '$coursesyllabus')";
        $this->db->query($sql);
        return true;
    }

    // Delete course in courselist
    public function deleteCourse($index)
    {
        $sql = "DELETE FROM courses WHERE id = '$index'";
        $this->db->query($sql);
        return true;
    }

    // Update course in courselist
    public function updateCourse($code, $name, $progression, $coursesyllabus, $index)
    {
        $sql = "UPDATE courses SET code = '$code', name = '$name', progression = '$progression', coursesyllabus = '$coursesyllabus' WHERE id = '$index'";
        $this->db->query($sql);
        return true;
    }
}
