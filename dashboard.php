<?php
include('config/session.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['data']['username']; ?>!</h2>
    <p>This is your dashboard. your id is <?php echo $_SESSION['data']['id']; ?></p>
    <a href="logout.php">Logout</a>
    <br>
    <a href="profile_update.php">update</a>
</body>
</html>