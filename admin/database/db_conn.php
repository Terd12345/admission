<?php

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "admin_caps"; 


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


    $sql = "SELECT stud_id, last_name, given_name, middle_name FROM students"; // Adjust the table name and columns
    $result = $conn->query($sql);

    $students = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $students[] = $row;
        }
    }


?>