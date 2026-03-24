<?php
session_start();
if(!isset($_SESSION['userislogin'])||$_SESSION['userislogin']==false)
    {
        header("Location:/login.php");
        exit(0);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
    <h1>HOMEPAGE OF OUR APP</h1>
    <form action="logout.php" method="POST">
    <button type="submit">logout</button>
    </form>
</body>
</html>