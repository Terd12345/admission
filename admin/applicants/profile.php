<html>
 <head>
  <title>
   Student Information
  </title>
  <?php include "../template/template.php"; ?>

  <?php 
  
  include "../database/db_conn.php";




  // Check if ID is provided in URL
if (!isset($_GET['id'])) {
    echo "<script>alert('No student ID provided'); window.location.href='applicants.php';</script>";
    exit;
}

$student_id = $_GET['id'];

// Fetch student data including course information
$sql = "SELECT a.*, c.course_name 
        FROM applicants a 
        LEFT JOIN course c ON a.course_id = c.course_id 
        WHERE a.id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<script>alert('No student found with this ID'); window.location.href='students.php';</script>";
    exit;
}

$student = $result->fetch_assoc();
  
  ?>

<link rel="shortcut icon" href="../assets/img/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700&display=swap"rel="stylesheet">
    <link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/plugins/feather/feather.css">
    <link rel="stylesheet" href="../assets/plugins/icons/flags/flags.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/profile_applicants.css">

    <link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" href="../assets/plugins/fullcalendar/fullcalendar.min.css">

<!-- DataTables CSS and JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
 </head>
 <body>




 <div class="main-wrapper">
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">



                <ul class="breadcrumb">
                <li>
                    <a href="/admin_page/index.php" style="color: gray;">Home</a>
                </li>
                <li><i class='bx bx-chevron-right' >></i></li>
                <li>
                    <a class="active" href="/Admin_Caps/applicants/applicants.php">New Applicants</a>
                </li>

                <li><i class='bx bx-chevron-right' >></i></li>

                <li>
                    <a class="active" href="/Admin_Caps/report/report.php">Profile</a>
                </li>

            </ul>

<br><br><br><br><br><br>


  <div class="container mt-5">
   <div class="row">
    <div class="col-md-3">
     <div class="profile-image">
      <img alt="Profile image" style="margin-bottom: 35px;" height="150" src="<?php echo htmlspecialchars('/Admin_Caps/pearlLanding/applicantsPortal/uploads/' . $student['stud_image']); ?>" width="150"/>
     </div>
     <div class="profile-info">
      <p>
       <strong>
        Real name
       </strong>
       <br/>
       <?php 
       $full_name = $student['given_name'] . ' ';
        
       // Only add middle name if it's not "Not Applicable"
       if($student['middle_name'] != 'Not Applicable') {
           $full_name .= $student['middle_name'] . ' ';
       }
       
       $full_name .= $student['last_name'];
       
       echo htmlspecialchars($full_name);
       ?>
      </p>
      <p>
       <strong>
        Course
       </strong>
       <br/>
       <?php echo htmlspecialchars($student['course_name']); ?>
      </p>
      <p>
       <strong>
        Status
       </strong>
       <br/>
       <?php echo htmlspecialchars($student['status'] ?? 'New'); ?>
      </p>
     </div>
    </div>
    <div class="col-md-9">
     <h3>
      Student Information
     </h3>
     <form>
      
      
      <div class="mb-3 row">
       <label class="col-sm-2 col-form-label" for="firstName">
        First name
       </label>
      
       <div class="col-sm-2">
        <input class="form-control" id="firstName" readonly type="text" value="<?php echo htmlspecialchars($student['given_name']); ?>"/>
       </div>
       
       <label class="col-sm-2 col-form-label" for="lastName">
        Last name
       </label>

       <div class="col-sm-2">
        <input class="form-control" id="lastName" type="text" readonly value="<?php echo htmlspecialchars($student['last_name']); ?>"/>
       </div>


       <label class="col-sm-2 col-form-label" for="middleName">
        Middle name
       </label>

       <div class="col-sm-2">
        <input class="form-control" id="middle_name" type="text" readonly value="<?php echo htmlspecialchars($student['middle_name']); ?>"/>
       </div>



      </div>
      <div class="mb-3 row">
       <label class="col-sm-2 col-form-label" for="address">
        Address
       </label>
       <div class="col-sm-10">
        <input class="form-control" id="address" type="text" readonly value="<?php echo htmlspecialchars($student['address']); ?>"/>
       </div>
      </div>
      <div class="mb-3 row">
       <label class="col-sm-2 col-form-label">
        Sex
       </label>

       <div class="col-sm-4">
        <div class="form-check form-check-inline">
         <input checked="" class="form-check-input" id="female" readonly name="sex" type="radio" value="female" <?php echo ($student['sex'] == 'female') ? 'checked' : ''; ?> />
         <label class="form-check-label" for="female">
          Female
         </label>
        </div>
        <div class="form-check form-check-inline">
         <input class="form-check-input" id="male" name="sex" readonly type="radio" value="male" <?php echo ($student['sex'] == 'male') ? 'checked' : ''; ?> />
         <label class="form-check-label" for="male">
          Male
         </label>
        </div>
       </div>

       <label class="col-sm-2 col-form-label" for="dob">
        Date of birth
       </label>
       <div class="col-sm-4">
        <div class="input-group">
         <span class="input-group-text">
          <i class="fas fa-calendar-alt">
          </i>
         </span>
         <input class="form-control" id="dob" type="date" readonly value="<?php echo htmlspecialchars($student['date_birth']); ?>"/>
        </div>
       </div>
      </div>
      <div class="mb-3 row">
       <label class="col-sm-2 col-form-label" for="placeOfBirth">
        Place of Birth
       </label>
       <div class="col-sm-4">
        <input class="form-control" id="placeOfBirth" type="text" readonly value="<?php echo htmlspecialchars($student['birthplace']); ?>"/>
       </div>
       <label class="col-sm-2 col-form-label" for="nationality">
        Nationality
       </label>
       <div class="col-sm-4">
        <input class="form-control" id="nationality" type="text" readonly value="<?php echo htmlspecialchars($student['nationality']); ?>"/>
       </div>
      </div>
    
    
      <div class="mb-3 row">
       <label class="col-sm-2 col-form-label" for="religion">
        Religion
       </label>
    
       <div class="col-sm-2">
        <input class="form-control" id="religion" type="text" readonly value="<?php echo htmlspecialchars($student['religion']); ?>"/>
       </div>
    
       <label class="col-sm-2 col-form-label" for="contactNo">
        Contact No. 
       </label>
    
       <div class="col-sm-2">
        <input class="form-control" id="contactNo" type="number" readonly value="<?php echo htmlspecialchars($student['contact_no']); ?>"/>
       </div>
      
       <label class="col-sm-2 col-form-label" for="contactNo">
        Civil Status
       </label>
    
       <div class="col-sm-2">
       <select class="form-control" id="academicYear" readonly>
       <option <?php echo ($student['civil_status'] == 'Single') ? 'selected' : ''; ?>>Single</option>
    <option <?php echo ($student['civil_status'] == 'Married') ? 'selected' : ''; ?>>Married</option>
    <option <?php echo ($student['civil_status'] == 'Widow') ? 'selected' : ''; ?>>Widow</option>
                </select>
       </div>
    
    </div>
      <div class="mb-3 row">
       <label class="col-sm-2 col-form-label" for="email">
        E-Mail
       </label>
       <div class="col-sm-10">
        <input class="form-control" id="email" type="email" readonly value="<?php echo htmlspecialchars($student['email']); ?>"/>
       </div>
      </div>
     


