<?php
header("Content-type: application/json");

require "assets/includes/functions.php";

require_once INCLUDES_DIR . "db.php";

if(isset($_POST["username"])) {
    $username = test_input($_POST["username"]);
    if(!preg_match("/^[a-zA-Z0-9_]+$/", $username)) {
      $response = ["status" => "error", "message" => "Username can only contain letters, numbers, dashes and underscores"];
    }
    if($username == "admin") {
        $response = ["status" => "error", "message" => "This username is restricted"];
    }

    $sql = "SELECT id FROM users WHERE username = :username";
    if($stmt = $pdo->prepare($sql)) {
        $stmt->bindParam(":username", $username, PDO::PARAM_STRING);
        if($stmt->execute()) {
            if($stmt->rowCount() == 1) {
                $response = ["status" => "error", "message" => "Username not Available"];
            }
        }
    }
    echo json_encode($response);
}
