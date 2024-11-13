<?php
// Database connection  || add
$conn = new mysqli('localhost', 'root', '', 'admin_caps');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'add') {
    
    $department_name = $_POST['department_name'];
    $description = $_POST['description'];
    

    $stmt = $conn->prepare("INSERT INTO department (department_name, description) VALUES (?, ?)");
    $stmt->bind_param("ss", $department_name,  $description);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Department  added successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error adding Department: ' . $stmt->error]);
    }

    $stmt->close();
}




// delete
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'delete') {
    $department_id = $_POST['department_id'];

    $stmt = $conn->prepare("DELETE FROM department WHERE department_id = ?");
    $stmt->bind_param("i", $department_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'User  deleted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error deleting user: ' . $stmt->error]);
    }

    $stmt->close();
}



// edit
if (isset($_POST['action']) && $_POST['action'] == 'fetch') {
    $department_id = $_POST['department_id'];

    $query = "SELECT * FROM department WHERE department_id = '$department_id'";
    $result = mysqli_query($conn, $query);
    $user_data = mysqli_fetch_assoc($result);

    echo json_encode(array('status' => 'success', 'data' => $user_data));
    exit;
}

if (isset($_POST['action']) && $_POST['action'] == 'edit') {
    $department_id = $_POST['department_id'];
    $department_name = $_POST['department_name'];
    $description = $_POST['description'];

    

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("UPDATE department SET department_name=?, description=? WHERE department_id=?");
    $stmt->bind_param("ssi", $department_name, $description, $department_id);

    if ($stmt->execute()) {
        echo json_encode(array('status' => 'success', 'message' => 'Department updated successfully.'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error updating Department: ' . $stmt->error));
    }

    $stmt->close();
    exit;
}







$conn->close();
?>