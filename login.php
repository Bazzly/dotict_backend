<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<?php session_start(); ?>

    <?php
   include('config/db.php');
// Process the login form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Check if any field is empty
    if (empty($username) || empty($password)) {
        echo "Please fill in both username and password.";
    } else {
        // Validate user credentials
        $validate_sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($validate_sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Password is correct, create a session and redirect to the dashboard
                $_SESSION['username'] = $username;
                header("Location: dashboard.php");
                exit();
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "User not found.";
        }
    }
}

// Close the database connection
$conn->close();
?>

<a href="index.php">Home</a>
    <form action="#" method="post">
        <input type="text" name="username" placeholder="Enter your user name"><br>
        <input type="password" name="password" placeholder="Enter your password"><br>
        <button>Login</button>
    </form>
    <a href="forgot_password.html">Forgot Password</a>
</body>
</html>


<!-- // Check if the username is already registered
            $check_email_sql = "SELECT * FROM users WHERE username = '$username'";
            $result = $conn->query($check_email_sql);

            var_dump($result->num_rows < 0);
    
            if ($result->num_rows > 0) {
               
              echo "sdf";
                $check_user = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
                $result = $conn->query($check_user);

                $user = $result;
              
                while ($row = mysqli_fetch_array($user)) {

                    $user_id = $row['id'];
                    $user_name = $row['username'];
                    $user_email = $row['email'];
                    $user_password = $row['password'];
                  }
                  if ($user_email == $email  &&  $user_password == $password) {
                
                    $_SESSION['id'] = $user_id;       // Storing the value in session
                    $_SESSION['name'] = $user_name;   // Storing the value in session
                    $_SESSION['email'] = $user_email; // Storing the value in session
                    //! Session data can be hijacked. Never store personal data such as password, security pin, credit card numbers other important data in $_SESSION
                    header('location: dashboard.php?user_id=' . $user_id);
                  } else {
                    echo 'Incorrect password';
                    header('location: login.php');
                  }
            } else { -->
             