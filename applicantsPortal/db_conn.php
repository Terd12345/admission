<?php
// Database connection
$sname = "localhost";
$unmae = "root";
$password = "";
$db_name = "admin_caps";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to fetch multiple fields (e.g., given_name, family_name, address, etc.)
$sql = "SELECT given_name, last_name, middle_name FROM applicants WHERE id = 6"; // Adjust the query as needed
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Fetch the row data as an associative array
    $row = mysqli_fetch_assoc($result);
    
    // Store values in variables
    $given_name = $row['given_name'];
    $last_name = $row['last_name'];
    $middle_name = $row['middle_name'];
    } else {
    // echo "No user found";
}

?>
