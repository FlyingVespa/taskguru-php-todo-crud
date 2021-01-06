<?php require 'server.php' ?>

<?php
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($db, "SELECT * FROM info WHERE id=$id");
    if (count($record) == 1) {
        $n = mysqli_fetch_array($record);
        $name = $n['name'];
        $task = $n['task'];
        $date = $n['date'];
    }
}
?>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>CRUD</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="header.css">
</head>

<body>
    <?php $results = mysqli_query($db, "SELECT * FROM info"); ?>
    <div class="wrapper">
        <h1>TaskGuru</h1>
        <div class="wrapper">
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
                        <button class="btn-update" type="submit" name="update" style="background: #556B2F;">Update</button>
                    <?php else : ?>
                        <button class="btn-add" type="submit" name="save">Add Task</button>
                    <?php endif ?>
                </div>
            </form>
        </div>
        <?php if (isset($_SESSION['message'])) : ?>
            <div class="msg">
                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>
            </div>
        <?php endif ?>
        <?php if (isset($_SESSION['msgd'])) : ?>
            <div class="msgd" onclick="removeMsg()">
                <?php
                echo $_SESSION['msgd'];
                unset($_SESSION['msgd']);
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
                    <span id="input-task"> <?php echo $row['date']; ?></span>
                </div>

                <div class="button1">
                    <a href="index.php?edit=<?php echo $row['id']; ?>" class="edit_btn"><i class="fa fa-edit fa-2x"></i></a>
                </div>
                <div class="button2">
                    <a href="server.php?del=<?php echo $row['id']; ?>" class="del_btn fa fa-trash fa-2x"></a>
                </div>
            </div>
        <?php } ?>
    </div>
</body>

<button id="top">Back To Top</button>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script>
    //scroll fucntion
    $(window).scroll(function() {
        let position = $(window).scrollTop();

        if (position >= 250) {
            $('#top').addClass('show');
        } else {
            $('#top').removeClass('show');
        }

    });
    $('#top').click(function() {
        $('html, body').animate({
            scrollTop: 0
        }, 800);
    });
</script>


</html>