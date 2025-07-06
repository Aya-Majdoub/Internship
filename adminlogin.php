<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
</head>
<body>
    <form action="adminlogin.php" method="post">
        <label>Email:</label><br>
        <input type = "text" name = "email"><br>

        <label>Password:</label><br>
        <input type = "password" name = "password"><br>
        <input type = "submit" value = "Log in" >
    </form>
</body>
</html>

<?php
    include("database.php");

    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM admin WHERE admin_email = '$email'";
    $result = mysqli_query($conn, $sql);

    
    $row = mysqli_fetch_assoc($result);
    if ($row ["ad_password"] == $password){
        echo "Password is correct";
    }
    else {
        echo "Incorrect password, try again";
    }
    

    mysqli_close($conn);
?>