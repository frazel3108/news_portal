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

$title          = $_POST['title'];
$href    = $_POST['href'];
$id             = $_POST['id'];
$now            = date("d-m-Y_Hi");
$img = selectOne('advertisement', ['id' => $adv])['img'];


$path           = $_SERVER['DOCUMENT_ROOT'] . "/assets/img/advertisement/";



if ($_FILES['img']['error'] != 4) {
    unlink($path . $img);
    copy($_FILES['img']['tmp_name'], $path . $_FILES['img']['name']);
    $pathInfo = pathinfo($_FILES['img']['name']);
    $newNameFile = $title . "_" . $now . "." . $pathInfo['extension'];
    rename($path . $_FILES['img']['name'], $path . $newNameFile);
    $sql            = "UPDATE `advertisement` SET `title` = '$title', `href` = '$href', `img` = '$newNameFile' WHERE `advertisement`.`id` = '$id'";
} else {
    $sql            = "UPDATE `advertisement` SET `title` = '$title', `href` = '$href' WHERE `advertisement`.`id` = '$id'";
}

$conn->query($sql);

header('Location: ../admin/view-all-adv.php');
