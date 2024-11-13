<?php

// Include your database connection file
include '../database/db_conn.php'; 

// for add
// Check if form was submitted via POST and 'action' is 'add'
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {

    // Retrieve data from POST request
    $name = $_POST['name'];
    $major = $_POST['major'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $birthday = $_POST['birthday'];
    $civil_stats = $_POST['civil_stats'];

    // Prepare SQL statement for inserting instructor data
    $stmt = $conn->prepare("INSERT INTO instructors (name, major, contact, email, birthday, civil_stats, portfolio, cv, transcripts, valid_id, cover_letter) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Database preparation failed: ' . $conn->error]);
        exit;
    }

    // Initialize file paths
    $portfolio = $cv = $transcripts = $valid_id = $cover_letter = null;

    // Define upload directory
    $uploadDir = 'uploads/'; 

    // Define file inputs to be processed
    $files = [
        'portfolio' => $_FILES['portfolio'],
        'cv' => $_FILES['cv'],
        'transcripts' => $_FILES['transcripts'],
        'valid_id' => $_FILES['valid_id'],
        'cover_letter' => $_FILES['cover_letter']
    ];

    // Process each file upload
    foreach ($files as $key => $file) {
        if ($file['error'] === UPLOAD_ERR_OK) {
            $fileName = basename($file['name']);
            $targetFilePath = $uploadDir . $fileName;

            // Move uploaded file to target directory
            if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
                // Store the file name for database insertion
                ${$key} = $fileName; // Dynamically set variable name
            } else {
                echo json_encode(['status' => 'error', 'message' => "Error uploading $key."]);
                exit;
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => "No file uploaded for $key or an error occurred."]);
            exit;
        }
    }

    // Bind parameters and execute the statement
    $stmt->bind_param("sssssssssss", $name, $major, $contact, $email, $birthday, $civil_stats, $portfolio, $cv, $transcripts, $valid_id, $cover_letter);
    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Instructor added successfully with files uploaded.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error adding instructor: ' . $stmt->error]);
    }

    // Close statement and connection
    $stmt->close();

} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
}



















// edit
// if (isset($_POST['action']) && $_POST['action'] == 'fetch') {
//     $id = $_POST['id'];

//     $query = "SELECT * FROM instructors WHERE id = '$id'";
//     $result = mysqli_query($conn, $query);
//     $user_data = mysqli_fetch_assoc($result);

//     echo json_encode(array('status' => 'success', 'data' => $user_data));
//     exit;
// }

// if (isset($_POST['action']) && $_POST['action'] == 'fetch') {
//     $id = $_POST['id'];
//     $query = "SELECT * FROM instructors WHERE id = ?";
//     $stmt = $conn->prepare($query);
//     $stmt->bind_param("i", $id);
//     $stmt->execute();
//     $result = $stmt->get_result();

//     if ($result->num_rows > 0) {
//         $inst_data = $result->fetch_assoc();
//         echo json_encode(array('status' => 'success', 'data' => $inst_data));
//     } else {
//         echo json_encode(array('status' => 'error', 'message' => 'Instructor not found.'));
//     }
//     $stmt->close();
//     exit;
// }

// Fetch data for edit modal
if (isset($_POST['action']) && $_POST['action'] == 'fetch') {
    $id = $_POST['id'];
    $query = "SELECT * FROM instructors WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $inst_data = $result->fetch_assoc();
        echo json_encode(array('status' => 'success', 'data' => $inst_data));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Instructor not found.'));
    }
    $stmt->close();
    exit;
}

// Update data on form submission
if (isset($_POST['action']) && $_POST['action'] == 'edit') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $major = $_POST['major'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $birthday = $_POST['birthday'];
    $civil_stats = $_POST['civil_stats'];

    $stmt = $conn->prepare("UPDATE instructors SET name=?, major=?, contact=?, email=?, birthday=?, civil_stats=? WHERE id=?");
    $stmt->bind_param("ssssssi", $name, $major, $contact, $email, $birthday, $civil_stats, $id);

    if ($stmt->execute()) {
        echo json_encode(array('status' => 'success', 'message' => 'User updated successfully.'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error updating user: ' . $stmt->error));
    }

    $stmt->close();
    exit;
}


// Handle the edit action
if (isset($_POST['action']) && $_POST['action'] == 'edit') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $major = $_POST['major'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $birthday = $_POST['birthday'];
    $civil_stats = $_POST['civil_stats'];
    $portfolio = $_POST['portfolio'];
    $cv = $_POST['cv'];
    $transcripts = $_POST['transcripts'];
    $valid_id = $_POST['valid_id'];
    $cover_letter = $_POST['cover_letter'];


    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("UPDATE instructors SET name=?, major=?, contact=?, email=?, birthday=?, civil_stats=? WHERE id=?");

    $stmt->bind_param("ssssssi", $name, $major, $contact, $email, $birthday, $civil_stats, $id);


    if ($stmt->execute()) {
        echo json_encode(array('status' => 'success', 'message' => 'User  updated successfully.'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Error updating user: ' . $stmt->error));
    }

    $stmt->close();
    exit;
}


?>