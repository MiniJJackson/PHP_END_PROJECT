<?php

    function canLogin($username,/* $email, */ $password){
        $conn = DB::getConnection();

        $statement = $conn->prepare("select * from users where username = :username");
        $statement->bindValue(":username", $username);
        $statement->execute();
        $user = $statement->fetch();
        /*var_dump($user);// test if a user excists
        exit();*/
        if (!$user){
            return false;
        }

        $hash = $user['password'];
        if( password_verify($password, $hash)){
            return true;
        }
        else{
            return false;
        }
    }

    if (!empty($_POST)){
        $username = $_POST['username'];
        /*$email = $_POST['email'];*/
        $password = $_POST['password'];

        if (canLogin($username, /*$email,*/ $password)){
            //echo "You are logged in";
            session_start();
            $_SESSION['username'] = $username;
            header("refresh:5; url=fairly.php");
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

    <a href="#" class="loggedIn">
        <div class="user--account">
            <?php if(isset($_SESSION['username'])): ?>
            <h3 class="user--name"><?php echo $username; ?></h3>
            <?php else: ?>
            <h3 class="user--name">Username here</h3>
            <?php endif; ?>
        </div>
    </a>  
    <a href="logout.php" class="loggedIn">Log out</a>
</header>

<div id="logSign">
    <form action="login.php" method="post">
        <h1>Log in to FairlyPrompt</h1>
        <nav class="nav--login">
            <a href="login.php" id="tabLogin">Log in</a>
            <a href="register.php" id="tabSignIn">Sign up</a>
        </nav>
    
        <div class="form form--login">
            <label for="username">Username</label>
            <input type="text" id="username" name="username">

            <!---<label for="email">Email</label>
            <input type="email" id="email" name="email">--->
        
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
        </div>

        <?php if (isset($error)): ?>
            <div class="alert">The details where incorrect. Please try again</div>
        <?php endif; ?>
        
        <input type="submit" class="btn" value="Log In">
    </form>
</div>
</body>
</html>