<?php
include '../database/db_conn.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Prepare and execute the delete query
    $sql = "DELETE FROM applicants WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Applicant deleted successfully.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete applicant.']);
    }

    $stmt->close();
    $conn->close();
}
?>
