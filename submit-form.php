<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Validate input data
    if (empty($name) || empty($email) || empty($message)) {
        die('Error: All fields are required.');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('Error: Invalid email format.');
    }

    // Sanitize input data
    $name = htmlspecialchars($name);
    $email = htmlspecialchars($email);
    $message = htmlspecialchars($message);

    require 'PHPMailer/Exception.php';
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';

    // Send email using PHPMailer
    $mail = new PHPMailer();
    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'eerietheery@gmail.com'; // Replace with your Gmail Email Address
        $mail->Password = 'your_gmail_password'; // Replace with your Gmail Password
        $mail->Port = 587;

        // Email Configuration
        $mail->setFrom('eerietheery@gmail.com', 'Pet Photography website');
        $mail->addAddress('recipient@example.com'); // Replace with your desired recipient email address
        $mail->addReplyTo($email, $name);

        // Email Content
        $mail->isHTML(true); 
        $mail->Subject = 'New message from Pet Photography website';
        $mail->Body = "Name: $name<br>Email: $email<br>Message:<br>$message";

        // Send Email
        if ($mail->send()) {
            echo 'Thank you for your message!';
        } else {
            echo 'Something went wrong. Please try again.';
        }
    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    header('Location: index.html');
}
