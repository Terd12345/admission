<?php

// Database connection  || add
$conn = new mysqli('localhost', 'root', '', 'admin_caps');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// add
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'add') {
    $subj_code          = $_POST['subj_code'];
    $subj_desc          = $_POST['subj_desc'];
    $unit               = $_POST['unit'];
    $pre_requisite      = $_POST['pre_requisite'];
    $course_id          = $_POST['course_id'];
    $semester           = $_POST['semester'];


    // Check if user already exists
    $stmt = $conn->prepare("SELECT * FROM subjects WHERE subj_desc = ?");
    $stmt->bind_param("s", $subj_desc);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(['status' => 'error', 'message' => 'course  already exists.']);
        exit;
    }
    

    $stmt = $conn->prepare("INSERT INTO subjects (subj_code, subj_desc, unit, pre_requisite, course_id, semester) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisss", $subj_code, $subj_desc, $unit, $pre_requisite, $course_id, $semester);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Subject  added successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error adding Subject: ' . $stmt->error]);
    }

    $stmt->close();
}









// delete
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'delete') {
    $subj_id = $_POST['id']; // Use 'id' instead of 'course_id'

    $stmt = $conn->prepare("DELETE FROM subjects WHERE subj_id = ?"); // Ensure the table name is correct
    $stmt->bind_param("i", $subj_id); // Use $course_id instead of $id

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Subject deleted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error deleting Subject: ' . $stmt->error]);
    }

    $stmt->close();
}







// edit
// edit
if (isset($_POST['action']) && $_POST['action'] == 'fetch') {
    $id = $_POST['id'];
    // Fetch course data from the database
    $query = "SELECT * FROM subjects WHERE subj_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $subj_data = $result->fetch_assoc();
        // Return the course data in JSON format
        echo json_encode(array('status' => 'success', 'data' => $subj_data));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Subject not found.'));
    }
    $stmt->close();
    exit;
}

// Handle the edit action
if (isset($_POST['action']) && $_POST['action'] == 'edit') {
    $subj_id = $_POST['id']; // Ensure to use 'id' here
    $subj_code = $_POST['subj_code'];
    $subj_desc = $_POST['subj_desc'];
    $unit = $_POST['unit'];
    $pre_requisite = $_POST['pre_requisite'];
    $course_id = $_POST['course_id'];
    $semester = $_POST['semester'];

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare( "UPDATE subjects SET subj_code=?, subj_desc=?, unit=?, pre_requisite=?, course_id=?, semester=? WHERE subj_id=?");
    $stmt->bind_param("ssisssi", $subj_code, $subj_desc, $unit, $pre_requisite, $course_id, $semester, $subj_id);

    if ($stmt->execute()) {
        echo json_encode(array('status' => 'success', 'message' => 'Subject updated successfully.'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error updating Subject: ' . $stmt->error));
    }

    $stmt->close();
    exit;
}



?>