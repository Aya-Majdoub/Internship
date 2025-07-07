<?php
    session_start();
    include("database.php");
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM admin WHERE admin_email = '$email'";
        $result = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($result);

        $_SESSION["admin_ID"] = $row["admin_ID"];
        if(empty($password) || empty($email)){
            $_SESSION['error'] = "Please enter your email and password.";
            header("Location: adminlogin.php");
            exit();
        }
        else if ($row && $row ["ad_password"] == $password){
            header("Location: adminpage.php");
            exit();
        }
        else {
            $_SESSION['error'] = "Wrong password! Try again.";
            header("Location: adminlogin.php");
            exit();
        }
    }

    mysqli_close($conn);
?>

<!-- https://docs.google.com/forms/d/e/1FAIpQLSfj6gpcWheYjO9x36ZYe3UrhgoLUbPm1ynvetfqVn82c4HFTA/viewform -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>

    <!-- bootstrap css -->
    <link rel = "stylesheet" href = "assets/CSS/bootstrap.min.css">
    <!-- css -->
    <link rel = "stylesheet" href = "assets/CSS/mystyles.css">
</head>
<body>

    <div class="container desc">

        <?php
            $error = "";

            if (isset($_SESSION['error'])) {
                $error = $_SESSION['error'];
                unset($_SESSION['error']);
            }
        ?>


        <form class="w-75" action="adminlogin.php" method="post">

            <div class="form-group">
                <label>Email</label>
                <input class="form-control" type="email" placeholder="email address" name="email">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input class="form-control" type="password" placeholder="password" name="password">
            </div>

            <br>

            <button class="btn btn-danger" type="submit"> Log in</button>
            
            <?php if(!empty($error)) : ?>
                
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <?= $error ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            <?php endif; ?>
        </form>
    </div>


    <!-- bootstrap js -->
    <script src = "assets/JavaScript/bootstrap.bundle.min.js"></script>
    <!-- javascript -->
    <script src = "assets/JavaScript/main.js"></script>
</body>
</html>

