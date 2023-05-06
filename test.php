<?php
    //self::$conn = new PDO('mysql:host=' . $config['db_host'] . ';dbname=' . $config['db_name'], $config['db_user'], $config['db_password']);
    include_once(__DIR__ . "/classes/Db.php");
    $conn = Db::getInstance();
    $users = $conn->query("SELECT * FROM users");

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test </title>
</head>
<body>
    
<?php foreach($users as $user): ?>
    <div>
        <p><?php echo $user['email']; ?></p>
        <p><?php echo $user['username']; ?></p>
        <p><?php echo $user['firstname']; ?></p>
        <p><?php echo $user['password']; ?></p>
    </div>
<?php endforeach; ?>

</body>
</html>