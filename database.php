<?php
    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "dbpass@wrkshp2025";
    $db_name = "worshopdb";
    //$conn = "";

    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
    if(!$conn){
       die("Connection failed: " . mysqli_connect_error());
    }

    /*$password = "adpass4";
    $hashedpass = password_hash($password, PASSWORD_DEFAULT);

    $query = "UPDATE users SET password = (?) WHERE username = 'admin4'";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $hashedpass);
    $stmt->execute();*/

    /*$sql1 = "INSERT INTO workshop (workshop_ID, title, workshop_date, start_time, end_time, description, location, capacity, category) VALUES (4, 'Art of transformation', '2025-07-14', '09:30:00', '12:00:00', 'Ronald Rand - Cultural Ambassador and Professor of Theater (USA)', 'Faculty of Letters and Human Sciences – Ben M’Sik, Hassan II University, Casablanca', '20', 'theater')";
    $sql2 = "INSERT INTO workshop (workshop_ID, title, workshop_date, start_time, end_time, description, location, capacity, category) VALUES (5, 'Le masque et le corps du personnage', '2025-07-14', '09:30:00', '12:00:00', 'Claudio de Maglio - Professor of Theater (Italy)', 'Faculty of Letters and Human Sciences – Ben M’Sik, Hassan II University, Casablanca', '20', 'theater')";
    $sql3 = "INSERT INTO workshop (workshop_ID, title, workshop_date, start_time, end_time, description, location, capacity, category) VALUES (6, 'Le voyage du personnage', '2025-07-14', '09:30:00', '12:00:00', 'Philippe Mertz - Theater writing coach (France)', 'Faculty of Letters and Human Sciences – Ben M’Sik, Hassan II University, Casablanca', '20', 'theater')";
    $sql4 = "INSERT INTO workshop (workshop_ID, title, workshop_date, start_time, end_time, description, location, capacity, category) VALUES (7, 'Meinser Technique for Scene Development', '2025-07-14', '09:30:00', '12:00:00', 'Jhon Freeman - Professor of Theater (Australia)', 'Faculty of Letters and Human Sciences – Ben M’Sik, Hassan II University, Casablanca', '20', 'theater' )";

    mysqli_query($conn, $sql1);
    mysqli_query($conn, $sql2);
    mysqli_query($conn, $sql3);
    mysqli_query($conn, $sql4);*/
    
    /*try{
        $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
    }
    catch(mysqli_sql_exception){
        echo "Couldn't connect :(";
    }
    
    */


?>