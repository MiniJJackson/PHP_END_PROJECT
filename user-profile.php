<?php
    namespace MyApp;
    include("classes/MyDb.php");
    include_once 'header.php';
      
    $db = new MyDb();

    $db->__construct();
    $query = "SELECT * FROM gebruikers WHERE user_id = ?";
    $query = $db->prepare($query);
    $query->execute([$_GET['user_id']]);
    

    $user = $query->fetch();

    $query = "SELECT * FROM `sales` s INNER JOIN `prompts` p WHERE s.id = p.id AND s.user_id = ?";
    $query = $db->prepare($query);
    $query->execute([$_GET['user_id']]);

    $boughtprompts = $query->fetchAll();
    
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
  <div>
        <img src="https://images.unsplash.com/photo-1488554378835-f7acf46e6c98?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1171&q=80" alt="Banner" class="banner">
    </div>

    <div>
      <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar" class="profile-picture">
        <div class="info">
        <h3 class="full-name">&#64;<?php echo $user['username']; ?></h2>
        <p>Your credits: <?php echo $user['credits']; ?></p>
        <p class="bio">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam nulla magna, tempus ac varius non, ultrices in tellus. Suspendisse nec metus magna. Quisque interdum turpis turpis, dapibus egestas ante pharetra ut.</p>
        </div>
    </div>

    <p id="boughtTitle">Your bought prompts</p>
    <div class="Prompts" id="boughtPrompts">
      
        <?php foreach ($boughtprompts as $prompt) { ?>
            
            <div class="singlePrompt">

              <span class="promptTitle"><?php echo $prompt['name']; ?></span>
              <img src="https://www.humanesociety.org/sites/default/files/2022-08/hl-yp-cats-579652.jpg" alt="cat" class="promptImg">
              <span class="promptDescrip"><?php echo $prompt['description']; ?></span>
            </div>
          <?php } ?>
    </div>

</section>
</body>
</html>