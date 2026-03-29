<?php
require_once "connection.php";
$selectSql="SELECT * FROM users";
$result=$connection->query($selectSql);

if($result->num_rows==0){
    die("No record in the table");
}
//$result->fetch_all();//for small number of data 
//$row1=$result->fetch_assoc();//for large number of data as it fetches one row at a time
//$row2=$result->fetch_assoc(); //again returns next row, but doesnt show the precious row so to fix this problem we use while loop
while($row=$result->fetch_assoc()){ //this will now fetch all the rows one by one and then print them
    echo "<pre>";
    print_r($row);
    echo "</pre>";
}


