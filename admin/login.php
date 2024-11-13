<?php 
session_name("admin_session");
session_start(); 
include "database/db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    if (empty($uname)) {
        header("Location: index.php?error=Username is required");
        exit();
    } else if (empty($pass)) {
        header("Location: index.php?error=Password is required");
        exit();
    } else {
        // Fetch user data from the database based on username
        $sql = "SELECT * FROM users WHERE username=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $uname);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            // Verify the password against the hashed password
            if (password_verify($pass, $row['password'])) {


                // Password is correct, create session variables
				$_SESSION['admin_id']         = $row['id'];
                $_SESSION['admin_username']   = $row['username'];
                $_SESSION['admin_name']       = $row['name'];
                $_SESSION['role']             = $row['role'];
                $_SESSION['admin_username'] = $username; // Set the username
                $_SESSION['name'] = $admin_name; // Set the name
                // $_SESSION['role'] = $role; 
                $_SESSION['admin_logged_in']  = true;
                $_SESSION['profile_image']    = $row['profile'];


                // Redirect to the applicant portal
                header("Location: main.php");
                exit();
            } else {
                // Password doesn't match
                header("Location: index.php?error=Incorrect Username or password");
                exit();
            }
        } else {
            // No user found with the provided username
            header("Location: index.php?error=Incorrect Username or password");
            exit();
        }
    }
} else {
    header("Location: index.php");
    exit();
}
 