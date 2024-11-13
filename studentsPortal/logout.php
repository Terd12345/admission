<?php 
// session_start();

// session_unset();
// session_destroy();

// header("Location: index.php");


// Set the session name to match the student portal
session_name('student_session');
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to login page or homepage
header("Location: login.php");
exit();