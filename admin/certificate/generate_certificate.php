<?php
require("fpdf/fpdf.php");
require("../database/db_conn.php"); // Include your database connection

if (isset($_POST['student_id']) && !empty($_POST['student_id']) && isset($_POST['course_title']) && isset($_POST['message'])) {
    $studentId = $_POST['student_id'];
    $courseTitle = $_POST['course_title'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("SELECT given_name, last_name FROM students WHERE stud_id = ?");
    $stmt->bind_param("i", $studentId);

    if (!$stmt->execute()) {
        die("Database query failed: " . $stmt->error);
    }

    $stmt->bind_result($firstName, $lastName);
    $stmt->fetch();
    $stmt->close();
    $conn->close();

    if (!$firstName) {
        die("Student not found!");
    }

    $studentName = trim($firstName . " " . $lastName);
    $fontPath = "C:/xampp/htdocs/Admin_Caps/admin/certificate/calibri.ttf";
    $imagePath = "c.jpg";
    $image = imagecreatefromjpeg($imagePath);

    if (!$image) {
        die("Error loading background image.");
    }

    $textColor = imagecolorallocate($image, 19, 21, 22);

    $imageWidth = imagesx($image);

    // Calculate and center-align the student's name
    $fontSize = 50;
    $nameBox = imagettfbbox($fontSize, 0, $fontPath, $studentName);
    $nameTextWidth = $nameBox[2] - $nameBox[0];
    $nameX = ($imageWidth - $nameTextWidth) / 2;
    $nameY = 697; // Adjust Y position as needed

    imagettftext($image, $fontSize, 0, $nameX, $nameY, $textColor, $fontPath, $studentName);

    // Calculate and center-align the course title
    $courseBox = imagettfbbox($fontSize, 0, $fontPath, $courseTitle);
    $courseTextWidth = $courseBox[2] - $courseBox[0];
    $courseX = ($imageWidth - $courseTextWidth) / 2;
    $courseY = 890; // Adjust Y position as needed

    imagettftext($image, $fontSize, 0, $courseX, $courseY, $textColor, $fontPath, $courseTitle);

    // Wrap the message and center-align it
    $wrappedMessage = wordwrap($message, 90, "\n");
    $lines = explode("\n", $wrappedMessage);

    $startY = 990;
    $lineHeight = 40;

    foreach ($lines as $line) {
        $bbox = imagettfbbox(28, 0, $fontPath, $line);
        $textWidth = $bbox[2] - $bbox[0];
        $startX = ($imageWidth - $textWidth) / 2; // Center-align each line

        imagettftext($image, 28, 0, $startX, $startY, $textColor, $fontPath, $line);
        $startY += $lineHeight;
    }

    $outputDir = "download-cert/";
    if (!is_dir($outputDir)) {
        mkdir($outputDir, 0777, true);
    }

    $imagePath = $outputDir . time() . ".jpg";
    imagejpeg($image, $imagePath);
    imagedestroy($image);

    if (!file_exists($imagePath)) {
        die("Image generation failed!");
    }

    $pdf = new FPDF('L', 'mm', 'A5');
    $pdf->AddPage();
    $pdf->Image($imagePath, 0, 0, 210, 148);

    $pdfOutputPath = $outputDir . time() . ".pdf";
    $pdf->Output('F', $pdfOutputPath);

    ob_end_clean();

    echo "<html>
            <head>
                <style>
                    body { margin: 0; padding: 0; overflow: hidden; }
                    iframe { width: 100vw; height: 100vh; border: none; }
                </style>
            </head>
            <body>
                <iframe src='$pdfOutputPath'></iframe>
                <br><br>
                <a href='$pdfOutputPath' target='_blank'>Download PDF</a>
            </body>
        </html>";

} else {
    die("No student or course information provided.");
}
?>