<!-- 
       <div class="mb-3 row">
                <div class="col-sm-6">
                    <label for="height" class="form-label">Height</label>
                    <input type="text" class="form-control" id="height" readonly placeholder="Height" value="<?php echo htmlspecialchars($student['height']); ?>"/>
                </div>
                <div class="col-sm-6">
                    <label for="weight" class="form-label">Weight</label>
                    <input type="text" class="form-control" id="weight" readonly placeholder="Weight" value="<?php echo htmlspecialchars($student['weight']); ?>"/>
                </div>
            </div> -->
            <!-- <div class="row mb-3">
                <div class="col">
                    <label for="churchName" class="form-label">Name of Church you Attended</label>
                    <input type="text" class="form-control" id="churchName" readonly placeholder="Name of Church" value="<?php echo htmlspecialchars($student['church_name']); ?>"/>
                </div>
                <div class="col">
                    <label for="churchAddress" class="form-label">Church Address</label>
                    <input type="text" class="form-control" id="churchAddress" readonly placeholder="Church Address" value="<?php echo htmlspecialchars($student['church_address']); ?>"/>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="pastorName" class="form-label">Name of Pastor</label>
                    <input type="text" class="form-control" id="pastorName" readonly placeholder="Name of Pastor" value="<?php echo htmlspecialchars($student['name_pastor']); ?>"/>
                </div>
                <div class="col">
                    <label for="ministry" class="form-label">Ministry you Involved</label>
                    <input type="text" class="form-control" id="ministry" readonly placeholder="Ministry" value="<?php echo htmlspecialchars($student['ministry_involved']); ?>"/>
                </div>
            </div> -->
            <!-- <div class="row mb-3">
                <div class="col">
                    <label for="pastorContact" class="form-label">Pastor Contact No.</label>
                    <input type="text" class="form-control" id="pastorContact" readonly placeholder="Contact No." value="<?php echo htmlspecialchars($student['pastor_no']); ?>"/>
                </div>
            </div> -->
            <div class="row mb-3">
                <div class="col">
                    <label for="highSchoolName" class="form-label">High School Name</label>
                    <input type="text" class="form-control" id="highSchoolName" readonly placeholder="School Name" value="<?php echo htmlspecialchars($student['high_school']); ?>"/>
                </div>
                <div class="col">
                    <label for="highSchoolYear" class="form-label">Year Graduated</label>
                    <input type="text" class="form-control" id="highSchoolYear" readonly placeholder="Year Graduated" value="<?php echo htmlspecialchars($student['high_year_graduated']); ?>"/>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="collegeSchool" class="form-label">College School</label>
                    <input type="text" class="form-control" id="collegeSchool" readonly placeholder="School Name" value="<?php echo htmlspecialchars($student['college_school']); ?>"/>
                </div>
                <div class="col">
                    <label for="collegeCourse" class="form-label">Course</label>
                    <input type="text" class="form-control" id="collegeCourse" readonly placeholder="Course" value="<?php echo htmlspecialchars($student['college_course']); ?>"/>>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="collegeYear" class="form-label">College Year Graduated</label>
                    <input type="text" class="form-control" id="collegeYear" readonly placeholder="Year Graduated" value="<?php echo htmlspecialchars($student['college_year_graduated']); ?>"/>
                </div>
                <!-- <div class="col">
                    <label for="vocationalSchool" class="form-label">Vocational School</label>
                    <input type="text" class="form-control" id="vocationalSchool" readonly placeholder="School Name" value="<?php echo htmlspecialchars($student['vocational_school']); ?>"/>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="vocationalCourse" class="form-label">Vocational School Course</label>
                    <input type="text" class="form-control" id="vocationalCourse" readonly placeholder="Course" value="<?php echo htmlspecialchars($student['vocational_course']); ?>"/>
                </div>
                <div class="col">
                    <label for="vocationalYear" class="form-label">Year Graduated</label>
                    <input type="text" class="form-control" id="vocationalYear" readonly placeholder="Year Graduated" value="<?php echo htmlspecialchars($student['vocational_year_graduated']); ?>"/>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="otherSchool" class="form-label">Other School</label>
                    <input type="text" class="form-control" id="otherSchool" readonly placeholder="School Name" value="<?php echo htmlspecialchars($student['other_school']); ?>"/>
                </div>
                <div class="col">
                    <label for="otherCourse" class="form-label">Course</label>
                    <input type="text" class="form-control" id="otherCourse" readonly placeholder="Course" value="<?php echo htmlspecialchars($student['other_school_course']); ?>"/>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="otherYear" class="form-label">Year Graduated</label>
                    <input type="text" class="form-control" id="otherYear" readonly placeholder="Year Graduated" value="<?php echo htmlspecialchars($student['other_year_graduated']); ?>"/>
                </div>
            </div> -->
            <div class="row mb-3">
                <div class="col"><br>
                    <label for="uploadedTOR" class="form-label">TOR  </label>
                    <!-- <input type="file" class="form-control" id="uploadedTOR"> -->
                    <a href="/Admin_Caps/pearlLanding/applicantsportal<?php echo $student['TOR']; ?>" target="_blank"><?php echo $student['TOR']; ?></a>
                </div>
                <!-- <div class="col">
                    <label for="uploadedPastorRecommendation" class="form-label">Pastor Recommendation</label>
                    
                    <a href="/Admin_Caps/pearlLanding/applicantsportal<?php echo $student['pastor_reco']; ?>" target="_blank"><?php echo $student['pastor_reco']; ?></a>
                </div>
            </div> -->
            <div class="row mb-3">
                <div class="col">
                    <label for="uploadedStudentImage" class="form-label">Student Image</label>
                    <!-- <input type="file" class="form-control" id="uploadedStudentImage"> -->
                    <a href="/Admin_Caps/pearlLanding/applicantsportal<?php echo $student['stud_image']; ?>" target="_blank"><?php echo $student['stud_image']; ?></a>
                </div>
                <div class="col">
                    <label for="uploadedForm137" class="form-label">Form137</label>
                    <!-- <input type="file" class="form-control" id="uploadedForm137"> -->
                    <a href="/Admin_Caps/pearlLanding/applicantsportal<?php echo $student['form137']; ?>" target="_blank"><?php echo $student['form137']; ?></a>
                </div>
            </div>
            <!-- <div class="row mb-3">
                <div class="col text-center">
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div> -->


    
    </div>
     
    </form>
    </div>
   </div>
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