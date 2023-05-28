<?php
    namespace MyApp;
    include("classes/MyDb.php");
    include_once(__DIR__ . "/classes/User.php");
    include_once(__DIR__ . "/services/email.php");
    $errormessage = 'Something went wrong!';
    $haserror = false;

    if(!empty($_POST)){
        $db = new MyDb();

        $db->__construct();
        $query = "SELECT * FROM gebruikers WHERE email = ? OR username = ?";
        $query = $db->prepare($query);
        $query->execute([$_POST['email'], $_POST['username']]);

          if ($query->rowCount() <= 0) {
            try{
              $useractivationcode = randomString(128);
              $useruniqueid = uniqid();
              $user = new User();
              $user->setUserid($useruniqueid);
              $user->setUsername($_POST['username']);
              $user->setEmail($_POST['email']);
              $user->setLastname($_POST['lastname']);
              $user->setFirstname($_POST['firstname']);
              $user->setActivationcode($useractivationcode);


              $options = [
                  'cost' => 14,
              ];
              $user->setPassword(password_hash($_POST['password'],  PASSWORD_DEFAULT, $options));
              /** het wachtwoord wordt hier gehashed voor dat het in het database wordt geplaatst */
              /** "zet het password als volgende in de DB: wat je gekregen hebt uit post met 'password', hash deze met de default algo. van bcrypt, met als cost 14. */
              /** md5 & sha1 = onveilig, kan gemakkelijk gekraakt worden met moderne software */
      
              //echo $user->getUsername();
      
              $user->save();
              $succes ="User saved succesfully";

              sendEmail($_POST['username'] . ' please activate your account','Your account is not activated yet, please click on this link: ' . 'http://172.162.242.96/PHP_END_PROJECT/activateaccount.php?code=' . $useractivationcode . '&userid=' . $useruniqueid,$_POST['email']);
              
          }
          catch(\Throwable $th){
              $error = $th->getMessage();
              $errormessage = $error;
              $haserror = true;
          }
        } else {
          // email already used..
          $errormessage = 'Email or username already in use!';
          $haserror = true;
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
    <title>Sign up to FairlyPrompt</title>
</head>
<body>

<header>
 <!---include once moet hier komen -->

</header>

<div id="logSign">
    <?php if(isset($succes)): ?>
        <div class="succes"><?php echo $succes; ?></div>
    <?php endif; ?>

    <form action="register.php" method="post">
        <h1>Sign up for FairlyPrompt</h1>
        <nav class="nav--login">
            <a href="login.php" id="tabLogin">Log in</a>
            <a href="register.php" id="tabSignIn">Sign up</a>
        </nav>
    
        <div class="form form--login">

            <label for="firstname">First name</label>
            <input type="text" id="firstname" name="firstname">

            <label for="lastname">Last name</label>
            <input type="text" id="lastname" name="lastname">

            <label for="username">Username</label>
            <input type="text" id="username" name="username">

            <label for="email">Email</label>
            <input type="email" id="email" name="email">
        
            <label for="password">Password</label>
            <input type="password" id="password" name="password">
        </div>

        
        <?php if (isset($haserror) && $haserror == true): ?>
            <div class="alert"><?php echo $errormessage; ?></div>
        <?php endif; ?>
       

        <input type="submit" class="btn" value="Sign me up">
    </form>
</div>
</body>
</html>
