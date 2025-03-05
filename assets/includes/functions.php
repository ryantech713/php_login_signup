<?php
session_start();
// Point this constant to your includes directory location
const INCLUDES_DIR =  "assets/includes/";
// Set the SITE_NAME constant
const SITE_NAME = "";

function test_input($data){
    $input = trim($data);
    $input = stripslashes($input);
    $input = htmlspecialchars($input);

    return $input;
}

function generateCSRFToken(){
    if(!isset($_SESSION["csrf_token"])){
        $_SESSION["csrf_token"] = bin2hex(random_bytes(32));
    }
}