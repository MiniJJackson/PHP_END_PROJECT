<?php
    /*if (!empty($_POST)){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $options = [
            'cost' => 14,
        ];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT, $options);
        //echo $password;

        $conn = new PDO('mysql:host=127.0.0.1;dbname=phpendproject',"root", "root");
        $query = $conn->prepare("insert into users(`userName`, `email`, `password`) values (:username, :email, :password)");
        $query->bindValue(":username", $username);
        $query->bindValue(":email", $email);
        $query->bindValue(":password", $password);   
        $query->execute();
    }*/

    include_once(__DIR__ . "/classes/User.php");

    if(!empty($_POST)){

        try{
            $user = new User();
            $user->setUsername($_POST['username']);
            $user->setEmail($_POST['email']);

            $options = [
                'cost' => 14,
            ];
            $user->setPassword(password_hash($_POST['password'],  PASSWORD_DEFAULT, $options));
    
            //echo $user->getUsername();
    
            $user->save();
            $succes ="User saved succesfully";
        }
        catch(\Throwable $th){
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

        
            <div class="alert hidden">The details where incorrect. Please try again</div>
       

        <input type="submit" class="btn" value="Sign me up">
    </form>
</div>
</body>
</html>