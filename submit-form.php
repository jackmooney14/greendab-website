<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data and sanitize it
    $name = strip_tags(trim($_POST["name"]));
    $email = strip_tags(trim($_POST["email"]));
    $subject = strip_tags(trim($_POST["subject"]));
    $message = strip_tags(trim($_POST["message"]));

    // Validate form data
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        http_response_code(400);
        echo "Please fill all fields.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Invalid email format.";
        exit;
    }

    // Email configuration
    $to = "hello@greendab.co.uk"; // Your email address
    $mail_subject = "New Contact Form Submission: $subject";
    $mail_body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
    $headers = "From: $email";

    // Send the email
    if (mail($to, $mail_subject, $mail_body, $headers)) {
        http_response_code(200);
        echo "Thank you! Your message has been sent.";
    } else {
        http_response_code(500);
        echo "Oops! Something went wrong and we couldn't send your message.";
    }

} else {
    http_response_code(403);
    echo "There was a problem with your submission, please try again.";
}

?>
