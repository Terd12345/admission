<?php

// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// require "phpmailer/src/Exception.php";
// require "phpmailer/src/PHPMailer.php";
// require "phpmailer/src/SMTP.php";


// if(isset($_POST['send'])){
//     $mail = new PHPMailer(true);

//     $mail->isSMTP();
//     $mail->Host = 'smtp.gmail.com';
//     $mail->SMTPAuth = true;
//     $mail->Username = 'romeov.eustaquioiii@gmail.com';
//     $mail->Password = 'ecyy uqpr zkfe segd';
//     $mail->SMTPSecure = 'ssl';
//     $mail->Port = '465';


//     $mail->setFrom('romeov.eustaquioiii@gmail.com');

//     $mail->addAddress($_POST['email']);

//     $mail->isHTML(true);

//     $mail->Subject = $_POST['subject'];

//     $mail->Body = $_POST['message'];

    

//     $mail->send();

//     echo 
//     "
//     <script>
//     alert('Sent Successfully');
//     document.location.href = 'index.php';
//     </script>
//     ";
// }




use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require "phpmailer/src/Exception.php";
require "phpmailer/src/PHPMailer.php";
require "phpmailer/src/SMTP.php";

if (isset($_POST['send'])) {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'romeov.eustaquioiii@gmail.com';
    $mail->Password = 'ecyy uqpr zkfe segd';  // Ensure you're using an app-specific password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = '465';

    $mail->setFrom('romeov.eustaquioiii@gmail.com');

    $mail->addAddress($_POST['email']);

    $mail->isHTML(true);

    // Set subject and message content
    $mail->Subject = $_POST['subject'];

    // Include fname and lname in the email body
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $message = $_POST['message'];

    $mail->Body = "
        <h2>New Message From: $fname $lname</h2>
        <p><strong>First Name:</strong> $fname</p>
        <p><strong>Last Name:</strong> $lname</p>
        <p><strong>Message:</strong></p>
        <p>$message</p>
    ";

    // Send the email
    if ($mail->send()) {
        echo "
        <script>
        alert('Sent Successfully');
        document.location.href = 'index.php';
        </script>
        ";
    } else {
        echo "
        <script>
        alert('Message sending failed.');
        document.location.href = 'index.php';
        </script>
        ";
    }
}


?>