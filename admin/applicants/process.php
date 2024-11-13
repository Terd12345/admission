<?php
require '../database/db_conn.php'; // Your DB connection
require 'phpspreadsheet/vendor/autoload.php'; // Include PHPSpreadsheet library

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Shared\Date;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['excel_file']) && $_FILES['excel_file']['error'] == 0) {
        $fileTmpPath = $_FILES['excel_file']['tmp_name'];
        $fileName = $_FILES['excel_file']['name'];

        // Ensure the file is in Excel format
        $allowedExtensions = array('xlsx', 'xls');
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

        if (in_array($fileExtension, $allowedExtensions)) {
            // Load the spreadsheet
            $spreadsheet = IOFactory::load($fileTmpPath);
            $sheet = $spreadsheet->getActiveSheet();
            $highestRow = $sheet->getHighestRow(); // e.g. 10

            // Prepare SQL query
            $sql = "INSERT INTO applicants (control_num, username, last_name, given_name, middle_name, email, password, address, sex, date_birth, 
            age, birthplace, nationality, religion, contact_no, civil_status, course_id, high_school, high_year_graduated, college_school, college_course, college_year_graduated, TOR,
            stud_image, form137) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

            if ($stmt = $conn->prepare($sql)) {
                $duplicateMessages = []; // Array to hold duplicate messages

                // Loop through the rows of the Excel file
                for ($row = 2; $row <= $highestRow; ++$row) {
                    // Read data from the Excel file
                    $control_num = $sheet->getCell('A' . $row)->getValue(); 
                    $username = $sheet->getCell('B' . $row)->getValue();
                    $last_name = $sheet->getCell('C' . $row)->getValue();
                    $given_name = $sheet->getCell('D' . $row)->getValue();
                    $middle_name = $sheet->getCell('E' . $row)->getValue(); 
                    $email = $sheet->getCell('F' . $row)->getFormattedValue(); 
                    $password = $sheet->getCell('G' . $row)->getValue();
                    $address = $sheet->getCell('H' . $row)->getValue();
                    $sex = $sheet->getCell('I' . $row)->getValue();
                    $date_birth_cell = $sheet->getCell('J' . $row);
                    $date_birth = Date::isDateTime($date_birth_cell) ? Date::excelToDateTimeObject($date_birth_cell->getValue())->format('Y-m-d') : null;
                    $age = (int)$sheet->getCell('K' . $row)->getValue();
                    $birthplace = $sheet->getCell('L' . $row)->getValue();
                    $nationality = $sheet->getCell('M' . $row)->getValue();
                    $religion = $sheet->getCell('N' . $row)->getValue();
                    $contact_no = $sheet->getCell('O' . $row)->getValue();
                    $civil_status = $sheet->getCell('P' . $row)->getValue();
                    $course_id = $sheet->getCell('Q' . $row)->getValue();
                    // $height = $sheet->getCell('R' . $row)->getValue();
                    // $weight = $sheet->getCell('S' . $row)->getValue();
                    // $church_name = $sheet->getCell('T' . $row)->getValue();
                    // $church_address = $sheet->getCell('U' . $row)->getValue();
                    // $name_pastor = $sheet->getCell('V' . $row)-> getValue();
                    // $pastor_no = $sheet->getCell('W' . $row)->getValue();
                    // $ministry_involved = $sheet->getCell('X' . $row)->getValue();
                    $high_school = $sheet->getCell('R' . $row)->getValue();
                    $high_year_graduated = $sheet->getCell('S' . $row)->getValue();
                    $college_school = $sheet->getCell('T' . $row)->getValue();
                    $college_course = $sheet->getCell('U' . $row)->getValue();
                    $college_year_graduated = $sheet->getCell('V' . $row)->getValue();
                    // $vocational_school = $sheet->getCell('AD' . $row)->getValue();
                    // $vocational_course = $sheet->getCell('AE' . $row)->getValue();
                    // $vocational_year_graduated = $sheet->getCell('AF' . $row)->getValue();
                    // $other_school = $sheet->getCell('AG' . $row)->getValue();
                    // $other_school_course = $sheet->getCell('AH' . $row)->getValue();
                    // $other_year_graduated = $sheet->getCell('AI' . $row)->getValue();
                    $TOR = $sheet->getCell('W' . $row)->getValue();
                    // $pastor_reco = $sheet->getCell('AK' . $row)->getValue();
                    $stud_image = $sheet->getCell('X' . $row)->getValue();
                    $form137 = $sheet->getCell('Y' . $row)->getValue();

                    // Check if the applicant already exists
                    $check_sql = "SELECT * FROM applicants WHERE given_name = ? AND last_name = ? AND middle_name = ? AND email = ?";
                    $check_stmt = $conn->prepare($check_sql);
                    $check_stmt->bind_param("ssss", $given_name, $last_name, $middle_name, $email);
                    $check_stmt->execute();
                    $check_result = $check_stmt->get_result();
                    $check_num_rows = $check_result->num_rows;

                    if ($check_num_rows > 0) {
                        $duplicateMessages[] = "Warning: Applicant with name $given_name $last_name $middle_name and email $email already exists. Skipping this record.";
                        continue; // Skip to the next iteration
                    }

                    // Bind and execute the query
                    $stmt->bind_param("ssssssssssisssisissssssss", 
                      $control_num,
                     $username, 
                            $last_name, 
                            $given_name, 
                            $middle_name, 
                            $email, 
                            $password, 
                            $address, 
                            $sex, 
                            $date_birth, 
                            $age, 
                            $birthplace, 
                            $nationality, 
                            $religion, 
                            $contact_no, 
                            $civil_status, 
                            $course_id, 
                            $high_school, 
                            $high_year_graduated, 
                            $college_school, 
                            $college_course, 
                            $college_year_graduated, 
                            $TOR, 
                            $stud_image, 
                            $form137);

                    if (!$stmt->execute()) {
                        echo "Error executing statement: " . $stmt->error . "<br>";
                    }
                }
                $stmt->close();

                // Display duplicate messages
                if (!empty($duplicateMessages)) {
                    $duplicateMessage = implode('<br>', $duplicateMessages);
                    echo "<script>alert('$duplicateMessage');</script>";
                }

                echo "<script>alert('Applicants have been successfully uploaded!'); window.location.href='applicants.php';</script>";
            } else {
                echo "Error preparing statement: " . $conn->error;
            }
        } else {
            echo "<script>alert('Please upload a valid Excel file.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('File upload error!'); window.history.back();</script>";
    }
}
?>