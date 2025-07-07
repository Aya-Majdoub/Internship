<?php
    session_start();
    include("database.php");

    if(!isset($_SESSION["admin_ID"])){
        header("Location: adminlogin.php");
        exit();
    }

    $admin_ID = $_SESSION["admin_ID"];
    $sql = "SELECT * FROM admin WHERE admin_ID = '$admin_ID'";
    $result = mysqli_query($conn, $sql);
    $admin = mysqli_fetch_assoc($result);

    $sql2 = "SELECT * FROM workshop w LEFT JOIN admin a ON a.admin_ID = w.admin_ID WHERE w.admin_ID = '$admin_ID'";
    $result2 = mysqli_query($conn, $sql2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>


    <!-- bootstrap css -->
    <link rel = "stylesheet" href = "assets/CSS/bootstrap.min.css">
    <!-- css -->
    <link rel = "stylesheet" href = "assets/CSS/mystyles.css">
</head>
<body>
    
    <h1>Admin profile</h1>

    <p>
        <?php echo $admin["admin_name"]; ?>
    </p>
    <ul>
        <?php $info = mysqli_fetch_assoc($result2); ?>
        <li> <?php echo $info["title"]; ?> </li>
        <li> <?php echo $info["description"]; ?> </li>
        <li> <?php echo $info["workshop_date"]; ?> </li>
    </ul>
    
    <!-- bootstrap js -->
    <script src = "assets/JavaScript/bootstrap.bundle.min.js"></script>
    <!-- javascript -->
    <script src = "assets/JavaScript/main.js"></script>
</body>
</html>
