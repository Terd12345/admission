<?php
// require("db_conn.php"); // Include your database connection

include '../database/db_conn.php';

// Fetch all students from the database
$sql = "SELECT stud_id, id, last_name, given_name, middle_name FROM students"; 
$result = $conn->query($sql);

$students = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Diploma</title>
    <link rel="shortcut icon" href="../assets/img/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap"rel="stylesheet">
    <link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/plugins/feather/feather.css">
    <link rel="stylesheet" href="../assets/plugins/icons/flags/flags.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="../assets/plugins/fullcalendar/fullcalendar.min.css">

<!-- DataTables CSS and JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <style>
        label {
            font-size: 18px;
            margin-right: 10px;
            display: block;
            margin-top: 10px;
        }
        select, input[type="text"], textarea {
            padding: 10px;
            font-size: 16px;
            width: 100%;
            margin-bottom: 10px;
        }
        input[type="submit"] {
            padding: 10px 15px;
            font-size: 16px;
            cursor: pointer;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .container {
            margin-top: 50px;
            width: 50%;
            margin-left: auto;
            margin-right: auto;
        }
        textarea {
            resize: none;
            height: 100px;
        }


             /* Restore breadcrumb styling */
    ul.breadcrumb {
        padding: 10px 1px;
        list-style: none;
        background-color: #f9f9f9;
        display: flex;
        align-items: center;
        border-radius: 4px;
        margin-bottom: 20px;
    }

    ul.breadcrumb li {
        display: inline;
        font-size: 18px;
    }

    ul.breadcrumb li a {
        /* color: #007bff; */
        text-decoration: none;
        padding: 0 5px;
    }

    ul.breadcrumb li a:hover {
        color: #0056b3;
        text-decoration: underline;
    }

    ul.breadcrumb li i {
        margin: 0 10px;
        color: #6c757d;
    }

    ul.breadcrumb li:last-child a {
        color: #6c757d;
        pointer-events: none;
    }

    ul.breadcrumb li:last-child a.active {
        font-weight: bold;
    }

    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>

<?php
// // Fetch all students from the database
// $sql = "SELECT S_ID, FNAME, LNAME, MNAME FROM tblstudent"; 
// $result = $conn->query($sql);

// $students = [];
// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_assoc()) {
//         $students[] = $row;
//     }
// }

// $conn->close();
?>


<?php include '../template/template.php'; ?>

<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row"></div>



                <ul class="breadcrumb">
                <li>
                    <a href="/Admin_Caps/main.php" style="text-decoration: none";>Home</a>
                </li>
                <li><i class='bx bx-chevron-right' >></i></li>
                <li>
                    <a class="active" href="/Admin_Caps/admin/certificate/certificate.php">Diploma</a>
                </li>
            </ul>
            </div>



<div class="container">
    <h1>Generate Diploma</h1>
    <form action="generate_certificate.php" method="POST" target="_blank">
        <label for="student">Select Student:</label>
        <select name="student_id" id="student" required>
            <option value="">--Select a student--</option>
            <?php foreach ($students as $student): ?>
        <option value="<?= $student['stud_id'] ?>"> <!-- Use stud_id here -->
            <?= htmlspecialchars($student['given_name'] . " " . $student['last_name'] . ($student['middle_name'] !== "Not Applicable" ? " " . $student['middle_name'] : "")) ?>
        </option>
    <?php endforeach; ?>
        </select>
        
        <label for="course_title">Course Title:</label>
        <input type="text" name="course_title" id="course_title" required placeholder="Enter Course Title">
        
        <label for="message">Message:</label>
        <textarea name="message" id="message" required placeholder="Enter certificate message here"></textarea>
        
        <input type="submit" value="Generate Diploma">
    </form>
</div>


</div>
            </div>
        </div>
    </div>
</div>

</body>
</html>



<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="../assets/js/jquery-3.6.0.min.js"></script>

    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="../assets/js/feather.min.js"></script>

    <script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="../assets/js/script.js"></script>