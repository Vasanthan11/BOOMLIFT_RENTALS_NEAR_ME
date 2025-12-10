<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Sanitize inputs
    $full_name = htmlspecialchars(trim($_POST['full_name'] ?? ''));
    $contact   = htmlspecialchars(trim($_POST['contact'] ?? ''));
    $email     = htmlspecialchars(trim($_POST['email'] ?? ''));
    $area      = htmlspecialchars(trim($_POST['area'] ?? ''));
    $equipment = htmlspecialchars(trim($_POST['equipment_type'] ?? ''));
    $requirement = htmlspecialchars(trim($_POST['requirement'] ?? ''));

    // Server-side required validation
    if ($full_name === '' || $contact === '' || $email === '' || $area === '' || $equipment === '' || $requirement === '') {
        echo "Error: All required fields must be filled.";
        exit;
    }

    // ✅ Change this to your real receiving email
    $to = "info@yourdomain.com";

    $subject = "New Equipment Rental Enquiry";

    $body = "New Rental Enquiry Received:\n\n";
    $body .= "Full Name: $full_name\n";
    $body .= "Contact Number: $contact\n";
    $body .= "Email: $email\n";
    $body .= "City / Area: $area\n";
    $body .= "Equipment Type: $equipment\n";
    $body .= "Requirement Details:\n$requirement\n";

    $headers  = "From: Website Enquiry <noreply@yourdomain.com>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    if (mail($to, $subject, $body, $headers)) {
        // ✅ Redirect after successful submission
        header("Location: thank-you.html");
        exit;
    } else {
        echo "Mail sending failed. Please try again later.";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}
