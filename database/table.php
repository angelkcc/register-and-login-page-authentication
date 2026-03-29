<?php

require_once "connection.php";
$tablesql="CREATE TABLE IF NOT EXISTS users(
id INT AUTO_INCREMENT PRIMARY KEY,
fullname VARCHAR(255) NOT NULL,
email VARCHAR(255)  NOT NULL UNIQUE,
password VARCHAR(255) NOT NULL,
verified_at DATETIME,
CREATED_AT TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

$result=$connection->query($tablesql);
if($result === false){
    die("failed to create table:");
}
echo "table created successfully";
?>