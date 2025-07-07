<?php
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "worshopdb";
    //$conn = "";

    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
    if(!$conn){
       die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "ALTER TABLE users MODIFY user_ID INT AUTO_INCREMENT";
    /*try{
        $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
    }
    catch(mysqli_sql_exception){
        echo "Couldn't connect :(";
    }
    
    */


?>