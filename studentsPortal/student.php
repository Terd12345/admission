<link rel="shortcut icon" href="../../assets/images/logoPearl.png" type="image/x-icon">

<?php 


// session_start();
include 'db_conn.php';



    // Only show the modal if 'terms_shown' is not set in the session
// $showTermsModal = !isset($_SESSION['terms_shown']);

// if ($showTermsModal) {
//     $showTermsModal = true;
//     $_SESSION['terms_shown'] = true;
// } else {
//     $showTermsModal = false;
// }





include 'students_portal.php'; 






if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the user is logged in by verifying if 'id' is set in the session
if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id']; // Get the logged-in user's ID from the session




    // Query to fetch user data based on their ID
    $sql = "SELECT given_name, last_name, middle_name, email, course_id, address, course_id, height,
    weight, date_birth, birthplace, sex, nationality, religion, contact_no,
    civil_status, high_school, high_year_graduated, college_school, college_course, 
    college_year_graduated, vocational_school, vocational_course, vocational_year_graduated, 
    other_school, other_school_course, other_year_graduated, church_name, church_address, name_pastor, pastor_no,
    TOR, pastor_reco, stud_image, form137, church_name, church_address, name_pastor, pastor_no, ministry_involved FROM students WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id); // "i" for integer type
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the row data as an associative array
        $row = $result->fetch_assoc();
        
        // Store values in variables
        $given_name                 = $row['given_name'];
        $last_name                  = $row['last_name'];
        $middle_name                = $row['middle_name'];
        $email                      = $row['email'];
        $course_id                  = $row['course_id'];
        $address                    = $row['address'];
        $height                     = $row['height'];
        $weight                     = $row['weight'];
        $date_birth                 = $row['date_birth'];
        $birthplace                 = $row['birthplace'];
        $sex                        = $row['sex'];
        $nationality                = $row['nationality'];
        $religion                   = $row['religion'];
        $contact_no                 = $row['contact_no'];
        $civil_status               = $row['civil_status'];
        $high_school                = $row['high_school'];
        $high_year_graduated        = $row['high_year_graduated'];
        $college_school             = $row['college_school'];
        $college_course             = $row['college_course'];
        $college_year_graduated     = $row['college_year_graduated'];
        $vocational_school          = $row['vocational_school'];
        $vocational_course          = $row['vocational_course'];
        $vocational_year_graduated  = $row['vocational_year_graduated'];
        $other_school               = $row['other_school'];
        $other_school_course        = $row['other_school_course'];
        $other_year_graduated       = $row['other_year_graduated'];
        $church_name                = $row['church_name'];
        $church_address             = $row['church_address'];
        $name_pastor                = $row['name_pastor'];
        $pastor_no                  = $row['pastor_no'];
        $ministry_involved          = $row['ministry_involved'];
        $TOR                        = $row['TOR'];
        $pastor_reco                = $row['pastor_reco'];
        $stud_image                 = $row['stud_image'];
        $form137                    = $row['form137'];
        


        // Store document paths
        $TOR_link = !empty($row['TOR']) ? "../applicantsPortal{$row['TOR']}" : null;
        $pastor_reco_link = !empty($row['pastor_reco']) ? "../applicantsPortal/uploads/{$row['pastor_reco']}" : null;
        $stud_image_link = !empty($row['stud_image']) ? "../applicantsPortal/uploads/{$row['stud_image']}" : null;
        $form137_link = !empty($row['form137']) ? "../applicantsPortal/uploads/{$row['form137']}" : null;


    } else {
        echo "No user found";
    }



    $courses_sql = "SELECT course_id, course_name FROM course"; // Assuming your courses table has `id` and `course_name`
    $courses_result = mysqli_query($conn, $courses_sql);
    
    if ($courses_result) {
        $courses = mysqli_fetch_all($courses_result, MYSQLI_ASSOC); // Fetch all courses
    } else {
        echo "Error fetching courses: " . mysqli_error($conn);
    }



} else {
    echo "User not logged in";
}

mysqli_close($conn);

?>





<style>
     /* Basic styling for modal */
        .modal { display: none; /* Initially hidden */ position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); }
        .modal.active { display: block; /* Show when active */ }
        .modal-content { background: white; padding: 20px; margin: 100px auto; width: 80%; max-width: 500px; border-radius: 8px; text-align: center; }


     
