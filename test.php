<?php
    $conn = new mysqli("localhost", "root", "root", "phpendproject");
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
    </div>
<?php endforeach; ?>

</body>
</html>