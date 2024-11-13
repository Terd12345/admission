<?php


$conn = new mysqli('localhost', 'root', '', 'admin_caps');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// add
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'add') {
    $course_name   = $_POST['course_name'];
    $course_level  = $_POST['course_level'];
    // $units         = $_POST['units'];
    $pre_requisite = $_POST['pre_requisite'];


    // Check if user already exists
    $stmt = $conn->prepare("SELECT * FROM course WHERE course_name = ?");
    $stmt->bind_param("s", $course_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(['status' => 'error', 'message' => 'course  already exists.']);
        exit;
    }
    

    $stmt = $conn->prepare("INSERT INTO course (course_name, course_level, pre_requisite) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $course_name, $course_level, $pre_requisite);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Course  added successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error adding course: ' . $stmt->error]);
    }

    $stmt->close();
}





// delete
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'delete') {
    $course_id = $_POST['id']; // Use 'id' instead of 'course_id'

    $stmt = $conn->prepare("DELETE FROM course WHERE course_id = ?"); // Ensure the table name is correct
    $stmt->bind_param("i", $course_id); // Use $course_id instead of $id

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Course deleted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error deleting course: ' . $stmt->error]);
    }

    $stmt->close();
}






// edit
if (isset($_POST['action']) && $_POST['action'] == 'fetch') {
    $id = $_POST['id'];
    // Fetch course data from the database
    $query = "SELECT * FROM course WHERE course_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $course_data = $result->fetch_assoc();
        // Return the course data in JSON format
        echo json_encode(array('status' => 'success', 'data' => $course_data));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Course not found.'));
    }
    $stmt->close();
    exit;
}

// Handle the edit action
if (isset($_POST['action']) && $_POST['action'] == 'edit') {
    $course_id = $_POST['id']; // Ensure to use 'id' here
    $course_name = $_POST['course_name'];
    $course_level = $_POST['course_level'];
    // $units = $_POST['units'];
    $pre_requisite = $_POST['pre_requisite'];

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("UPDATE course SET course_name=?, course_level=?, pre_requisite=? WHERE course_id=?");
    $stmt->bind_param("sisi", $course_name, $course_level, $pre_requisite, $course_id);

    if ($stmt->execute()) {
        echo json_encode(array('status' => 'success', 'message' => 'Course updated successfully.'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error updating course: ' . $stmt->error));
    }

    $stmt->close();
    exit;
}

?> 