</style>



 <!-- Modal -->
<!-- <div id="termsModal" class="modal" >
    <div class="modal-content">
        <h2>Terms and Conditions</h2>
        <div class="terms-content">
            1. Acceptance of Terms<br>
            By accessing or using this service, you agree to be bound by these terms and conditions, which govern your use of our website and services. If you do not agree with these terms, you should discontinue the use of our services immediately.<br>
            2. Changes to Terms<br>
            We reserve the right to modify or update these terms at any time, without prior notice. Any changes will be effective immediately upon posting. It is your responsibility to review these terms regularly to stay informed of updates.<br>
            3. User Conduct<br>
            As a user of this service, you agree to:<br>
            - Provide accurate and up-to-date information when required.<br>
            - Not engage in any activities that could harm, disrupt, or impair the operation of our services.<br>
            - Respect the privacy and personal data of others.<br>
            You also agree not to engage in:<br>
            - Any form of fraudulent activity or misrepresentation.<br>
            - Posting of harmful, obscene, or unlawful content.<br>
            - Unauthorized access to any part of our system.<br>
            4. Intellectual Property<br>
            All content, including text, images, software, and other materials on this site, are protected by intellectual property laws. You may not copy, reproduce, or distribute any content from this site without prior written permission from us.<br>
            5. Privacy<br>
            Your privacy is important to us. Our Privacy Policy outlines how we collect, use, and protect your personal information. By using our services, you consent to the collection and use of your data as outlined in the Privacy Policy.<br>
            6. Limitation of Liability<br>
            We are not liable for any damages, including but not limited to direct, indirect, incidental, or consequential damages, that may arise from your use or inability to use the services. You use the services at your own risk.<br>
            7. Termination of Service<br>
            We reserve the right to terminate or suspend your access to our services at any time, for any reason, including but not limited to violations of these terms.<br>
            8. Governing Law<br>
            Any disputes arising from the use of the service will be resolved through arbitration in B151 L14-20 Ph1, Mabuhay City Subd., Paliparan III, Dasmariñas.<br>
            9. Contact Information<br>
            If you have any questions or concerns regarding these terms, please contact us at poile2005.official@gmail.com | 0919 458 9099.<br>
            <br>
            I have read and agree to the terms and conditions.
        </div>
        <button id="agreeButton">I Agree</button>
    </div>
</div> -->





<title>Students Portal</title>

<style>
    

    .container{
        margin-top: 45%;
        width: 100%;
        padding: 20px;
        margin: 0 auto;
        background-color: #f8f9fa;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 35px;
    }

    /* Custom CSS styles */
    .form-row {
        display: flex;
        gap: 20px;
    }
    .form-group {
        flex: 1;
        display: flex;
        align-items: center;
    }
    .form-group i {
        margin-right: 10px;
    }
    .form-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        text-indent: 25px;
    }

    .form-group label {
        margin-bottom: 0.5rem; /* Adjust space below the label */
        display: block; /* Make label a block element for full width */
        /* font-weight: bold; Make the label text bold */
    }
    .form-group select {
        width: 100%; /* Ensure the select takes full width */
    }



    /* Modal Styles */
.modal {
    display: flex; /* Show modal by default */
    position: fixed;
    /* width: 80%; */
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Black background with opacity */
}

.modal-content {
    background-color: #fefefe;
    margin: 10% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 60%;
    max-height: 70%;
    overflow-y: auto;
    text-align: center;
    z-index: 1;
}

button {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}

.terms-content{
    margin: 40px;
    text-align: center;
}


</style>




