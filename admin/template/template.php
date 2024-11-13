tmeplate


<?php 
session_name("admin_session");
session_start();

// Check if the user is logged in
if (!isset($_SESSION['admin_username'])) {
    header("Location: index.php?error=You must log in first");
    exit();
}




$admin_name = $_SESSION['name'];
$role = $_SESSION['role']; 

$authorizedRoles = [
    'newApplicants' => ['admin', 'registrar'],
    'subjects' => ['admin', 'instructor'],
    'manageSchedule' => ['admin', 'registrar', 'instructor'],
    'reports' => ['admin', 'registrar'],
    'users' => ['admin']
];

?>


<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>POTSCI</title>
    <link rel="shortcut icon" href="/Admin_Caps/admin/assets/img/logoPearl.png" alt="Logo">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap"rel="stylesheet">
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/plugins/feather/feather.css">
    <link rel="stylesheet" href="assets/plugins/icons/flags/flags.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="assets/plugins/fullcalendar/fullcalendar.min.css">
</head>






<div class="header">

        <div class="header-left">
            <a href="/Admin_Caps/admin/main.php" class="logo">
                <img src="/Admin_Caps/admin/assets/img/logo2.png" alt="Logo">
            </a>
            <a href="/Admin_Caps/main.php" class="logo logo-small">
                <img src="/Admin_Caps/admin/assets/img/small-logo1.png" alt="Logo" width="30" height="30">
            </a>
        </div>
        <div class="menu-toggle">
            <a href="javascript:void(0);" style="text-decoration: none;" id="toggle_btn">
                <i class="fas fa-bars"></i>
            </a>
        </div>

        <!-- <div class="top-nav-search">
    <form id="searchForm" action="../search/search.php" method="GET">
        <input type="text" class="form-control" name="query" placeholder="Search here" required>
        <button class="btn" type="submit"><i class="fas fa-search"></i></button>
    </form>
</div> -->







        <a class="mobile_btn" id="mobile_btn">
            <i class="fas fa-bars"></i>
        </a>

        <ul class="nav user-menu">

        <li class="nav-item zoom-screen me-2">
                <a href="#" class="nav-link header-nav-list win-maximize" id="fullscreenToggle">
                    <img src="/Admin_Caps/admin/assets/img/icons/header-icon-04.svg" alt="">
                </a>
            </li>

        



        <li class="nav-item dropdown has-arrow new-user-menus">
            <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <span class="user-img">
                <img src="/Admin_Caps/admin/assets/img/profiles/<?php echo $_SESSION['profile_image']; ?>" alt="User Image" class="avatar-img rounded-circle">
                    <div class="user-text">
                    <h6><?php echo $_SESSION['admin_name']; ?></h6>
                        <p class="text-muted mb-0"><?php echo $_SESSION['role']; ?></p>
                    </div>
                </span>
            </a>
            <div class="dropdown-menu">
                <div class="user-header">
                    <!-- <div class="avatar avatar-sm">
                        <img src="/Admin_Caps/assets/img/profiles/jm.png" alt="User Image"
                            class="avatar-img rounded-circle">
                    </div> -->
                    <div class="avatar avatar-sm">
                        <img src="/Admin_Caps/admin/assets/img/profiles/<?php echo htmlspecialchars($_SESSION['profile_image'] ?? 'user.png'); ?>" alt="User Image" class="avatar-img rounded-circle">
                    </div>
                    <div class="user-text">
                    <h6><?php echo $_SESSION['admin_name']; ?></h6>
                    <p class="text-muted mb-0"><?php echo $_SESSION['role']; ?></p>
                    </div>
                </div>
                <a class="dropdown-item" href="/Admin_Caps/admin/admin_profile/admin_profile.php?id=<?php echo $_SESSION['admin_id']; ?>">My Profile</a>
                <a class="dropdown-item" href="/Admin_Caps/admin/logout.php">Logout</a>
            </div>
        </li>

    </ul>

</div>


<div class="alert alert-warning alert-dismissible fade show" role="alert">
<p></p>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>




