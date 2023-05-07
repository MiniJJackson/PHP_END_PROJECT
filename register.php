<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->

<?php
    include_once(__DIR__ . "/classes/User.php");
    require_once("bootstrap.php");

    if(!empty($_POST)){

        try {
            include_once("bootstrap.php");
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $password2 = $_POST['password2'];
        
            $user = new User();
        
            $user->setEmail($email);
            $user->setPassword($password);
            $user->setFirstname($firstname);
            $user->setLastname($lastname);
            $user->setUsername($username);

           
            
            if ($user->canRegister($password, $password2)) {
                echo "SESSION HAS STARTED";
                session_start();
                $_SESSION['user'] = $user->getUsername();
                $user->register();
                $succes ="User saved succesfully";
                header("Location: homepage.php");
            }
            echo $user->getUsername();
        }
        catch(Throwable $th){
            $error = $th->getMessage();
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

<?php include_once 'header.php'?>

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

            <label for="password">Password</label>
            <input type="password" id="password2" name="password2">
        </div>

        
            <div class="alert hidden">The details where incorrect. Please try again</div>
       

        <input type="submit" class="btn" value="Sign me up">
    </form>
</div>

<!-- <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>-->
</body>
</html>