<br>
<div class="container">
    <div class="step-indicator">
        <span class="step-indicator-item active">1</span>
        <span class="step-indicator-item">2</span>
        <span class="step-indicator-item">3</span>
        <!-- <span class="step-indicator-item">4</span> -->
    </div>

    <form id="multiStepForm" method="POST" action="submit.php" enctype="multipart/form-data">
        <!-- Step 1: Personal Information -->
        <div class="step active">
            <h3>Step 1: Personal Information</h3>
            <div class="form-row">
                <div class="form-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="given_name" placeholder="First Name" disabled value="<?php echo htmlspecialchars($given_name); ?>">
                </div>
                <div class="form-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="last_name" placeholder="Last Name" disabled value="<?php echo htmlspecialchars($last_name); ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="middle_name" placeholder="Middle Name" disabled value="<?php echo htmlspecialchars($middle_name); ?>">
                </div>
                <div class="form-group">
                    <i class="fas fa-home"></i>
                    <input type="text" name="address" placeholder="Address" disabled required value="<?php echo htmlspecialchars($address); ?>">
                </div>
            </div>

            


      
            <div class="form-group">
    <label for="course">Select Course:</label>
    <select name="course_id" id="course" disabled class="form-control" required>
        <option value="" disabled <?php echo empty($course_id) ? 'selected' : ''; ?>>--Select Course--</option>
        <?php
        // Loop through the courses and create an option for each
        foreach ($courses as $course) {
            // Check if the current course ID matches the user's selected course ID
            $selected = ($course['course_id'] == $course_id) ? "selected" : ""; // Use the correct variable name here
            echo "<option value='{$course['course_id']}' $selected>{$course['course_name']}</option>";
        }
        ?>
    </select>
