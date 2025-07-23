

<!--<!DOCTYPE html>
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
</html>-->

<?php
require "vendor/autoload.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    

    $mail = new PHPMailer(true);

    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    
    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail->Host = "smtp.gmail.com";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    

    $mail->Username = "ayamajdoubacad@gmail.com";
    $mail->Password = "tqni fces fsce ohwe";

    $mail->setFrom($email, $name);
    $mail->addAddress("ayamajdoub8@gmail.com", "Aya");

    $mail->Subject = $subject;
    $mail->Body = $message;

    $mail->send();

    header("Location: sendpdf.php?success=1");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h1>Contact</h1>
    
    <form method="post" action="sendpdf.php">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" required>
        
        <label for="email">email</label>
        <input type="email" name="email" id="email" required>
        
        <label for="subject">Subject</label>
        <input type="text" name="subject" id="subject" required>
        
        <label for="message">Message</label>
        <textarea name="message" id="message" required></textarea>
        
        <br>
        
        <button>Send</button>
    </form>
    
</body>
</html>