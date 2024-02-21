<?php
include('config/session.php');
include('config/db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New todo list</title>
</head>
<body>
<h2>Hello, <?php echo $_SESSION['data']['username']; ?> 
    <hr>
    Add activities to your todo list</h2>
    <a href="todo.php">Back to list</a>
<form method="post" action="#" >
        <input hidden type="number" name="user_id" value="<?php echo $_SESSION['data']['id']; ?> " placeholder="Enter your user name" ><br>
        <input type="text" name="name" placeholder="Enter your todo activity name" required><br>
        <input type="datetime-local" name="time" placeholder="Enter date" required><br>
        
        <button>Create</button>
    </form>

    
    <?php
    // Process the registration form
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve user input
        
        $user_id = $_SESSION['data']['id'];
        $name = trim($_POST['name']);
        $time = trim($_POST['time']);
    
        // Check if any field is empty
        if (empty($name) || empty($time)) {
            echo "Please fill in all fields.";
        } else {
            // Check if the email is already registered
            $check_duplicate = "SELECT * FROM todo WHERE name = '$name'";
            $result = $conn->query($check_duplicate);
    
            if ($result->num_rows > 0) {
                echo "todo already exist Please write new one.";
            } else {
              
    
                // Insert user data into the database
                $insert_sql = "INSERT INTO `todo`(`user_id`, `name`, `time`) VALUES ('$user_id','$name',' $time')";
              
    
                if ($conn->query($insert_sql) === TRUE) {
                    echo "todo created successful!";
                } else {
                    echo "Error: " . $insert_sql . "<br>" . $conn->error;
                }
            }
        }
    }
    
    // Close the database connection
    $conn->close();

    ?>
</body>
</html>