</div>
       


            <!-- <div class="form-row">
                <div class="form-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="height" disabled placeholder="Height (cm)" value="<?php echo htmlspecialchars(isset($height) && $height != 0 ? $height : ''); ?>"">
                </div>
                <div class="form-group">
                    <i class="fas fa-user"></i>
                    <input type="text" name="weight" disabled placeholder="Weight (kg)" value="<?php echo htmlspecialchars(isset($weight) && $weight != 0 ? $weight : ''); ?>">
                </div>
            </div> -->


            <div class="form-row">
                <div class="form-group">
                    <i class="fas fa-calendar"></i>
                    <input type="date" name="date_birth" disabled id="date_birth" required value="<?php echo htmlspecialchars($date_birth); ?>">
                </div>
                <div class="form-group">
                    <i class="fas fa-map-marker-alt"></i>
                    <input type="text" name="birthplace" disabled id="birthplace" placeholder="Birth Place" required value="<?php echo htmlspecialchars($birthplace); ?>">
                </div>
            </div>


            <div class="form-row">
                <div class="form-group">
                    <i class="fas fa-venus-mars"></i>
                    <label style="text-indent: 35px;">Sex:</label>
                    <input type="radio" name="sex" disabled value="Male" required <?php echo ($sex === 'Male') ? 'checked' : ''; ?>> Male
                    <input type="radio" name="sex" disabled value="Female" required <?php echo ($sex === 'Female') ? 'checked' : ''; ?>> Female
                </div>
                <div class="form-group">
                    <i class="fas fa-flag"></i>
                    <input type="text" name="nationality" disabled placeholder="Nationality" required value="<?php echo htmlspecialchars($nationality); ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <i class="fas fa-praying-hands"></i>
                    <input type="text" name="religion" disabled placeholder="Religion" required value="<?php echo htmlspecialchars($religion); ?>">
                </div>
                <div class="form-group">
                    <i class="fas fa-phone"></i>
                    <input type="text" name="contact_no" disabled placeholder="Contact Number" required value="<?php echo htmlspecialchars(isset($contact_no) && $contact_no != 0 ? $contact_no : ''); ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <i class="fas fa-heart"></i>
                    <input type="text" name="civil_status" disabled placeholder="Civil Status" required value="<?php echo htmlspecialchars($civil_status); ?>">
                </div>
                <div class="form-group">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email" disabled value="<?php echo htmlspecialchars($email); ?>">
                </div>
            </div>
            
        </div>

        

        <!-- Step 2: Contact Information -->
        <div class="step">
        <h3>Step 2: Educational Information</h3>

        <div class="form-row">
                <!-- <div class="form-group col-md-6">
                    <i class="fas fa-church"></i>
                    <input type="text" name="ministry" class="form-control" placeholder="Ministry you're Involved" required>
                </div> -->
                <div class="form-group col-md-6">
                    <i class="fas fa-school"></i>
                    <input type="text" name="high_school" disabled class="form-control" placeholder="High School Name" required value="<?php echo htmlspecialchars($high_school); ?>">
                </div>
            </div>

            <!-- High School Year Graduated and College School -->
            <div class="form-row">
                <div class="form-group col-md-6">
                    <i class="fas fa-calendar"></i>
                    <input type="number" name="high_year_graduated" disabled class="form-control" placeholder="High School Year Graduated" required value="<?php echo htmlspecialchars(isset($high_year_graduated) && $high_year_graduated != 0 ? $high_year_graduated : ''); ?>">
                </div>
                <div class="form-group col-md-6">
                    <i class="fas fa-university"></i>
                    <input type="text" name="college_school" disabled class="form-control" placeholder="College School" required value="<?php echo htmlspecialchars($college_school); ?>">
                </div>
            </div>

            <!-- College Course and Year Graduated -->
            <div class="form-row">
                <div class="form-group col-md-6">
                    <i class="fas fa-book"></i>
                    <input type="text" name="college_course" disabled class="form-control" placeholder="College Course" required value="<?php echo htmlspecialchars($college_course); ?>">
                </div>
                <div class="form-group col-md-6">
                    <i class="fas fa-calendar"></i>
                    <input type="number" name="college_year_graduated" disabled id="college_year_graduated" class="form-control" placeholder="College Year Graduated" required value="<?php echo htmlspecialchars(isset($college_year_graduated) && $college_year_graduated !=0 ? $college_year_graduated : '');?>">
                </div>
            </div>

            <!-- <div class="form-row">
                <div class="form-group col-md-6">
                    <i class="fas fa-school"></i>
                    <input type="text" name="vocational_school" disabled class="form-control" placeholder="Vocational School Name" required value="<?php echo htmlspecialchars($vocational_school); ?>">
                </div>
                <div class="form-group col-md-6">
                    <i class="fas fa-book"></i>
                    <input type="text" name="vocational_course" disabled class="form-control" placeholder="Vocational School Course" required value="<?php echo htmlspecialchars($vocational_course); ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <i class="fas fa-calendar"></i>
                    <input type="number" name="vocational_year_graduated" disabled class="form-control" placeholder="Vocational Year Graduated" required value="<?php echo htmlspecialchars($vocational_year_graduated); ?>">
                </div>
                <div class="form-group col-md-6">
                    <i class="fas fa-school"></i>
                    <input type="text" name="other_school" class="form-control" disabled placeholder="Other School Name" required value="<?php echo htmlspecialchars($other_school); ?>">
                </div>
            </div> -->

            <!-- <div class="form-row">
                <div class="form-group col-md-6">
                    <i class="fas fa-book"></i>
                    <input type="text" name="other_school_course" disabled class="form-control" placeholder="Other School Course" required value="<?php echo htmlspecialchars($other_school_course); ?>">
                </div>
                <div class="form-group col-md-6">
                    <i class="fas fa-calendar"></i>
                    <input type="number" name="other_year_graduated" disabled class="form-control" placeholder="Other School Year Graduated" required value="<?php echo htmlspecialchars($other_year_graduated); ?>">
                </div>
            </div> -->

        </div>

        <!-- Step 3: Address -->
        <!-- <div class="step">
            <h3>Step 3: Church Affiliation Information</h3> -->
            <!-- <div class="form-row">
                <div class="form-group col-md-6">
                    <i class="fas fa-university"></i>
                    <input type="text" name="church_name" disabled class="form-control" placeholder="Name of Church you Attended" required value="<?php echo htmlspecialchars($church_name); ?>">
                </div>
                <div class="form-group col-md-6">
                    <i class="fas fa-university"></i>
                    <input type="text" name="church_address" disabled class="form-control" placeholder="Church Address" required value="<?php echo htmlspecialchars($church_address); ?>">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <i class="fas fa-university"></i>
                    <input type="text" name="name_pastor" disabled class="form-control" placeholder="Name of Pastor" required value="<?php echo htmlspecialchars($name_pastor); ?>">
                </div>
                <div class="form-group col-md-6">
                    <i class="fas fa-university"></i>
                    <input type="number" name="pastor_no" disabled class="form-control" placeholder="Pastor Contact Number" required value="<?php echo htmlspecialchars($pastor_no) ?>">
                </div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-6">
                    <i class="fas fa-church"></i>
                    <input type="text" name="ministry_involved" disabled class="form-control" placeholder="Ministry you're Involved" required value="<?php echo htmlspecialchars($ministry_involved); ?>">
                </div>
            </div> -->

            

        <!-- </div> -->




        <div class="step">
    <h3>Step 4: Document Upload Requirements</h3>
    <div class="form-row">
        <!-- Transcript of Records -->
        <div class="form-group col-md-6" style="display: flex; flex-direction: column; margin-bottom: 20px;">
            <label for="TOR" style="margin-bottom: 5px; font-weight: bold;">Transcript of Records (TOR)</label>
            <input type="file" name="TOR" id="TOR" class="form-control" style="padding: 8px; font-size: 14px;" required>
            <?php if ($TOR_link): ?>
                <a href="<?= htmlspecialchars($TOR_link) ?>" target="_blank" style="margin-top: 5px; color: blue;">View Uploaded TOR</a>
            <?php endif; ?>
        </div>

        <!-- Pastor Recommendation Letter -->
        <div class="form-group col-md-6" style="display: flex; flex-direction: column; margin-bottom: 20px;">
            <!-- <label for="pastor_reco" style="margin-bottom: 5px; font-weight: bold;">Pastor Recommendation Letter</label>
            <input type="file" name="pastor_reco" id="pastor_reco" class="form-control" style="padding: 8px; font-size: 14px;">
            <?php if ($pastor_reco_link): ?>
                <a href="<?= htmlspecialchars($pastor_reco_link) ?>" target="_blank" style="margin-top: 5px; color: blue;">View Uploaded Pastor Recommendation</a>
            <?php endif; ?> -->
        </div>
    </div>

    <div class="form-row">
        <!-- Student Picture -->
        <div class="form-group col-md-6" style="display: flex; flex-direction: column; margin-bottom: 20px;">
            <label for="stud_image" style="margin-bottom: 5px; font-weight: bold;">2x2 Picture</label>
            <input type="file" name="stud_image" id="stud_image" class="form-control" style="padding: 8px; font-size: 14px;">
            <?php if ($stud_image_link): ?>
                <a href="<?= htmlspecialchars($stud_image_link) ?>" target="_blank" style="margin-top: 5px; color: blue;">View Uploaded Picture</a>
            <?php endif; ?>
        </div>

        <!-- Form 137 -->
        <div class="form-group col-md-6" style="display: flex; flex-direction: column; margin-bottom: 20px;">
            <label for="form137" style="margin-bottom: 5px; font-weight: bold;">Form 137</label>
            <input type="file" name="form137" id="form137" class="form-control" style="padding: 8px; font-size: 14px;" required>
            <?php if ($form137_link): ?>
                <a href="<?= htmlspecialchars($form137_link) ?>" target="_blank" style="margin-top: 5px; color: blue;">View Form 137</a>
            <?php endif; ?>
        </div>
    </div>
