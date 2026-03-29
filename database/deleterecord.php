<?php
require_once "connection.php";
$deleteSql="DELETE FROM users WHERE id=1";  
$connection->query($deleteSql);

echo "user record deleted successfully";