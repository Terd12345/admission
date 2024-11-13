<?php
session_start();
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "admin_caps";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Check if form is submitted before trying to access POST data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Initialize variables from the POST data
    $address = $_POST['address'] ?? null;
    $course_id = $_POST['course_id'] ?? null;
    $height = $_POST['height'] ?? null;
    $weight = $_POST['weight'] ?? null;
    $date_birth = $_POST['date_birth'] ?? null;
    $birthplace = $_POST['birthplace'] ?? null;
    $sex = $_POST['sex'] ?? null;
    $nationality = $_POST['nationality'] ?? null;
    $religion = $_POST['religion'] ?? null;
    $contact_no = $_POST['contact_no'] ?? null;
    $civil_status = $_POST['civil_status'] ?? null;
    $high_school = $_POST['high_school'] ?? null;
    $high_year_graduated = $_POST['high_year_graduated'] ?? null;
    $college_school = $_POST['college_school'] ?? null;
    $college_course = $_POST['college_course'] ?? null;
    $college_year_graduated = $_POST['college_year_graduated'] ?? null;
    $vocational_school = $_POST['vocational_school'] ?? null;
    $vocational_course = $_POST['vocational_course'] ?? null;
    $vocational_year_graduated = $_POST['vocational_year_graduated'] ?? null;
    $other_school = $_POST['other_school'] ?? null;
    $other_school_course = $_POST['other_school_course'] ?? null;
    $other_year_graduated = $_POST['other_year_graduated'] ?? null;
    $church_name = $_POST['church_name'] ?? null;
    $church_address = $_POST['church_address'] ?? null;
    $name_pastor = $_POST['name_pastor'] ?? null;
    $pastor_no = $_POST['pastor_no'] ?? null;
    $ministry_involved = $_POST['ministry_involved'] ?? null;


    // Calculate age from date of birth
    if ($date_birth) {
        $birthDate = new DateTime($date_birth);
        $currentDate = new DateTime();
        $age = $currentDate->diff($birthDate)->y; // Calculate the difference in years (age)
    } else {
        $age = null; // If date of birth is not provided
    }



    // File upload variables
    $targetDir = "../uploads/";
    $TOR = $targetDir . basename($_FILES['TOR']['name']);

    $targetDir1 = "/uploads/";
    $TOR1 = $targetDir1 . basename($_FILES['TOR']['name']);

    $pastor_reco = $targetDir . basename($_FILES['pastor_reco']['name']);

    $pastor_reco1 = $targetDir . basename($_FILES['pastor_reco']['name']);

    $stud_image = $targetDir . basename($_FILES['stud_image']['name']);
    
    $stud_image1 = $targetDir . basename($_FILES['stud_image']['name']);

    $form137 = $targetDir . basename($_FILES['form137']['name']);

    $form1371 = $targetDir . basename($_FILES['form137']['name']);
    
    // Move the uploaded files
    move_uploaded_file($_FILES['TOR']['tmp_name'], $TOR);
    move_uploaded_file($_FILES['pastor_reco']['tmp_name'], $pastor_reco);
    move_uploaded_file($_FILES['stud_image']['tmp_name'], $stud_image);
    move_uploaded_file($_FILES['form137']['tmp_name'], $form137);


    // Store file links for display after submission
    // $TOR_link = "../uploads/" . basename($_FILES['TOR']['name']);
    // $pastorReco_link = "../uploads/" . basename($_FILES['pastor_reco']['name']);
    // $studImage_link = "../uploads/" . basename($_FILES['stud_image']['name']);
    // $form137_link = "../uploads/" . basename($_FILES['form137']['name']);

    // Store file links for display after submission
$TOR_link = !empty($_FILES['TOR']['name']) ? "../uploads/" . basename($_FILES['TOR']['name']) : null;
$pastor_reco_link = !empty($_FILES['pastor_reco']['name']) ? "../uploads/" . basename($_FILES['pastor_reco']['name']) : null;
$stud_image_link = !empty($_FILES['stud_image']['name']) ? "../uploads/" . basename($_FILES['stud_image']['name']) : null;
$form137_link = !empty($_FILES['form137']['name']) ? "../uploads/" . basename($_FILES['form137']['name']) : null;


    // Assume you're storing the user ID in session after login
    $id = $_SESSION['id'];

    // Prepare the UPDATE query to update the existing record in the database
    $sql = "UPDATE applicants 
            SET address = ?, course_id = ?, height = ?, weight = ?, date_birth = ?, birthplace = ?, sex = ?, nationality = ?, religion = ?, 
                contact_no = ?, civil_status = ?, high_school = ?, high_year_graduated = ?, college_school = ?, college_course = ?, 
                college_year_graduated = ?, vocational_school = ?, vocational_course = ?, vocational_year_graduated = ?, 
                other_school = ?, other_school_course = ?, other_year_graduated = ?, church_name = ?, church_address = ?, 
                name_pastor = ?, pastor_no = ?, ministry_involved = ?, age = ?, TOR = ?, pastor_reco = ?, stud_image = ?, form137 = ?
            WHERE id = ?";

    // Prepare statement to prevent SQL injection
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameters to the statement
        $stmt->bind_param(
            'sissssssssssississississssssssssi', 
            $address,
             $course_id, 
             $height, 
             $weight, 
             $date_birth, 
             $birthplace, 
            $sex, 
            $nationality, 
            $religion, 
            $contact_no, 
            $civil_status, 
            $high_school, 
            $high_year_graduated, 
            $college_school, 
            $college_course, 
            $college_year_graduated, 
            $vocational_school, 
            $vocational_course, 
            $vocational_year_graduated, 
            $other_school, 
            $other_school_course, 
            $other_year_graduated, 
            $church_name, 
            $church_address, 
            $name_pastor, 
            $pastor_no, 
            $ministry_involved, 
            $age,
            $TOR1, 
            $pastor_reco, 
            $stud_image, 
            $form137, 
            $id
        );

        // Execute the query
        if ($stmt->execute()) {
            header('Location: index.php');
        } else {
            echo "Error updating record: " . $stmt->error; 
        }
        
        // Close the statement
        $stmt->close();
    } else {
        echo "Error preparing the statement: " . $conn->error;
    }


    // Close the database connection
    $conn->close();
}
?>
