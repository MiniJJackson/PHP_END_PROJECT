<?php

include_once("bootstrap.php");

session_start();

if (!empty($_POST)) {
    try {
        $currentpassword = $_POST["currentpassword"];
        $newpassword = $_POST["newpassword"];
        $newpassword2 = $_POST["newpassword2"];

        $sessionId = $_SESSION['user'];
        $user = User::getUserFromEmail($sessionId);
        $email = $user["email"];


        if ($newpassword === $newpassword2) {
            User::changeCurrentPassword($currentpassword, $newpassword, $newpassword2, $email);
            header("location: homepage.php");
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
    <title>Change password</title>
</head>

<body>

    <div id="form">
        <form action="" method="post">
            <br><br>
            <h1>Change current password</h1>
            <label>Current password</label>
            <input type="password" name="currentpassword" class="inputfield"><br>

            <label>New password</label>
            <input type="password" name="newpassword" class="inputfield"><br>

            <label>Confirm password</label>
            <input type="password" name="newpassword2" class="inputfield"><br>



            <?php if (isset($error)) {
                echo "<div id='error'>" . $error . "</div>";
            } ?>

            <button type="submit">Submit</button><br>


        </form>
    </div>



</body>

</html>