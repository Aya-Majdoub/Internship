<?php
    session_start();
    include("database.php");

    if(!isset($_SESSION["admin_ID"])){
        header("Location: adminlogin.php");
        exit();
    }

    $admin_ID = $_SESSION["admin_ID"];
    $sql = "SELECT * FROM users WHERE user_ID = '$admin_ID'";
    $result = mysqli_query($conn, $sql);
    $admin = mysqli_fetch_assoc($result);

    /*$sql2 = "SELECT * FROM workshop w LEFT JOIN users u ON u.user_ID = w.user_ID WHERE w.user_ID = '$admin_ID'";
    $result2 = mysqli_query($conn, $sql2);
    $info = mysqli_fetch_assoc($result2);
    $wrksho_ID = $info["workshop_ID"];
    $sql3 = "SELECT * FROM users u JOIN registration r ON r.user_ID = u.user_ID WHERE r.workshop_ID = '$wrksho_ID'";
    $result3 = mysqli_query($conn, $sql3);*/
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
    <div class="row">
        <h2 class="mycontainer">
            <?php echo "Hello " . $admin["username"]; ?>
        </h2><br><br>
    </div>

    <!-- Current workshops -->
    

    <!-- Add workshops -->
    <div>

    </div>


    <!-- Edit workshops -->
    <div>

    </div>



        <!--<div class="row justify-content-center">
            <div class="col-5">
                <ul class="desc">
                    <h3>Workshop info: </h3>
                    <li> <?php echo $info["title"]; ?> </li>
                    <li> <?php echo $info["description"]; ?> </li>
                    <li> <?php echo $info["workshop_date"]; ?> </li>
                </ul>
            </div>
            <div class="col-5">
                <ul class="desc">
                    <h3>Participants list: </h3>
                    <?php while ($info2 = mysqli_fetch_assoc($result3)) : ?>
                        <li> <?php echo $info2["username"]; ?> </li>
                        <li> <?php echo $info2["user_email"]; ?> </li>
                        <li> <?php echo $info2["par_status"]; ?> </li>
                    <?php endwhile; ?>
                </ul>
            </div>
        </div>-->
    

    
        
    
    <!-- bootstrap js -->
    <script src = "assets/JavaScript/bootstrap.bundle.min.js"></script>
    <!-- javascript -->
    <script src = "assets/JavaScript/main.js"></script>
</body>
</html>
