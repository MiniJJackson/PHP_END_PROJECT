<?php
    namespace MyApp;
    include("classes/MyDb.php");
    session_start();
      
    $db = new MyDb();

    $db->__construct();
    $query = "SELECT * FROM gebruikers WHERE user_id = ?";
    $query = $db->prepare($query);
    $query->execute([$_GET['id']]);
    

    $user = $query->fetch();

    $query = "SELECT * FROM prompts WHERE creator = ?";
    $query = $db->prepare($query);
    $query->execute([$user['user_id']]);

    $prompts = $query->fetchAll();
    
    $db->close();

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
    <title>user</title>
</head>
<body>

<section>
  <a id="home" href="homepage.php">home</a>
    <div>
        <h1 class="homepageTitle">username: <?php echo $user['username']; ?></h1>
        
        <div class="hottestPrompts">
        <?php foreach ($prompts as $prompt) { ?>
            
            <div style="display: flex;flex-direction: column;">

              <span><?php echo $prompt['name']; ?></span>
              <img src="https://www.humanesociety.org/sites/default/files/2022-08/hl-yp-cats-579652.jpg" alt="cat" class="promptsImage">
              <span><?php echo $prompt['description']; ?></span>
            </div>
          <?php } ?>
        </div>
    </div>
</section>
</body>
</html>