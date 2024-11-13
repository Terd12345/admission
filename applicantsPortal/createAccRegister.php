<?php

include "db_conn.php";

$username = $_POST['username'];
$last_name = $_POST['last_name'];
$given_name = $_POST['given_name'];
$middle_name = $_POST['middle_name'];
$email = $_POST['email'];
$password = $_POST['password'];

// Hash the password before storing it
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Generate a unique control number based on the year and sequential number
$year = date("Y"); // Current year

// Get the latest control number for the current year
$check_stmt = $conn->prepare("SELECT control_num FROM applicants WHERE control_num LIKE ? ORDER BY control_num DESC LIMIT 1");
$search_pattern = $year . "%"; // Pattern like '2024%'
$check_stmt->bind_param("s", $search_pattern);
$check_stmt->execute();
$check_stmt->bind_result($last_control_num);
$check_stmt->fetch();
$check_stmt->close();

// Extract the sequential part and increment it
if ($last_control_num) {
    // Get the last sequential number and increment it
    $sequential_num = (int)substr($last_control_num, 4) + 1; 
} else {
    // If no control number exists for the current year, start with 0001
    $sequential_num = 1;
}

// Pad the sequential number with leading zeros to ensure it is 4 digits
$control_num = $year . str_pad($sequential_num, 4, "130", STR_PAD_LEFT);

// Check if the account already exists
$check_stmt = $conn->prepare("SELECT * FROM applicants WHERE username = ? AND last_name = ?");
$check_stmt->bind_param("ss", $username, $last_name);
$check_stmt->execute();
$check_stmt->store_result();

if ($check_stmt->num_rows > 0) {
    // Account already exists, display the popup message on the same page
    echo '<script>
            alert("The Account is Already Registered.");
            window.location.href = "index.php";
          </script>';
} else {
    // If the account doesn't exist, proceed with the registration
    $stmt = $conn->prepare("INSERT INTO applicants(control_num, username, last_name, given_name, middle_name, email, password)
    VALUES(?,?,?,?,?,?,?)");

    $stmt->bind_param("sssssss", $control_num, $username, $last_name, $given_name, $middle_name, $email, $hashed_password);
    $stmt->execute();
    
    // Close the statement and connection
    $stmt->close();
    $conn->close();

    // Redirect to createAcc.php with a success message
    header("Location: createAcc.php?success=true");
    exit();
}

?>
