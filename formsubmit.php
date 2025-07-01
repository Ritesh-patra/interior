<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'mailer/Exception.php';
require 'mailer/PHPMailer.php';
require 'mailer/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = htmlspecialchars($_POST["first_name"] ?? '');
    $lastName = htmlspecialchars($_POST["last_name"] ?? '');
    $email = htmlspecialchars($_POST["email"] ?? '');
    $phone = htmlspecialchars($_POST["phone"] ?? '');
    $project = htmlspecialchars($_POST["project_type"] ?? '');
    $message = htmlspecialchars($_POST["message"] ?? '');

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';          // SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'your-email@gmail.com';   // Your Gmail
        $mail->Password = 'your-app-password';      // App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Sender and recipient
        $mail->setFrom('your-email@gmail.com', 'Interior Website');
        $mail->addAddress('your-email@gmail.com');  // You’ll receive here

        // Content
        $mail->isHTML(true);
        $mail->Subject = "New Interior Project Inquiry";
        $mail->Body = "
            <h3>New Project Inquiry</h3>
            <p><strong>Name:</strong> $firstName $lastName</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Project Type:</strong> $project</p>
            <p><strong>Message:</strong><br>$message</p>
        ";

        $mail->send();
        header("Location: thankyou.html");
        exit(); // Very important to stop script execution
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>