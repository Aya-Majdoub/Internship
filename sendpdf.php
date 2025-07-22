<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['pdf'])) {
        $workshopTitle = $_POST['workshopTitle'] ?? 'Workshop';
        $pdfTmpPath = $_FILES['pdf']['tmp_name'];
        $pdfName = $_FILES['pdf']['name'];

        $to = $email; // change to your recipient email
        $subject = "Participants List - $workshopTitle";
        $from = "ayamajdoubacad@gmail.com"; // change to your sender email
        $fromName = "Workshop System";

        // Read PDF file content
        $fileContent = file_get_contents($pdfTmpPath);
        $encodedContent = chunk_split(base64_encode($fileContent));

        // Create a unique boundary
        $boundary = md5("random" . time());

        // Headers
        $headers = "From: $fromName <$from>\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\r\n";

        // Email Body
        $body = "--$boundary\r\n";
        $body .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
        $body .= "<p>Attached is the participants list for <strong>$workshopTitle</strong>.</p>\r\n";
        $body .= "--$boundary\r\n";
        $body .= "Content-Type: application/pdf; name=\"$pdfName\"\r\n";
        $body .= "Content-Disposition: attachment; filename=\"$pdfName\"\r\n";
        $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
        $body .= $encodedContent . "\r\n";
        $body .= "--$boundary--";

        // Send the email
        if (mail($to, $subject, $body, $headers)) {
            echo "✅ Email sent successfully!";
        } else {
            echo "❌ Failed to send email.";
        }
    } else {
        echo "❌ Invalid request.";
    }
?>