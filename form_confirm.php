<?php

    session_start();
    include("database.php");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $name = $fname ." ". $lname;
        $email = $_POST["email"];
        $status = $_POST["status"];
        $workshop = $_POST["selected_card"];
        $part = "Participant";
        $exp = $_POST["expectations"];

     
        if($workshop == "Art of transformation"){
            $wrkshp_ID = 1;
        }
        elseif($workshop == "Le masque et le corps du personnage"){
            $wrkshp_ID = 2;
        }
        elseif($workshop == "Le voyage du personnage"){
            $wrkshp_ID = 3;
        }
        elseif($workshop == "Meinser Technique for Scene Development"){
            $wrkshp_ID = 4;
        }

        $check = "SELECT * FROM users WHERE user_email = '$email'";
        $checking = mysqli_query($conn, $check);

        $now = date('Y-m-d'); 

        if(empty($name) || empty($email) || empty($status)){
            $_SESSION["message"] = "Please fill in all fields.";
            header("Location: index.php?error=1");
            exit();
        }
        elseif(mysqli_num_rows($checking) > 0){
            $_SESSION["message"] = "This email already exists!";
            header("Location: index.php?error=2");
            exit();
        }
        else {
            $sql = "INSERT INTO users (username, user_email, status) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);

            $query = "INSERT INTO registration (registration_date, user_ID, workshop_ID, par_status, expectations) VALUES (?, ?, ?, ?, ?)";
            $stmt2 = mysqli_prepare($conn, $query);
            

            if($stmt && $stmt2){
               $stmt->bind_param("sss", $name, $email, $part); 
               $stmt->execute();
               $user_id = mysqli_insert_id($conn);
               $stmt->close();

               $stmt2->bind_param("siiss", $now, $user_id, $wrkshp_ID, $status, $exp); 
               $stmt2->execute();
               $stmt2->close();

                $_SESSION["fname"] = $fname;
                $_SESSION["lname"] = $lname;
                $_SESSION["name"] = $name;
                $_SESSION["email"] = $email;
                $_SESSION["status"] = $status;
                $_SESSION["workshop"] = $workshop;
                $_SESSION["part"] = $part;
                $_SESSION["exp"] = $exp;
               
               header("Location: form_confirm.php?success=1");
               exit();
            }
            
        }
    }

    mysqli_close($conn);

?>
<?php
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
    <link rel = "stylesheet" href = "assets/CSS/mystyles.css">

</head>
<body>
    
    <h1>Your participation info</h1>
    <h2>
        <?php 
            echo $fname;
            echo $lname;
            echo $name;
            echo $email;
            echo $status;
            echo $workshop;
            echo $part;
            echo $exp; 
        ?>
    </h2>

    <!-- bootstrap js -->
    <script src = "assets/JavaScript/bootstrap.bundle.min.js"></script>
    <!-- javascript -->
    <script src = "assets/JavaScript/main.js"></script>
</body>
</html>