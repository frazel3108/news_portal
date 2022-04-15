<?php
session_start();
include("../database/db.php");
if (empty($_SESSION['auth'])) {
    header('Location: ../../index.php');
} else if ($_SESSION['auth']['type'] != 'admin') {
    header('Location: ../../admin.php');
}
if (empty($_POST)) {
    header('Location: ../admin/view-all-adv.php');
}

global $conn;
$id         = array_keys($_POST['used'])[0];
if ($_POST['used'][$id] == 'on') {
    $sql    = "UPDATE `advertisement` SET `used` = '1' WHERE `advertisement`.`id` = $id";
} else if ($_POST['used'][$id] == 0) {
    $sql    = "UPDATE `advertisement` SET `used` = '0' WHERE `advertisement`.`id` = $id";
}

$conn->query($sql);
header('Location: ../admin/view-all-adv.php');
