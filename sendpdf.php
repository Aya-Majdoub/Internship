<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = filter_var($_POST['to'], FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);
    
    // Make sure the email is valid
    if (filter_var($to, FILTER_VALIDATE_EMAIL)) {
        $headers = "From: ayamajdoubacad@gmail.com\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        
        // Send the email
        if (mail($to, $subject, $message, $headers)) {
            echo "Email sent successfully!";
        } else {
            echo "Error in sending email.";
        }
    } else {
        echo "Invalid email address.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Email</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <form id="emailForm" method="POST" action="send_email.php">
        <label for="to">Recipient's Email:</label>
        <input type="email" id="to" name="to" required>
        
        <label for="subject">Subject:</label>
        <input type="text" id="subject" name="subject" required>
        
        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea>
        
        <button type="submit" id="sendButton">Send by Email</button>
    </form>

    <script>
        document.getElementById("emailForm").addEventListener("submit", function(e) {
    e.preventDefault();

    const to = document.getElementById("to").value;
    const subject = document.getElementById("subject").value;
    const message = document.getElementById("message").value;

    // Basic validation
    if (!to || !subject || !message) {
        alert("All fields are required!");
        return;
    }

    const formData = new FormData();
    formData.append('to', to);
    formData.append('subject', subject);
    formData.append('message', message);

    fetch('sendpdf.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => alert(data))
    .catch(error => alert("There was an error sending the email: " + error));
});
    </script>
</body>
</html>