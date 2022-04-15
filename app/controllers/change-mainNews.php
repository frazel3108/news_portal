<?php
session_start();
include("../database/db.php");
if (empty($_SESSION['auth'])) {
    header('Location: ../../index.php');
} else if ($_SESSION['auth']['type'] != 'admin') {
    header('Location: ../../admin.php');
}
if (empty($_POST)) {
    header('Location: ../admin/news-handling.php');
}

global $conn;
$id         = array_keys($_POST['main'])[0];

if ($_POST['main'][$id] == 'on') {
    $sql    = "UPDATE `news` SET `mainNews` = '1' WHERE `news`.`id` = $id";
} else if ($_POST['main'][$id] == 0) {
    $sql    = "UPDATE `news` SET `mainNews` = '0' WHERE `news`.`id` = $id";
}

$conn->query($sql);
header('Location: ../admin/news-handling.php');

