<?php
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "dbpass@wrkshp2025";
    $db_name = "workshopdb";
    //$conn = "";

    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
    if(!$conn){
       die("Connection failed: " . mysqli_connect_error());
    }

    $password = "adpass2";
    $hashedpass = password_hash($password, PASSWORD_DEFAULT);

    $query = "UPDATE users SET usrpassword = (?) WHERE username = 'admin2'";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $hashedpass);
    $stmt->execute();
    
    /*try{
        $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
    }
    catch(mysqli_sql_exception){
        echo "Couldn't connect :(";
    }
    
    */


?>