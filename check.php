<?php

if (isset($_POST['id'])) {
    require 'server.php';
// Get Id From Post Method
    $id = $_POST['id'];
    if (empty($id)) {
    echo 'error';
    } 
    else 
    {
        // Select Task From Info table 
        $record = mysqli_query($db, "SELECT * FROM info WHERE id=$id");
         $todo = mysqli_fetch_array($record);
       
        $uId = $todo['id'];
        $checked = $todo['checkbox'];
        // Check if checkbox value is  1  change it to 0 but if checkbox value is 0 change it to 1
        if($checked == 0)
        {
            $checked=1;
        }
        else
        {
            $checked=0;
        }
        //Update Task Completed Status
        $res = mysqli_query($db,"UPDATE info SET checkbox=$checked WHERE id=$uId");

        if ($res) {
            echo $checked;
        } else {
            echo "error";
        }
        exit();
    }
}
?>
