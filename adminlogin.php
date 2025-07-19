<?php
    session_start();
    include("database.php");
    
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM users WHERE status = 'admin' AND user_email = '$email'";
        $result = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc($result); 
        $hashedpass = $row["password"];
        $_SESSION["admin_ID"] = $row["user_ID"];
        if(empty($password) || empty($email)){
            $_SESSION['error'] = "Please enter your email and password.";
            header("Location: adminlogin.php");
            exit();
        }
        else if (password_verify($password, $hashedpass)){
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

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Fituc 2025</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link " aria-current="page" href="https://www.fituc.ma/">Home</a>
                    <a class="nav-link" href="https://intern.com/index.php">Registration</a>
                    <a class="nav-link " href="https://intern.com/Festival workshops/adminlogin.php">Admin log in</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container desc">

        <?php
            $error = "";

            if (isset($_SESSION['error'])) {
                $error = $_SESSION['error'];
                unset($_SESSION['error']);
            }
        ?>


        <form class="w-90" action="adminlogin.php" method="post">

            <div class="form-group">
                <label>Email</label>
                <input class="form-control" type="email" placeholder="email address" name="email">
            </div>

            <div class="form-group">
                <label>Password</label>
                <input class="form-control" type="password" placeholder="password" name="password">
            </div>

            <br>

            <button class="btn btn-dark" type="submit"> Log in</button>
            
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

