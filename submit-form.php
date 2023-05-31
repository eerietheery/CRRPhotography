<?php
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

    // Send email using PHPMailer
    require 'vendor/autoload.php';
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = $_ENV['eerietheery@gmail.com'];
    $mail->Password = $_ENV['PPish00eetsahn!!'];
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    $mail->setFrom($email, $name);
    $mail->addAddress('eerietheery@gmail.com');
    $mail->Subject = 'New message from Pet Photography website';
    $mail->Body = "Name: $name\nEmail: $email\nMessage:\n$message";

    if ($mail->send()) {
        echo 'Thank you for your message!';
    } else {
        echo 'Something went wrong. Please try again.';
    }
} else {
    header('Location: index.html');
}
