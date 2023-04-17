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
?>