<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <!--<span>Main Menu</span>-->
                </li>
                <li>
                    <a href="/Admin_Caps/admin/main.php" style="text-decoration: none;"><i class="feather-grid"></i> <span> Home</span> </a>
                </li>

                <?php 

                if($role == 'Administrator'){ ?>
                <li>
                    <a href="/Admin_Caps/admin/applicants/applicants.php" style="text-decoration: none;" onclick="setActiveMenuItem(this)"><i class="fas fa-graduation-cap"></i> <span>New Applicants</span></span></a>
                    
                </li>
                <?php } ?>

                <?php 
                if($role == 'Administrator') { ?>
                <li>
                    <a href="/Admin_Caps/admin/subjects/subjects.php" style="text-decoration: none;" onclick="setActiveMenuItem(this)"><i class="fas fa-book"></i> <span>Subjects</span> <span
                    </span></a>
                </li>
                <?php } ?>

                <li class="submenu">
                    <a href="#" style="text-decoration: none;" onclick="setActiveMenuItem(this)"><i class="fas fa-newspaper"></i> <span>News/Events</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="/Admin_Caps/admin/events/events.php" style="text-decoration: none;" onclick="setActiveMenuItem(this)">Post</a></li>
                        <li><a href="/Admin_Caps/admin/report/perInstructor.php" style="text-decoration: none;" onclick="setActiveMenuItem(this)">Manage Events</a></li>  
                    </ul>
                </li>
                </li>
               
                <li>
                    <a href="/Admin_Caps/admin/calendar/index.php" style="text-decoration: none;" onclick="setActiveMenuItem(this)"><i class="fas fa-calendar"></i> <span>Seminary Calendar</span> <span
                            </span></a>
                </li>
                </li>
                <li>
                    <a href="/Admin_Caps/admin/courses/courses.php" style="text-decoration: none;" onclick="setActiveMenuItem(this)"><i class="fas fa-graduation-cap"></i> <span>List of Courses</span></a>
                </li>
                <li>
                    <a href="/Admin_Caps/admin/schedule/schedule.php" style="text-decoration: none;" onclick="setActiveMenuItem(this)"><i class="fas fa-calendar"></i> <span>Schedule</span></a>
                </li>
                <li>
                    <a href="/Admin_Caps/admin/utilization/utilization.php" style="text-decoration: none;" onclick="setActiveMenuItem(this)"><i class="fas fa-chalkboard-teacher"></i> <span> Manage Schedule </span> <span
                        </span></a>
                </li>
                <li>
                    <a href="/Admin_Caps/admin/diploma/diploma.php" style="text-decoration: none;" onclick="setActiveMenuItem(this)"><i class="fas fa-file"></i> <span>ID Generation</span></a>
                </li>
                <li>
                    <a href="/Admin_Caps/admin/certificate/indexs.php" style="text-decoration: none;" onclick="setActiveMenuItem(this)"><i class="fa fa-certificate"></i> <span>Certificates Generation</span></a>
                </li>
                <li>
                    <a href="/Admin_Caps/admin/diploma/diploma.php" style="text-decoration: none;" onclick="setActiveMenuItem(this)"><i class="fas fa-file"></i> <span>Diploma Generation</span></a>
                </li>
                
                <li>
                    <a href="/Admin_Caps/admin/students/students.php" style="text-decoration: none;" onclick="setActiveMenuItem(this)"><i class="fas fa-graduation-cap"></i> <span>Enrolled Students</span></a>
                </li>
                <li>
                    <a href="/Admin_Caps/admin/instructor/instructor.php" style="text-decoration: none;" onclick="setActiveMenuItem(this)"><i class="fa fa-users"></i> <span>List of Instructor</span></a>
                </li>
               <!-- <li class="menu-title"> -->
                   <!-- <span>Pages</span> -->
                </li>
                <li>
                    <a href="/Admin_Caps/admin/semester/semester.php" style="text-decoration: none;"><i class="fa fa-cogs"></i> <span>Set Semester</span>
                        
                    </a>
                </li>

                <li class="submenu">
                    <a href="#" style="text-decoration: none;" onclick="setActiveMenuItem(this)"><i class="fas fa-newspaper"></i> <span>Reports</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="/Admin_Caps/admin/report/students.php" style="text-decoration: none;" onclick="setActiveMenuItem(this)">Students</a></li>
                        <li><a href="/Admin_Caps/admin/report/perInstructor.php" style="text-decoration: none;" onclick="setActiveMenuItem(this)">Student List per Instructor</a></li>
                        <li><a href="/Admin_Caps/admin/report/perCourse.php" style="text-decoration: none;" onclick="setActiveMenuItem(this)">Students Enrolled per Course/Year</a></li>
                        <li><a href="/Admin_Caps/admin/report/perSubject.php" style="text-decoration: none;" onclick="setActiveMenuItem(this)">Students Enrolled per Subject</a></li>
                        <li><a href="/Admin_Caps/admin/report/perSection.php" style="text-decoration: none;" onclick="setActiveMenuItem(this)">Students Enrolled per Section</a></li>
                        <li><a href="/Admin_Caps/admin/report/perSemester.php" style="text-decoration: none;" onclick="setActiveMenuItem(this)">Students Enrolled per Semester</a></li>
                        <li><a href="/Admin_Caps/admin/report/systemLog.php" style="text-decoration: none;" onclick="setActiveMenuItem(this)">System Log</a></li>
                    </ul>
                </li>
               <!-- <li class="menu-title"> -->
               <!--     <span>Others</span> -->
                </li>
                <li>
                <a href="/Admin_Caps/admin/users/users.php" style="text-decoration: none;" onclick="setActiveMenuItem(this)"><i class="fa fa-users"></i> <span>Users</span></a>
                </li>
                <li>
                    <a href="/Admin_Caps/admin/backup/backup.php" style="text-decoration: none;" onclick="setActiveMenuItem(this)"><i class="fas fa-database"></i> <span>Backup And Restore</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>





<script>
    window.addEventListener("load", () => {
    if (localStorage.getItem("isFullScreen") === "true") {
        // Attempt to enter fullscreen right away
        toggleFullScreen();
    }
});

// Toggle fullscreen on button click
function toggleFullScreen() {
    if (!document.fullscreenElement) {
        document.documentElement.requestFullscreen().catch(err => {
            console.log("Fullscreen error: " + err);
        });
        localStorage.setItem("isFullScreen", "true"); // Store in local storage
    } else {
        document.exitFullscreen().catch(err => {
            console.log("Exit fullscreen error: " + err);
        });
        localStorage.setItem("isFullScreen", "false"); // Store in local storage
    }
}

</script>



<script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/feather.min.js"></script>
    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/plugins/apexchart/apexcharts.min.js"></script>
    <script src="assets/plugins/apexchart/chart-data.js"></script>
    <script src="assets/js/script.js"></script>