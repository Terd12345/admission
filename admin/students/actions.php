<?php
require '../database/db_conn.php'; // Your DB connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stud_id = $_POST['id'];

    // Prepare and execute the delete statement
    $stmt = $conn->prepare("DELETE FROM students WHERE stud_id = ?");
    $stmt->bind_param("i", $stud_id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }

    $stmt->close();
}
$conn->close();
?>