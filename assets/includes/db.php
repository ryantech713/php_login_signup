<?php

const DB_HOST = "";
const DB_NAME = "accounts";
const DB_USER = "admin";
const DB_PASS = "";

try {
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("Error: Could not connect. " . $e->getMessage());
}
?>