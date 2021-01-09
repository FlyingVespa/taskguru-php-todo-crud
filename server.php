<?php
session_start();

$servername = 'localhost:3307';
$username = 'flyingvespa';
$password = 'password';
$databasename = 'crud';

try {
    $db = mysqli_connect($servername, $username, $password, $databasename);
} catch (PDOException $err) {
    die($err->getMessage());
}

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
    $_SESSION['msgupdate'] = "Task Has Been Added";
    header('location: index.php');
}

// update
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $task = $_POST['task'];
    //date Function Get Current date and time in Year-Month-Day Hours:Mintues:Seconds
    $date = date('Y-m-d h:m:s');
    $checkbox = $_POST['checkbox'];

    mysqli_query($db, "UPDATE info SET name='$name', task='$task', tdate='$date' WHERE id=$id");
    $_SESSION['msgupdate'] = "Task <b>$name</b> Has Been Updated!";
    header('location: index.php');
}

// delete
if (isset($_GET['del'])) {
    $id = $_GET['del'];
    mysqli_query($db, "DELETE FROM info WHERE id=$id");
    $_SESSION['msgdelete'] = "Task has been deleted!";
    header('location: index.php');} 

