<?php
    session_start();
    include("database.php");

    $fname = $_SESSION["fname"] ?? 'No fname stored';
    $lname = $_SESSION["lname"] ?? 'No lname stored';
    $name = $_SESSION["name"] ?? 'No name stored';
    $email = $_SESSION["email"] ?? 'No email stored';
    $status = $_SESSION["status"] ?? 'No status stored';
    $workshop = $_SESSION["workshop"] ?? 'No workshop stored';
    $part = $_SESSION["part"] ?? 'No part stored';
    $exp = $_SESSION["exp"] ?? 'No exp stored';
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration info</title>

    <!-- bootstrap css -->
    <link rel = "stylesheet" href = "assets/CSS/bootstrap.min.css">
    <!-- css -->
    <link rel = "stylesheet" href = "assets/CSS/formStyles.css">

</head>
<body>
    
    <header id="header">
        <h1 class="indexh1">   التسجيل في ورشات الدورة السابعة والثلاثين لمهرجان المسرح  الجامعي الدولي بالدار البيضاء بكلية الآداب والعلوم الإنسانية بنمسيك  Registration for the Workshops of the 37th International University Theater Festival in Casablanca at the Faculty of Letters and Human Sciences of Ben M'Sik🎭</h1>
    </header>

    <div class="text-center mt-4">
        <button onclick="downloadPDF()" class="btn btn-success">⬇️ Download as PDF</button>
        <button onclick="sendPDFEmail()" class="btn btn-primary">📧 Send as Email</button>
    </div>


    <div class="card card-body">
        <div  id="pdf-content">
            <div class="container d-flex flex-wrap justify-content-center align-items-center gap-3">
                <img src="assets/images/CardHeader.png" class="logo-img">
            </div>

            <form class="w-60" style="padding: 50px;" id="email-content">
                <div class="form-group" >
                    <label style="display: flex; justify-content: space-between;">
                        <span> First Name  </span>                           
                        <span> الإسم الشخصي  </span>  
                    </label>
                    <input class="form-control" style="border-radius: 20px;" name="fname" value="<?php echo $fname ?>" readonly>
                </div>

                <div class="form-group">
                    <label style="display: flex; justify-content: space-between;">
                        <span> Last Name  </span>                           
                        <span> الإسم العائلي  </span>  
                    </label>
                    <input class="form-control" style="border-radius: 20px;" name="lname" value="<?php echo $lname ?>" readonly>
                </div>

                <div class="form-group">
                    <label style="display: flex; justify-content: space-between;">
                        <span> Email  </span>                           
                        <span>  البريد الإلكتروني  </span>  
                    </label>    
                    <input class="form-control" style="border-radius: 20px;" name="email" value="<?php echo $email ?>" readonly>
                </div>

                <div class="form-group">
                    <label style="display: flex; justify-content: space-between;">
                        <span> Status  </span>                           
                        <span>   الحالة  </span>  
                    </label>    
                    <input class="form-control" style="border-radius: 20px;" name="status" value="<?php echo $status ?>" readonly>
                </div>

                <div class="form-group">
                    <label style="display: flex; justify-content: space-between;">
                        <span> Your expectations?  </span>                           
                        <span>   توقعاتكم؟  </span>  
                    </label>
                    <textarea class="form-control" style="border-radius: 20px;" name="exp" rows="3" readonly><?php echo $exp ?></textarea>
                </div>

                <div class="form-group">
                    <label style="display: flex; justify-content: space-between;">
                        <span> Workshop  </span>                           
                        <span>  الورشة  </span>  
                    </label>    
                    <input class="form-control" style="border-radius: 20px;" name="workshop" value="<?php echo $workshop ?>" readonly>
                </div>
            </form>
        </div>
    </div>

    <!-- bootstrap js -->
    <script src = "assets/JavaScript/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <!-- javascript -->
    <script src = "assets/JavaScript/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@3/dist/email.min.js"></script>
    <script>
        emailjs.init("jHnhqWYOPcGIK3MDS"); // Replace with your EmailJS public key
    </script>

    <script>
        function downloadPDF() {
            const element = document.getElementById('pdf-content');
            const opt = {
            margin: 1,
            filename: 'resgistration-form.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            
            html2canvas: {
                scrollY: 0,
                scale: 2,
                useCORS: true
            },
            jsPDF: {
                unit: 'px',
                format: [794, 1123],
                orientation: 'portrait'
            }
            };
            html2pdf().set(opt).from(element).save();
        }

        function sendPDFEmail() {
        
            const form = document.getElementById("email-content");

            emailjs.sendForm("service_8gb5v9j", "template_8k525l1", form)
            .then(function(response) {
                alert("Email sent successfully!");
                console.log("SUCCESS!", response.status, response.text);
            }, function(error) {
                alert("Failed to send email.");
                console.error("FAILED...", error);
            });
        

        }

    </script>

</body>
</html>