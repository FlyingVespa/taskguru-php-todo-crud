<?php

if (isset($_POST['id'])) {
require 'server.php';

$id = $_POST['id'];


if (empty($id)) {
echo 'error';
} else {
$todos = $db->prepare("SELECT id, checked FROM info WHERE id=?");
$todos->execute([$id]);

$todo = $todos->fetch();
$uId = $todo['id'];
$checked = $todo['checked'];

$uChecked = $checked ? 0 : 1;

$res = $conn->query("UPDATE info SET checked=$uChecked WHERE id=$uId");

if ($res) {
echo $checked;
} else {
echo "error";
}
$conn = null;
exit();
}