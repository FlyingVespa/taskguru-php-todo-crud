<?php require 'server.php'; ?>

<?php

//Check Edit 
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $record = mysqli_query($db, "SELECT * FROM info WHERE id=$id");
    //Get Task From Info table to Edit Task
    $get_task_data = mysqli_fetch_array($record);
    $name = $get_task_data['name'];
    $task = $get_task_data['task'];
}

// Getting Search  data from server
if (isset($_POST['search'])) {
    $search = $_POST['search'];
    $results = mysqli_query($db, "SELECT * FROM info WHERE name  LIKE '%" . $search . "%'");
    // $result = mysqli_fetch_array($query);
} else {
    $results = mysqli_query($db, "SELECT * FROM info");
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
    <link rel="stylesheet" href="css/styles.css">
    <link rel="shortcut icon" href="clipboards.svg" type="image/x-icon">
    <link rel="stylesheet" href="css/checkbox.css">
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
        <a class="btn" id="socialBtn"><i class="fa fa-eye-slash"></i></a>
    </div>
</header>

<body>
    <div class="wrapper">
        <a class="title" href=" index.php">
            <h1>TASKGURU</h1>
        </a>
        <hr>
        <h4>by Helena Nel</h4>

        <!-- Search Form for Search Task By Name -->
        <div class="col-md-12 search mb-3">
            <form action="index.php" method="POST">
                <div class="inputFields">
                    <input type="text" placeholder="Search a task by  Name" value="<?php if (isset($search)) echo $search  ?>" name="search" required>
                </div>
                <div class="input-group">
                    <button id="btn-search" type="submit" name="submit" value="Search">Search</button>
                    <?php
                    if (isset($_POST['search'])) {
                        echo "<a href='index.php' id='btn-reset'>Reset</a>";
                    }
                    ?>
                </div>
            </form>
        </div>
        <!-- End Search Form for Search Task By Name -->
        <div class="col-md-12 add-task mb-3">
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
                    <textarea type="text" name="task" placeholder="Enter details here (100 characters max)" maxlength="100" required><?php echo $task; ?></textarea>
                </div>
                <div class="input-group">
                    <?php if ($update == true) : ?>
                        <button class="btn-update" type="submit" name="update">Update</button>
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
                <div class="col-md-12 container">

                    <div class="input">
                        <div class="button1">
                            <a href="index.php?edit=<?php echo $row['id']; ?>" class="edit_btn">
                                <i class="fa fa-edit fa-2x"></i></a>
                        </div>
                        <div class="button2">
                            <a href="server.php?del=<?php echo $row['id']; ?>" class="del_btn fa fa-trash fa-2x" onclick="return confirm('Are you sure you want to delete this item?')" ;></a>
                        </div>
                        <div class="d-flex bd-highlight">
                            <div class="p-2 flex-shrink-1 bd-highlight">
                                <?php if ($row['checkbox']) { ?>
                                    <input class=" checkbox" type="checkbox" data-todo-id="<?php echo $row['id']; ?>" checked />
                                    </td>
                                <?php } else { ?>
                                    <input class="checkbox" type="checkbox" data-todo-id="<?php echo $row['id']; ?>" /></td>
                                <?php } ?>
                            </div>
                            <div class=" d-inline-flex p-2 bd-highlight">
                                <label? id="input-name"><?php echo $row['name']; ?></label?>
                            </div>
                        </div>
                        <div class="d-flex p-2">
                            <span id="input-task"> <?php echo $row['task']; ?></span></td>
                        </div>
                        <div class="d-flex">
                            <label id="input-date"> <?php echo $row['tdate']; ?></label></td>
                        </div>

                    </div>

                </div>
            <?php } ?>
        </div>
</body>
<footer>
    <button id="top">Back To Top</button>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        // checkbox toggle function
        $(".checkbox").click(function(e) {
            //Get Task id from Task Table using checkbox
            const id = $(this).attr('data-todo-id');
            $.post('check.php', {
                    id: id
                },
                (data) => {
                    if (data != 'error') {
                        const h2 = $(this).next();
                        if (data === '1') {
                            h2.removeClass('checked');
                            // If Data Response id 1 means if checkbox is checked this alert will be show 
                            document.querySelector('.alert').textContent = "Task marked as complete";

                        } else {
                            h2.addClass('checked');
                            // If Data Response id 0 means if checkbox is unchecked this alert will be show 
                            alert('Task Marked Uncomplete');
                        }
                        var alertList = document.querySelectorAll('.alert')
                        alertList.forEach(function(alert) {
                            new bootstrap.Alert(alert)
                        })
                    }
                }
            );
        });
        // Toggle Social function
        $("#socialBtn").click(function() {
            $(".social").toggle();
        });
    });
    // Scroll Function 
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

    //loader 
    $('body').append('<div style="" id="loadingDiv"><div class="loader">Loading...</div></div>');
    $(window).on('load', function() {
        setTimeout(removeLoader); //wait for page load.
    });
    function removeLoader() {
        $("#loadingDiv").fadeOut(500, function() {
            // fadeOut complete. Remove the loading div
            $("#loadingDiv").remove(); //makes page more lightweight 
        });
    }
</script>


</html>