<?php
    namespace MyApp;
    include_once(__DIR__ . "/classes/Prompt.php");
    include("classes/MyDb.php");
    session_start();
    if (isset($_SESSION['username'])){
      
    $db = new MyDb();

    $db->__construct();
    $query = "SELECT * FROM prompts WHERE id = ? and creator = ?";
    $query = $db->prepare($query);
    $query->execute([$_GET['id'], $_SESSION['user_id']]);
    $db->close();

    $result = $query->fetch();
    if ($_SESSION['user_id'] === $result['creator']) {
      $prompt = $result;
    } else {
      header("Location: my-prompt.php");
    }
    }else{
        //echo "You are not logged in";
      header("Location: login.php");
    }


?>
<?php
  // check if the form was submitted
  if (!empty($_POST)) {
    // get the prompt name
    $prompt_id = $_GET['id'];
    $prompt_name = $_POST['prompt_name'];
    $prompt_description = $_POST['prompt_description'];
    $prompt_date = $_POST['prompt_date'];
    $prompt_cost = $_POST['prompt_cost'];
    // update the prompt in the database
    $db->__construct();
    $query = "UPDATE prompts SET name = ?, description = ?, date = ?, cost = ?, approved = 0 WHERE id = ?";
    $query = $db->prepare($query);
    $query->execute([$prompt_name, $prompt_description, $prompt_date, $prompt_cost, $prompt_id]);
    $db->close();
    $succes ="Prompt updated succesfully";
    header("Location: my-prompt.php");
  }
?>
<!DOCTYPE html>
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

<header>
 <!---include once moet hier komen -->

</header>
<a id="home" href="my-prompt.php">my prompts</a>

<div id="logSign">
    <?php if(isset($succes)): ?>
        <div class="succes"><?php echo $succes; ?></div>
    <?php endif; ?>

    <form action="edit-prompt.php?id=<?php echo $prompt['id']; ?>" method="POST">
      <input type="hidden" name="id" value="<?php echo $prompt['id']; ?>">
      <label>Name:</label>
      <input type="text" name="prompt_name" value="<?php echo $prompt['name']; ?>">
      <label>Description:</label>
      <textarea name="prompt_description"><?php echo $prompt['description']; ?></textarea>
      <label>Date:</label>
      <input type="date" name="prompt_date" value="<?php echo $prompt['date']; ?>">
      <label>Cost:</label>
      <input type="text" name="prompt_cost" value="<?php echo $prompt['cost']; ?>">
      <input type="submit" value="Save">
    </form>
</div>
</body>
</html>