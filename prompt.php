<?php
    namespace MyApp;
    include("classes/MyDb.php");
    include_once 'header.php';
      
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

    // CHECK IF YOU ARE THE OWNER OF THIS (CREATOR = ID OF USER & $_SESSION['USER_ID'] = ID OF CURRENT USER)
    $isowner = ($creator == $_SESSION['user_id']);

    // CHECK IF YOU ALREADY FAVORITED THIS PROMPT AND IF SO PUT $FAVORITED TO TRUE
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

    // CHECK IF YOU ALREADY BOUGHT THIS PROMPT AND IF SO PUT $SOLD TO TRUE
    if (isset($_SESSION['user_id'])){
      $qry = "SELECT CASE WHEN EXISTS (SELECT * FROM sales WHERE user_id = ? AND id = ?) THEN 'true' ELSE 'false' END";
      $qry = $db->prepare($qry);
      $qry->execute([$_SESSION['user_id'], $_GET['id']]);
  
      $sold = $qry-> fetch()[0];
      if ($sold == 'false'){
        $sold = false;
      } else {
        $sold = true;
      }
    }


    
    $db->close();

?>

<?php 
  // check if the form was submitted TO FAVORITE
  if (!empty($_POST) && isset($_GET['favorite'])) {
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

<?php 
    $errormessage = '';
    $haserror= false;
  // check if the form was submitted TO BUY
  if (!empty($_POST) && isset($_GET['buy']) && $sold == false) {
    // get the prompt name
    $prompt_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];
    // update the prompt in the database
    $db->__construct();
    
    $qry = "SELECT credits FROM gebruikers WHERE user_id = ?";
    $qry = $db->prepare($qry);
    $qry->execute([$user_id]);
    $credits = $qry-> fetch()[0];

    if((int) $credits >= $prompt['cost']){
      $query = "INSERT INTO sales SET user_id = ?, id = ?";
      $query = $db->prepare($query);
      $query->execute([$user_id, $prompt_id]);

      $query = "UPDATE gebruikers SET credits = credits - ? WHERE user_id = ?";
      $query = $db->prepare($query);
      $query->execute([$prompt['cost'], $user_id]);
      $sold= true;

      $query = "UPDATE gebruikers SET credits = credits + ? WHERE user_id = ?";
      $query = $db->prepare($query);
      $query->execute([$prompt['cost'], $prompt['creator']]);
    } else {
      $errormessage = 'You lack funds.';
      $haserror = true;
    }
    
    $db->close();
    //  header("Location: prompt.php?id=" . $prompt["id"]);
  } else {
    if(!empty($_POST) && $sold == true){
      $errormessage = 'You already own this.';
      $haserror = true;
    }
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
    <title>Prompt</title>
</head>
<body>

<section>
  <div id="Prompt1">
      <div>
        <button class="goback" onclick="history.back()">&lt; Go back</button>
        <img src="https://www.humanesociety.org/sites/default/files/2022-08/hl-yp-cats-579652.jpg" alt="cat" id="PromptImg1">
      </div>

      <div id="PromptInformation">
          <h1 class="Titles"><?php echo $prompt['name']; ?></h1>
          <span id="PromptDescrip1"><?php echo $prompt['description']; ?></span>
          <span class="PromptInfo1">creator: &#64;<a onclick="window.location.href='user.php?id=<?php echo $prompt['creator']; ?>'"><?php echo $creator; ?></a></span>
          <span class="PromptInfo1">cost: <?php echo $prompt['cost']; ?></span>
          <span class="PromptInfo1" id="favo">favorites: <?php echo $favorites; ?></span>
          <?php if (isset($_SESSION['username'])) { ?>
            <form method="post" action="prompt.php?favorite=1&id=<?php echo $prompt['id']; ?>">
              <input type="hidden" name="prompt_id" value="<?php echo $prompt['id']; ?>">
              <input type="submit" class="btn" value="<?php echo $favorited ? 'Unfavorite' : 'Favorite' ?>">
            </form>
          
            <form method="post" action="prompt.php?buy=1&id=<?php echo $prompt['id']; ?>">
              <input type="hidden" name="prompt_id" value="<?php echo $prompt['id']; ?>">
              <input type="submit" class="btn" value="<?php echo $sold ? 'Owned' : 'Buy' ?>">
              <?php if (isset($haserror) && $haserror == true): ?>
                <div class="alert"><?php echo $errormessage; ?></div>
              <?php endif; ?>
            </form>
          <?php } ?>
        </div>
  </div>
</section>
</body>
</html>