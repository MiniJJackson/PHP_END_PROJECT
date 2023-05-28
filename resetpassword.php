<?php
  namespace MyApp;
  include("classes/MyDb.php");
  include_once 'header.php';
  $errormessage = 'The details where incorrect. Please try again';
  $error = false;
  $showform = false;

  $resetpasscode = (isset($_GET['code'])) ? $_GET['code'] : '';
  $userid = (isset($_GET['userid'])) ? $_GET['userid'] : '';

  $db = new MyDb();

  $db->__construct();
  $query = "SELECT * FROM gebruikers WHERE user_id = ? AND resetpasscode = ?";
  $query = $db->prepare($query);
  $query->execute([$userid, $resetpasscode]);
  $result = $query->fetch();

  $resultstring = '';
  

  // check if there is a user and that the resetpasscode checks out AND also check if it's not out of date.
  if ($query->rowCount() > 0 && (strtotime($result['passresetrequest']) == strtotime(date('Y-m-d')))) {
    $showform = true;
    echo $result['passresetrequest'];
    if (!empty($_POST)){
      
      if($_POST['password'] == $_POST['repassword']){
        $options = [
          'cost' => 14,
        ];
        $hashpassword = password_hash($_POST['password'],  PASSWORD_DEFAULT, $options);

        $query = "UPDATE gebruikers SET password = ?, resetpasscode = '' WHERE user_id = ?";
        $query = $db->prepare($query);
        $query->execute([$hashpassword, $userid]);
        $resultstring = 'Account password reset ' . $result['username'] . ' rerouting you to login page!';
        header("refresh:5; url=login.php");
      } else {
        $errormessage = 'Password are not the same.';
        $error = true;
      }
    }

  } else {
    $errormessage = 'Username does not exist!';
    // Username does not exist!
    $error = true;
  }
  $db->close();

?><!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Reset password in FairlyPrompt</title>
</head>
<body>

<?php if (isset($showform) && $showform == true): ?>
<div id="logSign">
    <h1><?php echo $resultstring; ?></h1>
    <form action="resetpassword.php?code=<?php echo $resetpasscode . '&userid=' . $userid; ?>" method="post">
        <h1>Reset your password</h1>
        <div class="form form--resetpassword">

            <label for="password">Password:</label>
            <input type="password" id="password" name="password">

            <label for="repassword">Repeat password:</label>
            <input type="password" id="repassword" name="repassword">
        </div>

        <?php if (isset($error) && $error == true): ?>
            <div class="alert"><?php echo $errormessage; ?></div>
        <?php endif; ?>

        <input type="submit" class="btn" value="Reset password">
    </form>
</div>
<?php elseif(isset($showform) && $showform == false): ?>
  <h1>
    <div class="alert"><?php echo $errormessage; ?></div>
  </h1>
<?php endif; ?>
</body>
</html>