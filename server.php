<?php
session_start();

$servername = 'localhost:3307';
$username = 'flyingvespa';
$password = 'password';
$databasename = 'crud';

$db = mysqli_connect($servername, $username, $password, $databasename);


// initialize variables
$name = "";
$task = "";
$date = "";
$id = 0;
$update = false;


// save
if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $task = $_POST['task'];
    $date = $_POST['date'];

    mysqli_query($db, "INSERT INTO info (name, task) VALUES ('$name', '$task')");
    $_SESSION['message'] = "Task saved";
    header('location: index.php');
}

// update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $task = $_POST['task'];
    $date = $_POST['date'];

    mysqli_query($db, "UPDATE info SET name='$name', task='$task' WHERE id=$id");
    $_SESSION['message'] = "Task updated!";
    header('location: index.php');
}

// delete
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    mysqli_query($db, "DELETE FROM info WHERE id=$id");
    $_SESSION['msgd'] =
        "<script>alert('Task Deleted');</script>";;
    header('location: index.php');
}
