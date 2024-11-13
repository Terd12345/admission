<?php

include '../database/db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = isset($_POST['id']) ? intval($_POST['id']) : 0;

    if ($userId && isset($_FILES['profile']) && $_FILES['profile']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['profile']['tmp_name'];
        $fileName = $_FILES['profile']['name'];
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array(strtolower($fileExtension), $allowedExtensions)) {
            $newFileName = "user_" . $userId . "_" . time() . "." . $fileExtension;
            $uploadDir = '../assets/img/profiles/';
            $uploadFilePath = $uploadDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $uploadFilePath)) {
                // Update the profile image path in the database
                $query = "UPDATE users SET profile = ? WHERE id = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("si", $newFileName, $userId);

                if ($stmt->execute()) {
                    // Redirect back to profile.php with the user ID in the URL
                    header("Location: ../profile/profile.php?status=success&id=$userId");
                    exit();
                } else {
                    echo "Failed to update profile image in the database." . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "Error moving the uploaded file.";
            }
        } else {
            echo "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
        }
    } else {
        echo "Invalid upload. Please select a valid file.";
    }
}



?>