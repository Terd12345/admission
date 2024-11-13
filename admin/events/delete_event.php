<?php
session_start();
include 'db_conn.php';

if (isset($_GET['id'])) {
    $eventId = $_GET['id'];

    // Delete the event from the database
    $sql = "DELETE FROM events WHERE id = :id";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute(['id' => $eventId])) {
        // Redirect back to events page after deletion
        header('Location: events.php');
        exit();
    } else {
        // Redirect if there is an error
        header('Location: events.php?error=delete');
        exit();
    }
}
?>
