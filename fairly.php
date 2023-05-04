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
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Fairly Prompts Logged In</title>
</head>
<body>
<header>
 <!---include once moet hier komen -->
 <a href="logout.php" class="loggedIn">Log out</a>
 
</header>
</body>
</html>