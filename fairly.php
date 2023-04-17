<?php
    session_start();
    if (isset($_SESSION['username'])){
        echo "Welcome " . $_SESSION['username'];
        //header("Location: index.php");
    }
    else{
        //echo "You are not logged in";
        //header("Location: login.php");
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fairly Prompts Logged In</title>
</head>
<body>
<header>
 <!---include once moet hier komen -->
 <a href="logout.php" class="loggedIn">Log out</a>
 
</header>
</body>
</html>