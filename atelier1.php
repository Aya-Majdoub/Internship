<?php
    session_start();
    include("database.php");

    $sql = "SELECT * FROM workshop WHERE workshop_ID = 111";
    $result = mysqli_query($conn, $sql);

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $username = $_POST["username"];
        $email = $_POST["email"];

        $check = "SELECT * FROM users WHERE user_email = '$email'";
        $checking = mysqli_query($conn, $check);

        if(empty($username) || empty($email)){
            $_SESSION['message'] = "Please enter your name and email";
            header("Location: atelier1.php");
            exit();
        }
        else if(mysqli_num_rows($checking) > 0){
            $_SESSION['message'] = "This email already exists.";
            header("Location: atelier1.php");
            exit();
        }
        else{
            $sql3 = "INSERT INTO users (username, user_email) VALUES ('$username', '$email')";
            mysqli_query($conn, $sql3);
            $_SESSION['message'] = "You are now registered.";
            header("Location: atelier1.php");
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
    <title>Atelier 1</title>

    <!-- bootstrap css -->
    <link rel = "stylesheet" href = "assets/CSS/bootstrap.min.css">
    <!-- css -->
    <link rel = "stylesheet" href = "assets/CSS/mystyles.css">
</head>
<body>

    <h1>Workshop #one</h1>

    <div class="container">
        <?php
            $row = mysqli_fetch_assoc($result);
            echo $row["description"];
        ?>
    </div>

    <br><br>

    <div class="container">
        <?php
            $row2 = mysqli_fetch_assoc($result2);
            echo $row2["admin_name"];
            echo "<br>" . $row2["admin_email"];
            echo "<br>" . $row2["phone_no"];
        ?>
    </div>

    <div class="container">

        <?php
            $message = "";

            if (isset($_SESSION['message'])) {
                $message = $_SESSION['message'];
                unset($_SESSION['message']);
            }
        ?>

        <form class="w-75" action="atelier1.php" method="post">

            <div class="form-group">
                <label>Full name</label>
                <input class="form-control" type="text" placeholder="name" name="username">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input class="form-control" type="email" placeholder="email address" name="email">
            </div>

            <br>

            <button class="btn btn-danger" type="submit">Register</button>
            
            <?php if (!empty($message)) : ?>
                <div class="alert alert-success">
                    <?php 
                        echo $message; 
                    ?>
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