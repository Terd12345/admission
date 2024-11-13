<!DOCTYPE html>
<html lang="en">

<?php include('../template/template.php'); ?>

<?php
include '../database/db_conn.php';



// Check if the user is logged in
if (!isset($_SESSION['admin_username'])) {
    header("Location: index.php?error=You must log in first");
    exit();
}

// Check if the user ID is set
if (!isset($_SESSION['admin_id'])) {
    echo "User  ID is not set in the session.";
    exit();
}

// Set the user ID from session
$id = (int)$_SESSION['admin_id']; // Use the logged-in user's ID

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the query
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);

// Execute the query
if ($stmt->execute()) {
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $user_data = $result->fetch_assoc();
    } else {
        echo "User  not found.";
        exit;
    }
} else {
    echo "Error executing query: " . $stmt->error;
    exit;
}

$stmt->close();
$conn->close();
?>

<link rel="shortcut icon" href="../assets/img/favicon.png">
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/plugins/feather/feather.css">
<link rel="stylesheet" href="../assets/plugins/icons/flags/flags.css">
<link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">
<link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">
<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css">
<link rel="stylesheet" href="../assets/plugins/fullcalendar/fullcalendar.min.css">

<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col">
                            <h3 class="page-title">Profile</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="profile-header">
                            <div class="row align-items-center">
                                <div class="col-auto profile-image">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#uploadModal">
                                    <?php 
                                        // Assuming 'profile' is the column name in your database that stores the image filename
                                        $profile_image = !empty($user_data['profile']) ? htmlspecialchars($user_data['profile']) : 'user.png';
                                        ?>
                                        <img class="rounded-circle" alt="User  Image" src="../assets/img/profiles/<?php echo $profile_image; ?>" style="width:100px; height:100px;">
                                    </a>
                                </div>
                                <div class="col ms-md-n2 profile-user-info">
                                    <h4><?php echo htmlspecialchars($user_data['name']); ?></h4>
                                    <h6 class="text-muted mb-0"><?php echo htmlspecialchars($user_data['role']); ?></h6>
                                </div>
                            </div>
                        </div>

                        <!-- Profile Menu -->
                        <div class="profile-menu">
                            <ul class="nav nav-tabs nav-tabs-solid">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#per_details_tab">About</a>
                                </li>
                            </ul>
                        </div>

                        <!-- Profile Details -->
                        <div class="tab-content profile-tab-cont">
                            <div class="tab-pane fade show active" id="per_details_tab">
                                <div class="row">
                                    <div class="col-lg-9">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Personal Details</h5>
                                                <div class="row">
                                                    <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Name</p>
                                                    <p class="col-sm-9"><?php echo htmlspecialchars($user_data['name']); ?></p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Date of Birth</p>
                                                    <p class="col-sm-9"><?php echo htmlspecialchars($user_data['dob']); ?></p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Email ID</p>
                                                    <p class="col-sm-9"><?php echo htmlspecialchars($user_data['email']); ?></p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Mobile</p>
                                                    <p class="col-sm-9"><?php echo htmlspecialchars($user_data['contact_num']); ?></p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-sm-3 text-muted text-sm-end mb-0">Address</p>
                                                    <p class="col-sm-9"><?php echo htmlspecialchars($user_data['address']); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/feather.min.js"></script>
    <script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="../assets/js/script.js"></script>
</body>
</html>