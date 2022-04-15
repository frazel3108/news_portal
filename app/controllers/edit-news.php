<?php
session_start();
include("../database/db.php");
if (empty($_SESSION['auth'])) {
    header('Location: ../../index.php');
}
if (empty($_POST)) {
    header('Location: ../admin/view-all-news.php');
}

global $conn;

$title          = $_POST['title'];
$description    = $_POST['description'];
$category       = $_POST['category'];
$id             = $_POST['id'];
$now            = date("dmYHis");
$sql            = "";

$path               = $_SERVER['DOCUMENT_ROOT'] . "/assets/img/news/";

if ($_FILES['img']['error'] != 4) {
    copy($_FILES['img']['tmp_name'], $path . $_FILES['img']['name']);
    $pathInfo = pathinfo($_FILES['img']['name']);
    $newNameFile = md5($_FILES['img']['name'] . " " . $now) . "." . $pathInfo['extension'];
    rename($path . $_FILES['img']['name'], $path . $newNameFile);
    $sql            = "UPDATE `news` SET `title` = '$title', `description` = '$description', 
    `img` = '$newNameFile', `idCategory` = '$category', WHERE `news`.`id` = '$id'";
} else {
    $sql            = "UPDATE `news` SET `title` = '$title', `description` = '$description', 
    `idCategory` = '$category' WHERE `news`.`id` = '$id'";
}

$conn->query($sql);

header('Location: ../../news.php?id='.$id);



