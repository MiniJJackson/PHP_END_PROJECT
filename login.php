<?php

    function canLogin($username, $password){
        if ($username === ninja && $email === ninja@ninja.be && $password === 1234){
            return true;
        }
        else{
            return false;
        }
    }

    if (!empty($_POST)){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (canLogin($username,$email, $password)){
            //echo "You are logged in";
            session_start();
            $_SESSION['username'] = $username;
        }
        else{
            //echo "You are not logged in";
            $error = true;
        }
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <title>Log In to FairlyPrompt</title>
</head>
<body>
<header>
 <!---include once moet hier komen -->

</header>

<div id="logSign">
    <form action="login.php" method="get">
        <h1>Log in to FairlyPrompt</h1>
        <nav class="nav--login">
            <a href="login.php" id="tabLogin">Log in</a>
            <a href="register.php" id="tabSignIn">Sign up</a>
        </nav>
    
        <div class="alert hidden">That password was incorrect. Please try again</div>
    
        <div class="form form--login">
            <label for="username">Username</label>
            <input type="text" id="username" name="username">

            <label for="email">Email</label>
            <input type="email" id="email" name="email">
        
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
        </div>
        
        <div class="form form--signup hidden">
            <label for="username2">Username</label>
            <input type="text" id="username2">
        
            <label for="password2">Password</label>
            <input type="password" id="password2">
            
            <label for="email">Email</label>
            <input type="text" id="email">
        </div>
        
        <input type="submit" class="btn" value="Log In">
    </form>
</div>
</body>
</html>