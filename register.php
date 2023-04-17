<?php

    if (!empty($_POST)){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $options = [
            'cost' => 14,
        ];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT, $options);
        //echo $password;

        $conn = new PDO('mysql:host=127.0.0.1;dbname=phpendproject',"root", "root");
        $query = $conn->prepare("insert into users(`userName`, `email`, `password`) values (:username, :email, :password)");
        $query->bindValue(":username", $username);
        $query->bindValue(":email", $email);
        $query->bindValue(":password", $password);   
        $query->execute();
   
    }

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <title>Sign up to FairlyPrompt</title>
</head>
<body>

<header>
 <!---include once moet hier komen -->

</header>

<div id="logSign">
    <form action="register.php" method="post">
        <h1>Sign up for FairlyPrompt</h1>
        <nav class="nav--login">
            <a href="login.php" id="tabLogin">Log in</a>
            <a href="register.php" id="tabSignIn">Sign up</a>
        </nav>
    
        <div class="form form--login">
            <label for="username">Username</label>
            <input type="text" id="username" name="username">

            <label for="email">Email</label>
            <input type="email" id="email" name="email">
        
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
        </div>

        
            <div class="alert hidden">The details where incorrect. Please try again</div>
       

        <input type="submit" class="btn" value="Sign up">
    </form>
</div>
</body>
</html>