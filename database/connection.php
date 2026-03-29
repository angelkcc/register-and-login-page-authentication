<?php
$host="localhost";
$username="root";
$password="Nepal@123";
$dbname="web";

$connection= new mysqli($host,$username,$password,$dbname,3306);

if($connection->connect_error){
    die("Connection failed: ");
}
echo "connected successfully";
?>

