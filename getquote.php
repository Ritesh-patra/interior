<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'mailer/Exception.php';
require 'mailer/PHPMailer.php';
require 'mailer/SMTP.php';


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $projectType = $_POST['projectType'] ?? '';
    $fullName = $_POST['fullName'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $location = $_POST['location'] ?? '';
    $budget = $_POST['budget'] ?? '';
    $details = $_POST['details'] ?? '';

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'patrasagarika654@gmail.com'; // Your Gmail
        $mail->Password = 'yder qkfe hbng lfcj';         // Your Gmail App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->CharSet = 'UTF-8';


        // Recipients
        $mail->setFrom('patrasagarika654@gmail.com', 'Quote Request Form');
        $mail->addAddress('patrasagarika654@gmail.com'); // To same or any other address

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Quote Request from Website';
        $mail->Body = "
    <div style='font-family: Arial, sans-serif; font-size: 16px; color: #222; line-height: 1.6; padding: 20px;'>
        <h2 style='color: #d4af37; border-bottom: 2px solid #ccc; padding-bottom: 8px;'>✨ New Quote Request Received ✨</h2>

        <p><strong style='color: #555;'>📌 Project Type:</strong><br><span style='color: #000;'>{$projectType}</span></p>

        <p><strong style='color: #555;'>👤 Full Name:</strong><br><span style='color: #000;'>{$fullName}</span></p>

        <p><strong style='color: #555;'>📧 Email Address:</strong><br><span style='color: #000;'>{$email}</span></p>

        <p><strong style='color: #555;'>📱 Phone Number:</strong><br><span style='color: #000;'>{$phone}</span></p>

        <p><strong style='color: #555;'>📍 Location:</strong><br><span style='color: #000;'>{$location}</span></p>

        <p><strong style='color: #555;'>💰 Budget Range:</strong><br><span style='color: #000;'>{$budget}</span></p>

        <p><strong style='color: #555;'>📝 Project Details:</strong><br><span style='color: #000;'>{$details}</span></p>

        <hr style='margin-top: 30px;'>
        <p style='color: #888; font-size: 13px;'>This request was submitted via the website quote form.</p>
    </div>
";


        $mail->send();
        header('Location: thankyou.html');
        exit();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>