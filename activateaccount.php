<?php
  namespace MyApp;
  include("classes/MyDb.php");

  $activationcode = (isset($_GET['code'])) ? $_GET['code'] : '';
  $userid = (isset($_GET['userid'])) ? $_GET['userid'] : '';

  $db = new MyDb();

  $db->__construct();
  $query = "SELECT * FROM gebruikers WHERE user_id = ? AND activationcode = ? AND activated = ?";
  $query = $db->prepare($query);
  $query->execute([$userid, $activationcode, 0]);
  $result = $query->fetch();
  
  $resultstring = 'User already actived OR no details given.';
  if ($query->rowCount() > 0) {
    // The query returned results
    
    $query = "UPDATE gebruikers SET activated = 1, activationcode = '' WHERE user_id = ?";
    $query = $db->prepare($query);
    $query->execute([$userid]);
    $resultstring = 'Account activated ' . $result['username'] . ' rerouting you to login page!';
    header("refresh:5; url=login.php");


  } else {
      // Username does not exist!
      $error = true;
  }
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
    <title>Activation in progress...</title>
</head>
<body>

<section>
  <h1 class="activation"><?php echo $resultstring; ?></h1>
  <p></p>
</section>
</body>
</html>