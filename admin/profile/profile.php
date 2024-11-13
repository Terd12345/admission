<!DOCTYPE html>
<html lang="en">

<?php include('../template/template.php'); ?>


<?php


include '../database/db_conn.php';

$userId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id === 0) {
    echo "No valid user ID provided.";
    exit;
}

// Fetch user data from the database
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
} else {
    echo "User not found.";
    exit;
}


$stmt->close();
$conn->close();

?>


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


    


<body>

    <div class="main-wrapper">



        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="page-header">
                    <div class="row">
                        <div class="col">
                           <a href="../users/users.php"><h3 class="page-title">Back </h3></a>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ul>
                        </div>
                    </div>
                </div>


                <style>
                .profile-image img {
    width: 150px; /* Adjust as needed */
    height: 150px; /* Adjust as needed */
    border-radius: 60%; /* Makes the image circular */
    object-fit: cover; /* Ensures the image covers the entire space */
}
                </style>

                <div class="row">
                    <div class="col-md-12">
                        <div class="profile-header">
                            <div class="row align-items-center">
                                <div class="col-auto profile-image">
                                    <a href="#">
                                        <!-- <img class="rounded-circle" alt="User Image" src="../assets/img/profiles/user.png"> -->
                                        <div class="col-auto profile-image">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#uploadImageModal">
                                            <?php 
                                        // Assuming 'profile' is the column name in your database that stores the image filename
                                        $profile_image = !empty($user_data['profile']) ? htmlspecialchars($user_data['profile']) : 'user.png';
                                        ?>
                                        <img class="rounded-circle" alt="User  Image" src="../assets/img/profiles/<?php echo $profile_image; ?>" style="width:100px; height:100px;">
                                    
                                            </a>
                                        </div>
                                    </a>
                                </div>
                                <div class="col ms-md-n2 profile-user-info">
                                    <h4 class="user-name mb-0"><?php echo htmlspecialchars($user_data['name']); ?></h4>
                                    <h6 class="text-muted"><?php echo htmlspecialchars($user_data['role']); ?></h6>
                                    <!-- <div class="user-Location"><i class="fas fa-map-marker-alt"></i> Lorem ipsum dolor sit amet.</div> -->
                                </div>
                                <!-- <div class="col-auto profile-btn">
                                    <a href="" class="btn btn-primary">
                                        Edit
                                    </a>
                                </div> -->
                            </div>
                        </div>
                        <div class="profile-menu">
                            <ul class="nav nav-tabs nav-tabs-solid">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#per_details_tab">About</a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#password_tab">Password</a>
                                </li> -->
                            </ul>
                        </div>
                        <div class="tab-content profile-tab-cont">

                            <div class="tab-pane fade show active" id="per_details_tab">

                                <div class="row">
                                    <div class="col-lg-9">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title d-flex justify-content-between">
                                                    <span>Personal Details</span>
                                                    <!-- <a class="edit-link" data-bs-toggle="modal" href="#editUserForm">
                                                        <i class="far fa-edit me-1"></i>Add a File
                                                    </a> -->
                                                </h5>
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
                                                    <p class="col-sm-9">[<?php echo htmlspecialchars($user_data['email']); ?>]</p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-sm-3 text-muted text-sm-end mb-0 mb-sm-3">Mobile</p>
                                                    <p class="col-sm-9"><?php echo htmlspecialchars($user_data['contact_num']); ?></p>
                                                </div>
                                                <div class="row">
                                                    <p class="col-sm-3 text-muted text-sm-end mb-0">Address</p>
                                                    <p class="col-sm-9 mb-0"><?php echo htmlspecialchars($user_data['address']); ?>
                                                    <br><br>


                                                    
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





<!-- Upload Image Modal -->
<div class="modal fade" id="uploadImageModal" tabindex="-1" aria-labelledby="uploadImageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadImageModalLabel">Upload Profile Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="uploadImageForm" action=" user_actions.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($user_data['id']); ?>">
                    <input type="hidden" name="action" value="upload_image">
                    <div class="mb-3">
                        <label for="profile" class="form-label">Profile Image</label>
                        <input type="file" class="form-control" id="profile" name="profile" accept="image/*" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="uploadImageForm" class="btn btn-primary">Upload</button>
            </div>
        </div>
    </div>
</div>

















<!-- Edit User Modal -->
<!-- <div class="modal fade" id="editUserForm" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editUserForm" method="POST" action="user_actions.php" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="id" id="editUserId">
                    
                    
                    <div class="row">
                    <div class="col-md-6 mb-3">
                            <label for="portfolio" class="form-label">Portfolio</label>
                            <input type="file" class="form-control" id="portfolio" name="portfolio" placeholder="Enter Portfolio File" required>
                        </div>
                    
                        <div class="col-md-6 mb-3">
                            <label for="cv" class="form-label">CV</label>
                            <input type="file" class="form-control" id="cv" name="cv" placeholder="Enter Address" required>
                        </div>
                    </div>

                    <div class="row">
                    
                        <div class="col-md-6 mb-3">
                            <label for="transcript" class="form-label">Transcripts</label>
                            <input type="file" class="form-control" id="transcripts" name="transcripts" placeholder="Enter Portfolio File" required>
                        </div>
                    
                        <div class="col-md-6 mb-3">
                            <label for="cover_letter" class="form-label">Cover Letter</label>
                            <input type="file" class="form-control" id="cover_letter" name="cover_letter" placeholder="Enter Address" required>
                        </div>
                    </div>
                    

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" form="editUserForm" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div> -->




    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="../assets/js/jquery-3.6.0.min.js"></script>

    <script src="../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="../assets/js/feather.min.js"></script>

    <script src="../assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="../assets/js/script.js"></script>


    

</body>
</html>