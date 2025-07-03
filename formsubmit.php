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
        $mail->Username = 'patrasagarika654@gmail.com';   // Your Gmail
        $mail->Password = 'yder qkfe hbng lfcj';      // App Password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Sender and recipient
        $mail->setFrom('patrasagarika654@gmail.com', 'Interior Website');
        $mail->addAddress('patrasagarika654@gmail.com');  // You’ll receive here

        // Content
        $mail->isHTML(true);
        $mail->Subject = "New Interior Project Inquiry";
        $mail->Body = "
    <div style='font-family: Arial, sans-serif; font-size: 16px; color: #333; line-height: 1.6; padding: 10px 0;'>
        <h2 style='color: #D4AF37; margin-bottom: 20px;'>📩 New Project Inquiry</h2>
        
        <p><strong>👤 Name:</strong> {$firstName} {$lastName}</p>
        <p><strong>📧 Email:</strong> {$email}</p>
        <p><strong>📞 Phone:</strong> {$phone}</p>
        <p><strong>🏗️ Project Type:</strong> {$project}</p>
        
        <div style='margin-top: 20px;'>
            <p style='margin-bottom: 5px;'><strong>📝 Message:</strong></p>
            <p style='background-color: #f9f9f9; padding: 12px; border-left: 4px solid #D4AF37;'>
                {$message}
            </p>
        </div>
        
        <hr style='margin: 30px 0; border: none; border-top: 1px solid #ccc;' />
        <p style='font-size: 14px; color: #999;'>This message was submitted via the KNP Developers project inquiry form.</p>
    </div>
";

        $mail->send();
        header("Location: thankyou.html");
        exit(); // Very important to stop script execution
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>