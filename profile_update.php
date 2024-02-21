<?php
include('config/session.php');
include('config/db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update profile - <?php echo $_SESSION['data']['username']; ?></title>
</head>
    <body>

<?php
$id = intval($_SESSION['data']['id']);
// var_dump(intval($id));
$check_id_sql = "SELECT * FROM users WHERE id = '$id'";
$result = $conn->query($check_id_sql);
$data = $result->fetch_assoc();
$username= $data['username'];
$email = $data['email'];
if($_SERVER["REQUEST_METHOD"] == 'POST'){
    $username = trim($_POST['username']);
    $email= trim($_POST['email']);
    
// echo $username.$username;
// exit();
    if(empty($username) || empty($email)){
        echo "empty value";
    }else{
    $checkUserData = "SELECT * FROM users WHERE id = '$id'";
    $result = $conn->query($checkUserData);
    // var_dump($result->num_rows);
    $user = $result->fetch_assoc();
    if($result->num_rows === 1 && $user['username'] != $username ||  $user['email'] != $email ){
//         echo $username.$email;
// exit();
        $updateUserData ="UPDATE `users` SET `username`='$username',`email`='$email' WHERE id = $id";
        mysqli_query($conn, $updateUserData);
        // $checkUpdate = $conn->query($updateUserData);

        echo 'user sucessfully update profile';
        // $insert_sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
    }else{
        echo 'you have not made any changes';
    }
    }
 
}

?>
    <form method="post" action="#" >
        <label>Username</label>
        <input type="text" name="username" placeholder="Enter your user name" value="<?php echo $username; ?>" ><br>
        <label>Email</label>
        <input type="email" name="email" placeholder="Enter your email" value="<?php echo $email; ?>" ><br>
        <button>update profile</button>
    </form>
    <a href="dashboard.php">Dashboard</a>
</body>

</html>