<?php include 'template/template.php'; ?>
<link rel="shortcut icon" href="/Admin_Caps/assets/img/logoPearl.png">


<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h1 class="page-title">Welcome Admin</h1>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/Admin_Caps/main.php">Home</a></li>
                                <li class="breadcrumb-item active">Admin</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>


<?php
include 'database/db_conn.php';  // Assuming your DB connection is in this file

// Query to get the total number of applicants
$applicantsSql = "SELECT COUNT(*) AS total_applicants FROM applicants"; 
$applicantsResult = $conn->query($applicantsSql);
$applicantsCount = ($applicantsResult->num_rows > 0) ? $applicantsResult->fetch_assoc()['total_applicants'] : 0;

// Query to get the total number of courses
$coursesSql = "SELECT COUNT(*) AS total_courses FROM course";  // Adjust table name if needed
$coursesResult = $conn->query($coursesSql);
$coursesCount = ($coursesResult->num_rows > 0) ? $coursesResult->fetch_assoc()['total_courses'] : 0;

// Query to get the total number of subjects
$subjectsSql = "SELECT COUNT(*) AS total_subjects FROM subjects";  // Adjust table name if needed
$subjectsResult = $conn->query($subjectsSql);
$subjectsCount = ($subjectsResult->num_rows > 0) ? $subjectsResult->fetch_assoc()['total_subjects'] : 0;

$studentSql = "SELECT COUNT(*) AS total_student FROM students";  // Adjust table name if needed
$studentResult = $conn->query($studentSql);
$studentCount = ($studentResult->num_rows > 0) ? $studentResult->fetch_assoc()['total_student'] : 0;


$instSql = "SELECT COUNT(*) AS total_instructor FROM instructors";  // Adjust table name if needed
$instResult = $conn->query($instSql);
$instCount = ($instResult->num_rows > 0) ? $instResult->fetch_assoc()['total_instructor'] : 0;
?>
            

            


            <!-- Statistics Cards -->
            <div class="row">
                <div class="col-md-4">

                    <div class="card card-statistic">
                    <a href="/Admin_Caps/applicants/applicants.php"><div class="card-body">
                            <h5 class="card-title">Applicants</h5>
                            <h2 class="card-statistic-value"><?php echo number_format($applicantsCount); ?></h2>
                            <div class="card-icon">
                                <i class="fas fa-clipboard-list"></i>
                            </div>
                        </div>
                    </div></a>
                </div>
                

                <div class="col-md-4">
                    <div class="card card-statistic">
                    <a href="/Admin_Caps/courses/courses.php"><div class="card-body">
                            <h5 class="card-title">Courses</h5>
                            <h2 class="card-statistic-value"><?php echo number_format($coursesCount); ?></h2>
                            <div class="card-icon">
                                <i class="fas fa-book-open"></i>
                            </div>
                        </div>
                    </div></a>
                </div>

                <div class="col-md-4">
                    <div class="card card-statistic">
                    <a href="/Admin_Caps/subjects/subjects.php"><div class="card-body">
                            <h5 class="card-title">Subjects</h5>
                            <h2 class="card-statistic-value"><?php echo number_format($subjectsCount); ?></h2>
                            <div class="card-icon">
                                <i class="fas fa-clipboard-list"></i>
                            </div>
                        </div>
                    </div></a>
                </div>
            

            <div class="col-md-4">
                    <div class="card card-statistic">
                    <a href="/Admin_Caps/applicants/applicants.php"><div class="card-body">
                            <h5 class="card-title">Enrolled Students</h5>
                            <h2 class="card-statistic-value"><?php echo number_format($studentCount); ?></h2>
                            <div class="card-icon">
                                <i class="fas fa-graduation-cap"></i>
                            </div>
                        </div>
                    </div></a>
                </div>

                <div class="col-md-4">
                    <div class="card card-statistic">
                    <a href="/Admin_Caps/instructor/instructor.php"><div class="card-body">
                            <h5 class="card-title">Instructors</h5>
                            <h2 class="card-statistic-value"><?php echo number_format($instCount); ?></h2>
                            <div class="card-icon">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                    </div></a>
                </div>

                

            </div>
            </div>
            </div>
            
<!-- Add some custom CSS to style the cards -->
<style>
    .card-statistic {
        border: none;
        border-radius: 10px;
        background: #f8f9fa;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
        margin-bottom: 20px;
    }

    .card-statistic:hover {
        transform: translateY(-5px);
    }

    .card-title {
        font-size: 16px;
        font-weight: bold;
        color: #333;
    }

    .card-statistic-value {
        font-size: 36px;
        font-weight: bold;
        color: #27ae60;
    }

    .card-icon {
        font-size: 30px;
        color: #27ae60;
        position: absolute;
        top: 15px;
        right: 15px;
    }


    
</style>







<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>