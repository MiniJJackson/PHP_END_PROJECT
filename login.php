<?php
  namespace MyApp;
  use PDO;
  include("classes/MyDb.php");
  $errormessage = 'The details where incorrect. Please try again';
  $error = false;

  if (!empty($_POST)){
    $username = $_POST['username'];
    /*$email = $_POST['email'];*/
    $password = $_POST['password'];

    $db = new MyDb();
    $db->__construct();
    $query = $db->prepare("SELECT * FROM gebruikers WHERE username = :username");
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->execute();
    $db->close();

        

    if ($query->rowCount() > 0) {
      // The query returned results
      $result = $query->fetch();
      if($result['activated'] == 1){
        if (password_verify($password,$result['password'])) {
          $error = false;
          // Username and password are correct
          session_start();
          $_SESSION['username'] = $result['username'];
          $_SESSION['role'] = $result['role'];
          $_SESSION['user_id'] = $result['user_id'];
          header("refresh:1; url=homepage.php");
          return true;
        } else {
          // password incorrect!
          $errormessage = 'Password incorrect!';
          $error = true;
        }
      } else {
        $errormessage = 'Your account is not activated yet, check your email!';
        $error = true;
      }
    } else {
      $errormessage = 'Username does not exist!';
      // Username does not exist!
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
 <!---include once moet hier komen -->
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
        <?php if (isset($error) && $error == true): ?>
            <div class="alert"><?php echo $errormessage; ?></div>
        <?php endif; ?>
        <nav>
            <a id="reset" href="user-resetpassword.php">Reset password</a>
        </nav>
        <input type="submit" class="btn" value="Log In">
    </form>
</div>
</body>
</html>