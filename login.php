<?php

  

    if (!empty($_POST)){
        $username = $_POST['username'];
        /*$email = $_POST['email'];*/
        $password = $_POST['password'];
        
        include_once(__DIR__ . "/classes/User.php");

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
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Log In to FairlyPrompt</title>
</head>
<body>
<header>
<?php
    include_once 'header.php'

?>

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