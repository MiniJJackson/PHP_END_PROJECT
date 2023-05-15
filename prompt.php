<?php
    namespace MyApp;
    include("classes/MyDb.php");
    session_start();
      
    $db = new MyDb();

    $db->__construct();
    $query = "SELECT * FROM prompts WHERE id = ?";
    $query = $db->prepare($query);
    $query->execute([$_GET['id']]);
    

    $prompt = $query->fetch();

    $qry = "SELECT id, COUNT(*) FROM favorites WHERE id = ? GROUP BY id";
    $qry = $db->prepare($qry);
    $qry->execute([$prompt['id']]);
    if($qry->rowCount() > 0) {
      $favorites = $qry->fetch()[1];
    } else {
      $favorites = 0;
    }

    $qry = "SELECT username FROM gebruikers WHERE user_id = ?";
    $qry = $db->prepare($qry);
    $qry->execute([$prompt['creator']]);
    $creator = $qry-> fetch()[0];

    if (isset($_SESSION['user_id'])){
      $qry = "SELECT CASE WHEN EXISTS (SELECT * FROM favorites WHERE user_id = ? AND id = ?) THEN 'true' ELSE 'false' END";
      $qry = $db->prepare($qry);
      $qry->execute([$_SESSION['user_id'], $_GET['id']]);
  
      $favorited = $qry-> fetch()[0];
      if ($favorited == 'false'){
        $favorited = false;
      } else {
        $favorited = true;
      }
    }


    
    $db->close();

?>

<?php 
  // check if the form was submitted
  if (!empty($_POST)) {
    // get the prompt name
    $prompt_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];
    // update the prompt in the database
    $db->__construct();
    
    if ($favorited){
      $query = "DELETE FROM favorites WHERE user_id = ? AND id = ?";
      $query = $db->prepare($query);
      $query->execute([$user_id, $prompt_id]);
    } else {
      $query = "INSERT INTO favorites SET user_id = ?, id = ?";
      $query = $db->prepare($query);
      $query->execute([$user_id, $prompt_id]);
    }
    
    $db->close();
    header("Location: prompt.php?id=" . $prompt["id"]);
  }
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
    <title>prompt</title>
</head>
<body>

<section>
  <a id="home" href="homepage.php">home</a>
    <div>
        <h1 class="homepageTitle"><?php echo $prompt['name']; ?></h1>
        
        
        <div style="display: flex;flex-direction: column;">
          <img src="https://www.humanesociety.org/sites/default/files/2022-08/hl-yp-cats-579652.jpg" alt="cat" class="promptsImage">
          <span><?php echo $prompt['description']; ?></span>
          <span>creator: <a onclick="window.location.href='user.php?id=<?php echo $prompt['creator']; ?>'"><?php echo $creator; ?></a></span>
          <span>cost: <?php echo $prompt['cost']; ?></span>
          <span>favorites: <?php echo $favorites; ?></span>
          <?php if (isset($_SESSION['username'])) { ?>
            <form method="post" action="prompt.php?id=<?php echo $prompt['id']; ?>">
              <input type="hidden" name="prompt_id" value="<?php echo $prompt['id']; ?>">
              <input type="submit" value="<?php echo $favorited ? 'Unfavorite' : 'Favorite' ?>">
            </form>
          <?php } ?>
        </div>
    </div>
</section>
</body>
</html>