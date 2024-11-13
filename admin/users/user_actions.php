<?php
// Database connection  || add
$conn = new mysqli('localhost', 'root', '', 'admin_caps');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Function to handle file uploads
// function uploadFile($file, $uploadDir) {
//     $targetDir = $uploadDir;
//     $targetFile = $targetDir . basename($file["name"]);
//     $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

//     if (move_uploaded_file($file["tmp_name"], $targetFile)) {
//         return $targetFile; // Return the path to the uploaded file
//     } else {
//         return null; 
//     }
// }


// for add
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'add') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $role = $_POST['role'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $contact_num = $_POST['contact_num'];
    $address = $_POST['address'];

    // File upload paths
    // $portfolio = uploadFile($_FILES['portfolio'], "uploads/portfolios/");
    // $cv = uploadFile($_FILES['cv'], "uploads/cvs/");
    // $transcripts = uploadFile($_FILES['transcripts'], "uploads/transcripts/");
    // $cover_letter = uploadFile($_FILES['cover_letter'], "uploads/cover_letters/");


    // Check if user already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE name = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo json_encode(['status' => 'error', 'message' => 'User  already exists.']);
        exit;
    }
    

    $stmt = $conn->prepare("INSERT INTO users (name, username, password, role, dob, email, contact_num, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $name, $username, $password, $role, $dob, $email, $contact_num, $address);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'User  added successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error adding user: ' . $stmt->error]);
    }

    $stmt->close();
    exit;
}




// delete
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'delete') {
    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'User  deleted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error deleting user: ' . $stmt->error]);
    }

    $stmt->close();
}






// edit / fetch user data
if (isset($_POST['action']) && $_POST['action'] == 'fetch') {
    $id = $_POST['id'];
    // Fetch course data from the database
    $query = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
        // Return the course data in JSON format
        echo json_encode(array('status' => 'success', 'data' => $user_data));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'user not found.'));
    }
    $stmt->close();
    exit;
}


// Handle the edit action
if (isset($_POST['action']) && $_POST['action'] == 'edit') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $role = $_POST['role'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $contact_num = $_POST['contact_num'];
    $address = $_POST['address'];


    

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("UPDATE users SET name=?, username=?, role=?, dob=?, email=?, contact_num=?, address=? WHERE id=?");
    $stmt->bind_param("sssssssi", $name, $username, $role, $dob, $email, $contact_num, $address, $id);

    if ($stmt->execute()) {
        echo json_encode(array('status' => 'success', 'message' => 'User  updated successfully.'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error updating user: ' . $stmt->error));
    }

    $stmt->close();
    exit;
}







$conn->close();
?>