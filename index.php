<?php

include("config/config.php");

// Headers to make service available from all domains
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, PUT, POST, DELETE");
header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Acess-Control-Allow-Methods, Authorization, x-Requested-With");

$method = $_SERVER["REQUEST_METHOD"];
$courses = new Courses();
$data = json_decode(file_get_contents("php://input"), true);


switch ($method) {
    case "GET":
       // Get courselist
       $response = $courses->getCourses();
       if (sizeof($response) > 0) {
           http_response_code(200); //Ok = fetched
       } else {
           http_response_code(404); // Not found
           $respose = array("message" => "No course was found.");
       }
        break;
    case "PUT":
        // Update courselist
        $code = $data['code'];
        $name = $data['name'];
        $progression = $data['progression'];
        $coursesyllabus = $data['coursesyllabus'];
        $index = $data['id'];
        if($courses->updateCourse($code, $name, $progression, $coursesyllabus, $index)) {
            http_response_code(200); // Ok = updated
            $response = array("message" => "Course updated.");
        } else {
            http_response_code(500); // Server error
            $response = array("message" => "Error updating course.");
        }
        break;
    case "POST":
        // Create new course and add to courselist
        $code = $data['code'];
        $name = $data['name'];
        $progression = $data['progression'];
        $coursesyllabus = $data['coursesyllabus'];
        if($courses->createCourse($code, $name, $progression, $coursesyllabus)) {
            http_response_code(201); // Ok = created
            $response = array("message" => "Course created.");
        } else {
            http_response_code(503); // Server error
            $response = array("message" => "Course not created.");
        }
        break;
    case "DELETE":
        // Delete course
        $id = $data['id'];
        if($courses->deleteCourse($id)) {
            http_response_code(200); // Ok = deleted
            $response = array ("message" => "Course deleted.");
        } else {
            http_response_code(500); // Server error
            $response = array("message" => "Error deleting course."); // Error message
        }
        break;
}

echo json_encode($response);