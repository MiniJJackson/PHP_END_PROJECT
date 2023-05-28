<?php
    include_once(__DIR__ . "/classes/Prompt.php");
    include_once("header.php");
    if (isset($_SESSION['username'])){
      if(!empty($_POST)){
      
        try{
            $prompt = new Prompt();
            $prompt->setName($_POST['name']);
            $prompt->setCost($_POST['cost']);
            $prompt->setDate($_POST['date']);
            $prompt->setDescription($_POST['description']);
            $prompt->setCategory($_POST['category']);
            $prompt->setModel($_POST['model']);
            $prompt->setCreator($_SESSION['user_id']);
    
            $prompt->save();
            $succes ="Prompt created succesfully";
        }
        catch(\Throwable $th){
            $error = $th->getMessage();
            echo $error;
        }
        
    }
        //header("Location: index.php");
    }
    else{
        //echo "You are not logged in";
      header("Location: login.php");
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
    <title>Create prompt</title>
</head>
<body>

<div id="logSign">
    <?php if(isset($succes)): ?>
        <div class="succes"><?php echo $succes; ?></div>
    <?php endif; ?>

    <form action="create-prompt.php" method="post">
        <h1>Create prompt for FairlyPrompt</h1>
        <button class="goback" id="gobackCreate" onclick="history.back()">&lt; Go back</button>
    
        <div class="form form--login">

            <label for="name">Name</label>
            <input type="text" id="name" name="name">

            <label for="cost">Cost</label>
            <input type="text" id="cost" name="cost">

            <label for="date">Date</label>
            <input type="date" id="date" name="date">

            <label for="description">Description</label>
            <input type="text" id="description" name="description">

            <label for="category">Category</label>
            <input type="text" id="category" name="category">

            <label for="model">Model</label>
            <input type="text" id="model" name="model">
        </div>

        
            <div class="alert hidden">The details where incorrect. Please try again</div>
       

        <input type="submit" class="btn" value="Create prompt">
    </form>
</div>
</body>
</html>