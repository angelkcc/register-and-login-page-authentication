<?php
require_once "connection.php"; //require once and require are used to include the file only once and if the file is not found it will give a fatal error and stop the execution of the script
//include_once run the file even if there is error in the file but require once will stop execution
$fullname="Anuska khatri";
$email="anusakhatri@example.com";
$password="abc123";
$insertSql ="INSERT INTO users(fullname,email,password)
VALUES(?,?,?)"; //to prevent sql injection we use prepared statement and parameterized query

//sql injection is a type of attack that allows attackers to execute malicious SQL statements that control a web application's database server. The attacker can use SQL injection to bypass authentication, access, modify and delete data, and even execute administrative operations on the database. To prevent SQL injection, you should use prepared statements and parameterized queries, which ensure that user input is treated as data rather than executable code. Additionally, you should validate and sanitize user input to further reduce the risk of SQL injection attacks.
$preparedStatement=$connection->prepare($insertSql);
$preparedStatement->bind_param('sss',$fullname,$email,$password);
$preparedStatement->execute();

echo "<br>Record inserted successfully";


