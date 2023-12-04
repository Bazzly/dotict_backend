<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <a href="index.php">Home</a>
<form method="post" action="#" >
        <input type="text" name="username" placeholder="Enter your user name" ><br>
        <input type="email" name="email" placeholder="Enter your email" required><br>
        <input type="password" name="password" placeholder="Enter your password" required><br>
        <button>Register</button>
    </form>

    
    <?php
    include('config/db.php');
    // Process the registration form
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve user input
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
    
        // Check if any field is empty
        if (empty($username) || empty($email) || empty($password)) {
            echo "Please fill in all fields.";
        } else {
            // Check if the email is already registered
            $check_email_sql = "SELECT * FROM users WHERE email = '$email'";
            $result = $conn->query($check_email_sql);
    
            if ($result->num_rows > 0) {
                echo "Email is already registered. Please use a diff
                erent email.";
            } else {
                // Hash the password (for security)
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
                // Insert user data into the database
                $insert_sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
    
                if ($conn->query($insert_sql) === TRUE) {
                    echo "Registration successful!";
                } else {
                    echo "Error: " . $insert_sql . "<br>" . $conn->error;
                }
            }
        }
    }
    
    // Close the database connection
    $conn->close();

    // include('config/db.php');
    // $userName = $_POST['userName'];
    // $email = $_POST['email'];
    // $password = $_POST['password'];

    // $data = [
    //     'userName' => $userName,
    //     'email' => $email,
    //     'password' => $password,
    // ];
    // if($_SERVER['REQUEST_METHOD'] == "POST"){
    //     $userName = $_POST['userName'];
    //     $email = $_POST['email'];
    //     $password = $_POST['password'];
        
    //     echo 'user post data';
    //     exit;
    // }

    // echo 'i am working';
    
    ?>
</body>
</html>