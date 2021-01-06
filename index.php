<?php require 'server.php'; ?>

<?php

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($db, "SELECT * FROM info WHERE id=$id");

    if (isset($_POST['edit'])) {
        $n = mysqli_fetch_array($record);
        $name = $n['name'];
        $task = $n['task'];
        $date = $n['date'];
        if (!$n) {
            die("Failed");
        } else {
            header("Location:index.php?edited");
        }
    }
}
?>
<html>

<head>
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>TaskGuru</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="shortcut icon" href="clipboards.svg" image/x-icon">
</head>
<header>
    <div class="middle">
        <div class="social">
            <a class="btn" href=" mailto:mailhedri@gmail.com"><i class="fa fa-at"></i></a>
            <a class="btn" href="https://twitter.com/he3nel"><i class="fa fa-twitter"></i></a>
            <a class="btn" href="https://www.linkedin.com/in/hedrinel/"><i class="fa fa-linkedin"></i></a>
            <a class="btn" href="https://www.instagram.com/hedrinel/?hl=en"><i class="fa fa-instagram"></i></a>
            <a class="btn" href="https://github.com/FlyingVespa"><i class="fa fa-github"></i></a>
        </div>
        <a class="btn" onclick="myFunction()"><i class="fa fa-eye-slash"></i></a>
    </div>
</header>

<body>
    <?php $results = mysqli_query($db, "SELECT * FROM info"); ?>
    <div class="wrapper">
        <h1>TASKGURU</h1>
        <hr>
        <h4>by Helena Nel</h4>
        <form method="post" action="server.php">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="inputFields">
                <span>Task</span>
                <br>
                <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Enter details here (35 characters max)" maxlength="35" required>
            </div>
            <div class="input-group">
                <span>Task Details</span>
                <br>
                <textarea type="text" name="task" value="<?php echo $task; ?>" placeholder="Enter details here (100 characters max)" maxlength="100" required></textarea>
            </div>
            <div class="input-group">
                <?php if ($update == true) : ?>
                    <button class="btn-update" type="submit" name="update">Update</button>
                    <button class="btn" type="cancel" href="index.php">Update</button>
                <?php else : ?>
                    <button class="btn-add" type="submit" name="save">Add Task</button>
                <?php endif ?>
            </div>
        </form>
        <?php if (isset($_SESSION['msgupdate'])) : ?>
            <div class="msg">
                <?php
                echo $_SESSION['msgupdate'];
                unset($_SESSION['msgupdate']);
                ?>
            </div>
        <?php endif ?>
        <?php while ($row = mysqli_fetch_array($results)) { ?>
            <div class="container">
                <div class="input">
                    <span id="input-name"><?php echo $row['name']; ?></span>
                    <br>
                    <span id="input-task"> <?php echo $row['task']; ?></span>
                    <br>
                    <span id="input-date"> <?php echo $row['date']; ?></span>
                </div>
                <div class="button1">
                    <a href="index.php?edit=<?php echo $row['id']; ?>" class="edit_btn">
                        <i class="fa fa-edit fa-2x"></i></a>
                </div>
                <div class="button2">
                    <a href="server.php?del=<?php echo $row['id']; ?>" class="del_btn fa fa-trash fa-2x" onclick="return confirm('Are you sure you want to delete this item?')" ;></a>
                </div>
            </div>
        <?php } ?>
    </div>
</body>
<footer>
    <button id="top">Back To Top</button>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="main.js"></script>
<script>
    function myFunction() {
        var x = document.querySelector(".social");
        if (x.style.display === "block") {
            x.style.display = "none";
        } else {
            x.style.display = "block";
        }
    }
</script>

</html>