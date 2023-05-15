<?php
    namespace MyApp;
    include("classes/MyDb.php");
    include_once 'header.php';

    $db = new MyDb();

    $db->__construct();
    $query = "SELECT * FROM favorites JOIN prompts ON favorites.id = prompts.id WHERE prompts.approved = ? GROUP BY favorites.id LIMIT 5";
    $query = $db->prepare($query);
    $query->execute([1]);   

    $prompts = $query->fetchAll();

    $qry = "SELECT id, COUNT(*) FROM favorites GROUP BY id";
    $qry = $db->prepare($qry);
    $qry->execute();
    $results = $qry->fetchAll();

    if($qry->rowCount() > 0) {
      $favorites = array();
      foreach($results as $result){
          $favorites[$result[0]] = $result[1];
      }
    } else {
      $favorites = 0;
    }

    $qry = "SELECT * FROM prompts WHERE approved = ? AND created_at IS NOT NULL ORDER BY created_at DESC LIMIT 5";
    $qry = $db->prepare($qry);
    $qry->execute([1]);

    $newestprompts = $qry->fetchAll();
    
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
    <title>Homepage</title>
</head>
<body>

<section>
    <div>
        <h1 class="homepageTitle">Hottest prompts test!</h1>
        
        <div class="hottestPrompts" style="flex-wrap: wrap;">
          <?php foreach ($prompts as $prompt) { ?>
            
            <div style="display: flex;flex-direction: column;width: 300px;" onclick="window.location.href='prompt.php?id=<?php echo $prompt['id']; ?>'">

              <span><?php echo $prompt['name']; ?></span>
              <img src="https://www.humanesociety.org/sites/default/files/2022-08/hl-yp-cats-579652.jpg" alt="cat" class="promptsImage">
              <span style=""><?php echo $prompt['description']; ?></span>
              <span>cost: <?php echo $prompt['cost']; ?></span>
              <span>Favorites: <?php echo (isset($favorites[$prompt['id']])) ? $favorites[$prompt['id']] : 0;  ?></span>
            </div>
          <?php } ?>
        </div>
    </div>

    <div>
        <h1 class="homepageTitle">Newest prompts</h1>
            <div class="newestPrompts">
            <?php foreach ($newestprompts as $prompt) { ?>
              
              <div style="display: flex;flex-direction: column;width: 300px;" onclick="window.location.href='prompt.php?id=<?php echo $prompt['id']; ?>'">

                <span><?php echo $prompt['name']; ?></span>
                <img src="https://www.humanesociety.org/sites/default/files/2022-08/hl-yp-cats-579652.jpg" alt="cat" class="promptsImage">
                <span style=""><?php echo $prompt['description']; ?></span>
                <span>cost: <?php echo $prompt['cost']; ?></span>
                <span>Favorites: <?php echo (isset($favorites[$prompt['id']])) ? $favorites[$prompt['id']] : 0;  ?></span>
              </div>
            <?php } ?>
          </div>
    </div>
</section>
<a href="all-prompts.php" class="a">Browse more</a>
</body>
</html>