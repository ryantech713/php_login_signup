<?php
header("Content-type: application/json");

require_once "assets/includes/db.php";

if(isset($_POST["username"])){
    $username = test_input($_POST["username"]);

    if($username == "admin"){
        $response = ["status" => "error", "message" => "This username is restricted"];
    }

    $sql = "SELECT id FROM users WHERE username = :username";
    if($stmt = $pdo->prepare($sql)){
        $stmt->bindParam(":username", $username, PDO::PARAM_STRING);
        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                $response = ["status" => "error", "message" => "Username not Available"];
            }
        }
    }
    echo json_encode($response);
}

function test_input($data){
    $input = trim($data);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);

    return $input;
}