<?php
  namespace MyApp;
  include("classes/MyDb.php");
  include_once(__DIR__ . "/services/email.php");
  include_once 'header.php';
  $errormessage = 'The details where incorrect. Please try again';
  $error = false;

  if (!empty($_POST)){
    $db = new MyDb();

    $db->__construct();
    $query = "SELECT * FROM gebruikers WHERE email = ?";
    $query = $db->prepare($query);
    $query->execute([$_POST['email']]);
    $result = $query->fetch();

    
    if ($query->rowCount() > 0) {
      $userresetpassword = randomString(128);
      $currentdate = date('Y-m-d');
      $query = "UPDATE gebruikers SET resetpasscode = ?, passresetrequest = ? WHERE user_id = ?";
      $query = $db->prepare($query);
      $query->execute([$userresetpassword, $currentdate, $result['user_id']]);

      //  header("refresh:5; url=login.php");
      sendEmail('Password reset','Someone has requested a password reset link you have untill today to change your password before this code expires: ' . 'http://localhost/UPDATEDPROJECTPHP/resetpassword.php?code=' . $userresetpassword . '&userid=' . $result['user_id'],$_POST['email']);
    } else {
      $errormessage = 'No email found in our database!';
      $error = true;
    }
    $db->close();
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
<div id="logSign">
    <form action="user-resetpassword.php" method="post">
        <h1>Reset password</h1>
        <button class="goback" id="gobackReset" onclick="history.back()">&lt; Go back</button>
        <div class="form form--resetpassword">
            <p id="resetText">Fill in your email below and we'll send you an email to reset your password.</p>
            <label for="email">Email</label>
            <input type="email" id="email" name="email">
        </div>

        <?php if (isset($error) && $error == true): ?>
            <div class="alert"><?php echo $errormessage; ?></div>
        <?php endif; ?>

        <input type="submit" class="btn" value="Reset password">
    </form>
</div>
</body>
</html>