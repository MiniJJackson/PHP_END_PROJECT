<?php

include_once("bootstrap.php");


$token = $_GET["token"];



if (!empty($_POST)) {
    try {
        $password1 = $_POST["password1"];
        $password2 = $_POST["password2"];

        if ($password1 === $password2) {
            User::updatePassword($token, $password1);
            header("location: login.php");
        } else {
            throw new Exception("Passwords dont match each other");
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>New password</title>
</head>

<body>


    <div id="form">
        <form action="" method="post">
            <br><br>
            <h1>New password</h1>
            <label>New password</label>
            <input type="password" name="password1" class="inputfield"><br>

            <label>Confirm password</label>
            <input type="password" name="password2" class="inputfield"><br>



            <?php if (isset($error)) {
                echo "<div id='error'>" . $error . "</div>";
            } ?>

            <button type="submit">Submit</button><br>


        </form>
    </div>



</body>

</html>