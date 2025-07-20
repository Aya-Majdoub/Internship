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
    
    <div class="card card-body">
        <div class="container d-flex justify-content-between">
            <img src="assets/images/UH2logo.jpg" style="height: 150px;">
            <img src="assets/images/{6D7E9B4C-347D-476E-A8EC-5B0290DA9DB4}.png" style="height: 200px;">
            <img src="assets/images/festivalLOGO.jpg" style="height: 150px;">
        </div>
        <form class="w-60">
            <div class="form-group">
                <label style="display: flex; justify-content: space-between;">
                    <span> First Name  </span>                           
                    <span> الإسم الشخصي  </span>  
                </label>
                <input class="form-control form-control-lg " style="border-radius: 20px;" value="<?php echo $fname ?>" readonly>
            </div>

            <div class="form-group">
                <label style="display: flex; justify-content: space-between;">
                    <span> Last Name  </span>                           
                    <span> الإسم العائلي  </span>  
                </label>
                <input class="form-control form-control-lg " style="border-radius: 20px;" value="<?php echo $lname ?>" readonly>
            </div>

            <div class="form-group">
                <label style="display: flex; justify-content: space-between;">
                    <span> Email  </span>                           
                    <span>  البريد الإلكتروني  </span>  
                </label>    
                <input class="form-control form-control-lg " style="border-radius: 20px;" value="<?php echo $email ?>" readonly>
            </div>

            <div class="form-group">
                <label style="display: flex; justify-content: space-between;">
                    <span> Status  </span>                           
                    <span>   الحالة  </span>  
                </label>    
                <input class="form-control form-control-lg " style="border-radius: 20px;" value="<?php echo $status ?>" readonly>
            </div>

            <div class="form-group">
                <label style="display: flex; justify-content: space-between;">
                    <span> Your expectations?  </span>                           
                    <span>   توقعاتكم؟  </span>  
                </label>
                <textarea class="form-control form-control-lg " style="border-radius: 20px;" rows="3" readonly><?php echo $exp ?></textarea>
            </div>

            <div class="form-group">
                <label style="display: flex; justify-content: space-between;">
                    <span> Workshop  </span>                           
                    <span>  الورشة  </span>  
                </label>    
                <input class="form-control form-control-lg " style="border-radius: 20px;" value="<?php echo $workshop ?>" readonly>
            </div>
        </form>
    </div>

    <!-- bootstrap js -->
    <script src = "assets/JavaScript/bootstrap.bundle.min.js"></script>
    <!-- javascript -->
    <script src = "assets/JavaScript/main.js"></script>
</body>
</html>