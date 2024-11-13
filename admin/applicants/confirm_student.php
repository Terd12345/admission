<?php
include '../database/db_conn.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $applicant_id = $_POST['id'];
    
    // Start transaction
    $conn->begin_transaction();
    
    try {
        // First, get all the applicant data
        $select_sql = "SELECT * FROM applicants WHERE id = ?";
        $stmt = $conn->prepare($select_sql);
        $stmt->bind_param("i", $applicant_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $applicant = $result->fetch_assoc();
        
        if (!$applicant) {      
            throw new Exception("Applicant not found");
        }
        
        // Format the date properly
        $formatted_date = null;
        if (!empty($applicant['date_birth']) && $applicant['date_birth'] !== "0000-00-00") {
            // Convert if necessary
            $date_obj = DateTime::createFromFormat('Y-m-d', $applicant['date_birth']);
            if ($date_obj !== false) {
                $formatted_date = $date_obj->format('Y-m-d');
            }
        }
        
        // Generate stud_id
        $year = date('Y');
        $next_id = 1; // Default to 1 if no IDs found

        // Fetch the last stud_id for the current year
        $id_sql = "SELECT stud_id FROM students WHERE stud_id LIKE '$year%' ORDER BY stud_id DESC LIMIT 1";
        $id_result = $conn->query($id_sql);
        
        if ($id_result->num_rows > 0) {
            $last_id_row = $id_result->fetch_assoc();
            $last_id = (int)substr($last_id_row['stud_id'], 4); // Get the last number part
            $next_id = $last_id + 1; // Increment for the next ID
        }

        // Generate the new stud_id
        $stud_id = $year . str_pad($next_id, 4, '0', STR_PAD_LEFT); // e.g., 20240001

        // Insert into students table
        $insert_sql = "INSERT INTO students (
            stud_id,
            username,
            given_name, 
            middle_name, 
            last_name, 
            sex, 
            date_birth,
            address, 
            age, 
            contact_no, 
            email, 
            password,
            birthplace,
            nationality,
            religion,
            civil_status, 
            course_id,
            height,
            weight, 
            church_name,
            church_address,
            name_pastor,
            pastor_no,
            ministry_involved,
            high_school,
            high_year_graduated,
            college_school,
            college_course,
            college_year_graduated,
            vocational_school,
            vocational_course,
            vocational_year_graduated,
            other_school, 
            other_school_course,
            other_year_graduated,
            TOR,
            pastor_reco,
            stud_image, 
            form137
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($insert_sql);
        $stmt->bind_param(
            "isssssssisssssssiddsssississsssssssssss",  // Note: changed 'i' to 's' for date_birth as it's a string
            $stud_id, // Insert the generated stud_id
            $applicant['username'],
            $applicant['given_name'],
            $applicant['middle_name'],
            $applicant['last_name'],
            $applicant['sex'],
            $formatted_date,  // Use the formatted date
            $applicant['address'],
            $applicant['age'],
            $applicant['contact_no'],
            $applicant['email'],
            $applicant['password'],
            $applicant['birthplace'],
            $applicant['nationality'],
            $applicant['religion'],
            $applicant['civil_status'],
            $applicant['course_id'],
            $applicant['height'],
            $applicant['weight'],
            $applicant['church_name'],
            $applicant['church_address'],
            $applicant['name_pastor'],
            $applicant['pastor_no'],
            $applicant['ministry_involved'],
            $applicant['high_school'],
            $applicant['high_year_graduated'],
            $applicant ['college_school'],
            $applicant['college_course'],
            $applicant['college_year_graduated'],
            $applicant['vocational_school'],
            $applicant['vocational_course'],
            $applicant['vocational_year_graduated'],
            $applicant['other_school'],
            $applicant['other_school_course'],
            $applicant['other_year_graduated'],
            $applicant['TOR'],
            $applicant['pastor_reco'],
            $applicant['stud_image'],
            $applicant['form137'],
        );
        
        $stmt->execute();
        
        // Delete from applicants table
        $delete_sql = "DELETE FROM applicants WHERE id = ?";
        $stmt = $conn->prepare($delete_sql);
        $stmt->bind_param("i", $applicant_id);
        $stmt->execute();
        
        // Commit transaction
        $conn->commit();
        
        echo json_encode(['status' => 'success', 'message' => 'Applicant successfully moved to students']);
        
    } catch (Exception $e) {
        // Rollback transaction on error
        $conn->rollback();
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
    
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>