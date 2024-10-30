<?php
// If using Composer
require 'vendor/autoload.php';

// If manually installed, use these paths instead:
// require 'PHPMailer/src/Exception.php';
// require 'PHPMailer/src/PHPMailer.php';
// require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $tour = $_POST['tour'];
    $date = $_POST['date'];

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'budapest.tuli@gmail.com'; // Your Gmail address
        $mail->Password = 'Tuli41193606225@';        // Your Gmail password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('budapest.tuli@gmail.com');

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Tour Registration';
        $mail->Body    = "Name: $name<br>Email: $email<br>Phone: $phone<br>Tour: $tour<br>Preferred Date: $date";

        $mail->send();
        header("Location: thank_you.html");
        exit();
    } catch (Exception $e) {
        echo "There was an error sending your registration. Please try again. Error: {$mail->ErrorInfo}";
    }
}
?>