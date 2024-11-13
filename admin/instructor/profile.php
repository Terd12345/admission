

<link rel="shortcut icon" href="../assets/img/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap"rel="stylesheet">
    <link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/plugins/feather/feather.css">
    <link rel="stylesheet" href="../assets/plugins/icons/flags/flags.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="../assets/plugins/fullcalendar/fullcalendar.min.css">

<!-- DataTables CSS and JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>



<?php 
  
  include "../database/db_conn.php";




  // Check if emp_id is provided in URL
if (!isset($_GET['id'])) {
    echo "<script>alert('No Instructor ID provided'); window.location.href='instructor.php';</script>";
    exit;
}

$id = $_GET['id'];

// Fetch instructor data
$sql = "SELECT * FROM instructors WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<script>alert('No instructor found with this ID'); window.location.href='instructor.php';</script>";
    exit;
}

$instructor = $result->fetch_assoc();
?>

<?php include "../template/template.php"; ?>

<div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-sub-header">
                            <h1 class="page-title">Instructor Profile</h1>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/Admin_Caps/main.php">Home</a></li>
                                <li class="breadcrumb-item active">Instructor</li>
                                <li class="breadcrumb-item active">Profile</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-3">
                        <div class="profile-image">
                            <img alt="Profile image" style="margin-bottom: 35px;" height="150" src="<?php echo htmlspecialchars('/Admin_Caps/instructor/uploads/' . $instructor['valid_id']); ?>" width="150"/>
                        </div>
                        <div class="profile-info">
                        
                         
                        </div>
                    </div>
                    <div class="col-md-9">
                        <h3>Instructor Information</h3>
                        <form>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label" for="firstName">
                                 name
                                </label>
      
       <div class="col-sm-2">
        <input class="form-control" id="firstName" readonly type="text" value="<?php echo htmlspecialchars($instructor['name']); ?>"/>
       </div>
       


      </div>
      <div class="mb-3 row">
       <label class="col-sm-2 col-form-label" for="address">
        Major
       </label>
       <div class="col-sm-10">
        <input class="form-control" id="address" type="text" readonly value="<?php echo htmlspecialchars($instructor['major']); ?>"/>
       </div>
      </div>
      <div class="mb-3 row">

    

       <label class="col-sm-2 col-form-label" for="dob">
        Date of birth
       </label>
       <div class="col-sm-4">
        <div class="input-group">
         <span class="input-group-text">
          <i class="fas fa-calendar-alt">
          </i>
         </span>
         <input class="form-control" id="dob" type="date" readonly value="<?php echo htmlspecialchars($instructor['birthday']); ?>"/>
        </div>
       </div>
      </div>
      <div class="mb-3 row">
       <label class="col-sm-2 col-form-label" for="placeOfBirth">
        Contact
       </label>
       <div class="col-sm-4">
        <input class="form-control" id="placeOfBirth" type="text" readonly value="<?php echo htmlspecialchars($instructor['contact']); ?>"/>
       </div>
       <label class="col-sm-2 col-form-label" for="nationality">
        Email
       </label>
       <div class="col-sm-4">
        <input class="form-control" id="nationality" type="text" readonly value="<?php echo htmlspecialchars($instructor['email']); ?>"/>
       </div>
      </div>
    
    
      <div class="mb-3 row">
       <label class="col-sm-2 col-form-label" for="religion">
        Civil Status
       </label>
    
       <div class="col-sm-2">
        <input class="form-control" id="religion" type="text" readonly value="<?php echo htmlspecialchars($instructor['civil_stats']); ?>"/>
       </div>
    
      
            </div>
            <div class="row">
                <div class="col">
                    <label for="uploadedTOR" class="form-label">Portfolio:  </label>
                    <!-- <input type="file" class="form-control" id="uploadedTOR"> -->
                    <a href="/Admin_Caps/instructor/uploads/<?php echo $instructor['portfolio']; ?>" target="_blank"><?php echo $instructor['portfolio']; ?></a>
                </div><br>
                <div class="row">
                <div class="col">
                    <label for="uploadedPastorRecommendation" class="form-label">CV:</label>
                    <!-- <input type="file" class="form-control" id="uploadedPastorRecommendation"> -->
                    <a href="/Admin_Caps/instructor/uploads/<?php echo $instructor['cv']; ?>" target="_blank"><?php echo $instructor['cv']; ?></a>
                </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="uploadedStudentImage" class="form-label">Transcripts:</label>
                    <!-- <input type="file" class="form-control" id="uploadedStudentImage"> -->
                    <a href="/Admin_Caps/instructor/uploads/<?php echo $instructor['transcripts']; ?>" target="_blank"><?php echo $instructor['transcripts']; ?></a>
                </div>
                <div class="row mb-3">
                <div class="col">
                    <label for="uploadedForm137" class="form-label">Valid Id:</label>
                    <!-- <input type="file" class="form-control" id="uploadedForm137"> -->
                    <a href="/Admin_Caps/instructor/uploads/<?php echo $instructor['valid_id']; ?>" target="_blank"><?php echo $instructor['valid_id']; ?></a>
                </div>
        
                <div class="row mb-3">
            <div class="col">
                    <label for="uploadedForm137" class="form-label">Cover Letter:</label>
                    <!-- <input type="file" class="form-control" id="uploadedForm137"> -->
                    <a href="/Admin_Caps/instructor/uploads/<?php echo $instructor['cover_letter']; ?>" target="_blank"><?php echo $instructor['cover_letter']; ?></a>
                </div>
                </div>
</div>

    
    </div>
     
    </form>
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