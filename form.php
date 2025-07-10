<?php

    include("database.php");

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");

    $data = json_decode(file_get_contents("php://input"), true);
    file_put_contents("log.txt", json_encode($data) . PHP_EOL, FILE_APPEND);


    if (!isset($data['name']) || !isset($data['email'])) {
        echo json_encode(["error" => "Invalid input"]);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO users (username, user_email) VALUES (?, ?)");
    $stmt->bind_param("ss", $data['name'], $data['email']);

    if ($stmt->execute()) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["error" => "Insert failed"]);
    }

    $stmt->close();
    $conn->close();
?>
