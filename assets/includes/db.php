<?php

const DB_SERVER = "142.171.235.218";
const DB_NAME = "accounts";
const DB_USER = "admin";
const DB_PASS = '#H!town$rdcRYAN410';

try {
    $pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("Error: Could not connect. " . $e->getMessage());
}
?>
