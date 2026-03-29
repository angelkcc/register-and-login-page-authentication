<!--php code server side authetication-->
<?php
require "./database/connection.php";
session_start(); //to start session
if(isset($_SESSION['userislogin'])&& $_SESSION['userislogin']==true)
    {
        header("Location:/home.php");
    }
//localhost:8000?name=john&surname=wick (if we use get then it takes small value directly from the search url bar for small data)//query parameter
//get request(query parameter) vs post request(get request can be seen by anyone so post request is used so that nobody sees it when passes)
//print_r ($_GET['name']);//
//handle post request
//ternary operator to perform isset
//if(isset..) else but we use ternary
//cookies is a small database that stores user info and state of darkmode or lightmode acc to what user selects is stored here
//setcookie("email","angel@gmail.com",time()+86400);//set cookie using php in server side
//$cookies=$_COOKIE;
//print_r($cookies); //to read available cookies

//$_SESSION['islogin']=true; //helps connect two servers

if($_SERVER['REQUEST_METHOD']=="POST")
    {
    $formData=$_POST;
    //print_r($formData);
    $email=trim($formData['email']);
    $password=$formData['password'];
    $errors=[];
    
    //email validation
    if($email=="")
        {
            $errors['email']="email is required";
        }
    else if(filter_var($email,FILTER_VALIDATE_EMAIL)==false)
        {
            $errors['email']="Invalid email format";
        }
    else { //database verify
          $userExistsSql="SELECT *from users where email=?";
            $userExistsStmt=$connection->prepare($userExistsSql);
            $userExistsStmt->bind_param("s",$email);
            $userExistsStmt->execute();
            $result=$userExistsStmt->get_result();
            if($result->num_rows==0)
                {
                    $errors['email']="email not found";
                }
    }
    
    //password validation
    if($password=="")
        {
            $errors['password']="password is required";
        }
    if(empty($errors))//gives true of [].0,null or even when no variable set 
    {
        //form is valid.proceed with form handling
        //password check
          $userExistsSql="SELECT *from users where email=? and password=?";
            $userExistsStmt=$connection->prepare($userExistsSql);
            $userExistsStmt->bind_param("ss",$email,$password);
            $userExistsStmt->execute();
            $result=$userExistsStmt->get_result();
        if($result->num_rows>0)
            {
                //login
                $_SESSION['userislogin']=true; //lets enter homepage only if user is logged in and pw is correct
                header("Location:/home.php"); //redirect process

            }
            else{
                $errors['password']="password is incorrect";
            }
    }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <form action="login.php" method="POST" name="registerForm">
            <h2>Login to your account</h2>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class=" <?=isset($errors['email'])?'$error-input':''?>" name="email" id="email">
                <span class="error-text" id="emailErrorText">
                    <?=isset($errors['email'])?$errors['email']:''?>
                </span>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password"class=" <?=isset($errors['password'])?'$error-input':''?>" name="password" id="password">
                <span class="error-text" id="passwordErrorText">
                    <?=isset($errors['password'])?$errors['password']:''?>
                </span>
            </div>

            <button type="submit" class="registerBtn">Login</button>
        </form>
    </div>
    <!--<script src="./script.js"></script>-->
   <!-- <script>
        document.cookie="username=John" //setting cookie in client side
    </script>-->
</body>
</html>