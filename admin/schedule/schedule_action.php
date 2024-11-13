<?php
include '../database/db_conn.php'; // Include your database connection file

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    // Get the posted data
    $time_from = $_POST['time_from'];
    $time_to = $_POST['time_to'];
    $days = $_POST['days'];
    $subject = $_POST['subject'];
    $semester = $_POST['semester'];
    $school_year = $_POST['school_year'];
    $course_year = $_POST['course_year'];
    $instructor = $_POST['instructor']; // Assuming this is the instructor ID


    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO schedule (time_from, time_to, days, subject, semester, school_year, course_year, instructor) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $time_from, $time_to, $days, $subject, $semester, $school_year, $course_year, $instructor);

    // Execute the statement
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'User  deleted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error deleting user: ' . $stmt->error]);
    }

    $stmt->close();
}













// edit
if (isset($_POST['action']) && $_POST['action'] == 'fetch') {
    $id = $_POST['id'];
    // Fetch user data from the database
    $query = "SELECT * FROM schedule WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    $user_data = mysqli_fetch_assoc($result);


    // Return the user data in JSON format
    echo json_encode(array('status' => 'success', 'data' => $user_data));
    exit;
}

// Handle the edit action
if (isset($_POST['action']) && $_POST['action'] == 'edit') {
    $id            = $_POST['id'];
    $time_from     = $_POST['time_from'];
    $time_to       = $_POST['time_to'];
    $days          = $_POST['days'];
    $subject       = $_POST['subject'];
    $semester      = $_POST['semester'];
    $school_year   = $_POST['school_year'];
    $course_year   = $_POST['course_year'];
    $instructor    = $_POST['instructor'];


    

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("UPDATE schedule SET time_from=?, time_to=?, days=?, subject=?, semester=?, school_year=?, course_year=?, instructor=? WHERE id=?");
    $stmt->bind_param("ssssssssi", $time_from, $time_to, $days, $subject, $semester, $school_year, $course_year, $instructor, $id);

    if ($stmt->execute()) {
        echo json_encode(array('status' => 'success', 'message' => 'User  updated successfully.'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error updating user: ' . $stmt->error));
    }

    $stmt->close();
    exit;
}






// delete
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'delete') {
    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM schedule WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'User  deleted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error deleting user: ' . $stmt->error]);
    }

    $stmt->close();
}



$conn->close();

?>