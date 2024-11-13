<?php 
session_start(); 
include "db_conn.php";

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
        $sql = "SELECT * FROM applicants WHERE username=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $uname);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            // Verify the password against the hashed password
            if (password_verify($pass, $row['password'])) {


                // Password is correct, create session variables
				$_SESSION['id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['control_num'] = $row['control_num'];
                $_SESSION['name'] = $row['given_name'] . ' ' . $row['middle_name'] . ' ' . $row['last_name'];
                $_SESSION['control_num'] = $row['control_num'];
                $_SESSION['flash_message'] = "Welcome " . $row['last_name'] . " " . $row['given_name'] . " " . $row['middle_name'];
                $_SESSION['show_alert'] = true;


                // Redirect to the applicant portal
                header("Location: ../applicantsPortal/applicant_portal/index.php");
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
