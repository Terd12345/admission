<?php
include '../database/db_conn.php';

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $id = $_POST['id'];

    // Fetch applicant's email and name from the database
//     $sql = "SELECT email, given_name, last_name FROM applicants WHERE id = ?";
//     $stmt = $conn->prepare($sql);
//     $stmt->bind_param("i", $id);
//     $stmt->execute();
//     $result = $stmt->get_result();

//     if ($result->num_rows > 0) {
//         $applicant = $result->fetch_assoc();
//         $email = $applicant['email'];
//         $full_name = $applicant['given_name'] . " " . $applicant['last_name'];

//         // Prepare email content
//         $subject = "Application Update";
//         $message = "Hello $full_name,\n\nYour application is under review. We will contact you soon.\n\nBest regards,\nPearl of The Orient";
//         $headers = "From: romeov.eustaquioiii@gmail.com";

//         // Send email
//         if (mail($email, $subject, $message, $headers)) {
//             echo json_encode(["status" => "success", "message" => "Email sent successfully!"]);
//         } else {
//             echo json_encode(["status" => "error", "message" => "Failed to send email."]);
//         }
//     } else {
//         echo json_encode(["status" => "error", "message" => "Applicant not found."]);
//     }
//     $stmt->close();
//     $conn->close();
// } else {
//     echo json_encode(["status" => "error", "message" => "Invalid request."]);
// }



require 'path/to/PHPMailerAutoload.php';
require 'db_connection.php'; // Update with actual path

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    global $mydb;
    $IDNO = $_POST['id'];

    // Check if email has already been sent
    if (isset($_SESSION["email_sent_$IDNO"])) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Email has already been sent to this applicant.'
        ]);
        exit;
    }

    // Get student data
    $mydb->setQuery("SELECT EMAIL, FNAME, LNAME FROM tblstudent WHERE IDNO='$IDNO'");
    $student = $mydb->loadSingleResult();

    if ($student) {
        $to = $student->EMAIL;
        $fullName = $student->FNAME . ' ' . $student->LNAME;

        if (sendConfirmationEmail($to, $fullName)) {
            // Set session flag for email sent
            $_SESSION["email_sent_$IDNO"] = true;

            echo json_encode([
                'status' => 'success',
                'message' => 'Confirmation email has been sent.'
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Failed to send the confirmation email.'
            ]);
        }
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Student not found.'
        ]);
    }
}

function sendConfirmationEmail($to, $fullName) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@gmail.com';
        $mail->Password = 'your-email-password';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->setFrom('your-email@gmail.com', 'Admin');
        $mail->addAddress($to);

        $mail->isHTML(true);
        $mail->Subject = 'Confirmation of Enrollment';
        $mail->Body = "Dear $fullName,<br><br>Your enrollment has been confirmed. You can now access the student portal.<br><br>Regards,<br>Admin";

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        return false;
    }
}



?>
