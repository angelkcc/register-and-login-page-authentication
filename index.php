<!--php code server side authetication-->
<?php
//localhost:8000?name=john&surname=wick (if we use get then it takes small value directly from the search url bar for small data)//query parameter
//get request(query parameter) vs post request(get request can be seen by anyone so post request is used so that nobody sees it when passes)
//print_r ($_GET['name']);//
//handle post request
//ternary operator to perform isset
//if(isset..) else but we use ternary
if($_SERVER['REQUEST_METHOD']=="POST")
    {
    $formData=$_POST;
    $registeredemail=["john@gmail.com"];
    //print_r($formData);
    $name=htmlspecialchars(trim($formData['fullname'])); //trim removes space
    $email=trim($formData['email']);
    $password=$formData['password'];
    $confirmpassword=$formData['confirmpassword'];
    $errors=[];
    //name validation
    if($name==""){
        $errors['fullname']="Name is required";
    }
    else if(strlen($name)<3)
        {
            $errors['fullname']="Name must be atleast three characters";
        }
    
    //email validation
    if($email=="")
        {
            $errors['email']="email is required";
        }
    else if(filter_var($email,FILTER_VALIDATE_EMAIL)==false)
        {
            $errors['email']="Invalid email format";
        }
    else if(in_array($email,$registeredemail))
        {
            $errors['email']="email already exists";
        }
    
    //password validation
    if($password=="")
        {
            $errors['password']="password is required";
        }
    else if(strlen($password)<6)
        {
            $errors['password']="password must be at least 6 letter long";
        }
    //confirm password validation
    if($password!=$confirmpassword)
        {
            $errors['confirmpassword']="password doesnt match";
        }
    
    if(empty($errors))//gives true of [].0,null or even when no variable set 
    {
        //form is valid.proceed with form handling


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
        <form action="/index.php" method="POST" name="registerForm">
            <h2>Create an account</h2>
            <div class="form-group">
                <label for="fullname">Name</label>
                <input type="text"class=" <?=isset($errors['fullname'])?'$error-input':''?>" name="fullname" id="fullname">
                <span class="error-text" id="fullnameErrorText">
                    <?=isset($errors['fullname'])?$errors['fullname']:''?>
                </span>
            </div>

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

            <div class="form-group">
                <label for="confirmpassword">Confirm Password</label>
                <input type="password"class=" <?=isset($errors['confirmpassword'])?'$error-input':''?>" name="confirmpassword" id="confirmpassword">
                <span class="error-text" id="confirmpasswordErrorText">
                    <?=isset($errors['confirmpassword'])?$errors['confirmpassword']:''?>
                </span>
            </div>

            <button type="submit" class="registerBtn">Register</button>
        </form>
    </div>
    <!--<script src="./script.js"></script>-->
</body>
</html>