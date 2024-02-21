<?php
include('config/session.php');
include('config/db.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Todo list</title>
</head>
<body>
    <h2>Hello, <?php echo $_SESSION['data']['username']; ?> 
    <hr>
    Create,Read,Update and Delete your todo activities!</h2>
<a href="createTodo.php"> Add todo</a>
    <table>
        <thead>
<th>
    <tr>
        <th>S/N</th>
        <th>Name</th>
        <th>Time</th>
        <th>Completed</th>
        <th>Actions</th>
    </tr>
</th>
        </thead>
        <tbody>
        <?php
$todoLists = [];
$id = $_SESSION['data']['id'];
$getTodoLists = "SELECT * FROM `todo` WHERE user_id = '$id'";
$results = $conn->query($getTodoLists);

while ($todoList =  $results->fetch_assoc())
{
    $todoLists[] = $todoList;
}
// var_dump($todoLists);
// exit();

foreach ($todoLists as $key => $todoList)
    {
?>
    <tr>
    <td><?php echo $key+1; ?></td>
        <td><?php echo $todoList['name']; ?></td>
        <td><?php echo $todoList['time']; ?></td>
        <td><a href="#">Mark</a><br></td>
        <td>
            <a href="#">Edit</a><br>
     
            <a href="#">Delete</a><br>
        </td>
    </tr>
<?php
    }
?>


    <!-- <tr>
        <td>1</td>
        <td>Wash my cloth</td>
        <td>2:40pm</td>
        <td><a href="#">Mark</a><br></td>
        <td>
            <a href="#">Edit</a><br>
     
            <a href="#">Delete</a><br>
        </td>
    </tr> -->

        </tbody>
    </table>
    <i>
<?php
if(empty($todoLists)){
    echo "Todo list is empty ";
}
?>
</i>
    <p></p>
    <a href="logout.php">Logout</a>
    <br>
    <a href="profile_update.php">update</a>
    <br>
    <a href="todo.php">View todo</a>
    <!-- <?php echo $_SESSION['data']['id']; ?> -->
</body>
</html>