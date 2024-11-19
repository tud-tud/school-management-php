<?php 

$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "sms_db";

try {
    $conn = new PDO("mysql:host=$dbHost;dbname=$dbName",$dbUser,$dbPass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
}catch(PDOException $e){
    echo "Connection faile: ". $e->getMessage();
    exit;
}