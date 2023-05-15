<?php
    namespace MyApp;
    include("classes/MyDb.php");
    include_once 'header.php';

    if (isset($_SESSION['username']) && $_SESSION['role'] === 'admin' ){
      $db = new MyDb();

      $db->__construct();
      $query = "SELECT * FROM prompts WHERE approved = ?";
      $query = $db->prepare($query);
      $query->execute([0]);
      $db->close();
  
      $prompts = $query->fetchAll();
        //header("Location: index.php");
    }
    else{
        //echo "You are not logged in";
      header("Location: login.php");
    }

?>
<?php
  // check if the form was submitted
  if (!empty($_POST)) {
    // get the prompt name
    $prompt_id = $_POST['prompt_id'];

    // update the prompt in the database
    $db->__construct();

    $query = "UPDATE prompts SET approved = 1 WHERE id = '$prompt_id'";
    $query = $db->prepare($query);
    $query->execute();
    $db->close();
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
    <title>Admin prompts</title>
</head>
<body>

<section>
  <a id="home" href="homepage.php">home</a>
    <div>
        <h1 class="homepageTitle">Not approved prompts</h1>
        
        <div class="hottestPrompts">
          <?php foreach ($prompts as $prompt) { ?>
            
            <div style="display: flex;flex-direction: column;">

              <span><?php echo $prompt['name']; ?></span>
              <img src="https://www.humanesociety.org/sites/default/files/2022-08/hl-yp-cats-579652.jpg" alt="cat" class="promptsImage">
              <span><?php echo $prompt['description']; ?></span>
                  <form method="post" action="admin-prompts.php">
                    <input type="hidden" name="prompt_id" value="<?php echo $prompt['id']; ?>">
                    <input type="submit" value="Approve">
                  </form>
            </div>
          <?php } ?>
        </div>
    </div>
</section>
</body>
</html>