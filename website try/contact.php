<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Replace this with your email address
    $to = "your-email@example.com"; 

    // Sanitize input
    $name = htmlspecialchars($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Email headers
    $headers = "From: $email" . "\r\n" .
               "Reply-To: $email" . "\r\n" .
               "X-Mailer: PHP/" . phpversion();

    // Email content
    $body = "You have received a message from $name.\n\n".
            "Email: $email\n".
            "Subject: $subject\n\n".
            "Message:\n$message";

    // Send email
    if (mail($to, $subject, $body, $headers)) {
        echo "<script>alert('Your message has been sent successfully.'); window.location.href='index.html';</script>";
    } else {
        echo "<script>alert('Failed to send message.'); window.location.href='index.html';</script>";
    }
} else {
    echo "Invalid request.";
}
?>
