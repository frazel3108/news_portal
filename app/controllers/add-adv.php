<?php
session_start();
include("../database/db.php");
if (empty($_SESSION['auth'])) {
    header('Location: ../../index.php');
} else if ($_SESSION['auth']['type'] != 'admin') {
    header('Location: ../../admin.php');
}
if (empty($_POST)) {
    header('Location: ../admin/addNews.php');
}

global $conn;

$path           = $_SERVER['DOCUMENT_ROOT'] . "/assets/img/advertisement/";
$now            = date('d-m-Y_Hi');

$title          = $_POST['title'];
$used = 0;

copy($_FILES['img']['tmp_name'], $path . $_FILES['img']['name']);
$pathInfo = pathinfo($_FILES['img']['name']);
$newNameFile = md5($title . " " . $now) . "." . $pathInfo['extension'];
rename($path . $_FILES['img']['name'], $path . $newNameFile);

$stmt           = $conn->prepare("INSERT INTO advertisement (title, href, img, used) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sssi", $title, $_POST['href'], $newNameFile, $used);

$stmt->execute();
header('Location: ../../admin.php');