</div>




        <div class="buttons">
            <button type="button" id="prevBtn" disabled>Previous</button>
            <button type="button" id="nextBtn">Next</button>
            <button type="submit" id="submitBtn" style="display:none;">Submit</button>
        </div>
    </form>
</div>








<script>
    const steps = document.querySelectorAll(".step");
    const nextBtn = document.getElementById("nextBtn");
    const prevBtn = document.getElementById("prevBtn");
    const submitBtn = document.getElementById("submitBtn");
    const indicators = document.querySelectorAll(".step-indicator span");
    let currentStep = 0;

    function showStep(step) {
        steps.forEach((el, index) => {
            el.classList.remove("active");
            indicators[index].classList.remove("active");
            if (index === step) {
                el.classList.add("active");
                indicators[index].classList.add("active");
            }
        });

        prevBtn.disabled = step === 0;
        nextBtn.style.display = step === steps.length - 1 ? "none" : "inline";
        submitBtn.style.display = step === steps.length - 1 ? "inline" : "none";
    }

    nextBtn.addEventListener("click", () => {
        currentStep++;
        showStep(currentStep);
    });

    prevBtn.addEventListener("click", () => {
        currentStep--;
        showStep(currentStep);
    });

    showStep(currentStep);
</script>









<script>
    // document.addEventListener('DOMContentLoaded', function() {

    //     var showTermsModal = <?php echo json_encode($showTermsModal); ?>;

    //     if (showTermsModal) {
      
    //         document.getElementById('termsModal').classList.add('active');
    //     }

    //     document.getElementById('agreeButton').addEventListener('click', function() {
         
    //         document.getElementById('termsModal').classList.remove('active');
    //     });
    // });
   
</script>


</body>
</html>




