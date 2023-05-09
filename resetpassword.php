<?php

include_once("bootstrap.php");


if (!empty($_POST)) {
    try {
        $email = $_POST["email"];

        $user = User::getUserFromEmail($email);

        if ($user) {

            $expDate = date("Y-m-d H:i:s", mktime(date("H"), date("i"), date("s"), date("m"), date("d") + 1, date("Y")));

            $token = md5($email . "salty" . $expDate);

            User::passwordResetToken($token, $expDate, $email);

            header("Location: mail.php?token=$token&email=$email");
        } else {
            throw new Exception("User not found");
        }
    } catch (Throwable $error) {
        $error = $error->getMessage();
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
    <title>Reset password</title>
</head>

<body>

    <div id="form">
        <form action="" method="post">
            <br><br>
            <h1>Reset password</h1>
            <label>Email address</label>
            <input type="email" name="email" class="inputfield"><br>


            <?php if (isset($error)) {
                echo "<div id='error'>" . $error . "</div>";
            } ?>

            <button type="submit">Submit</button>
            <br>

        </form>
    </div>


</body>

</html>