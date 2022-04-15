<?php
session_start();
include("../database/db.php");
if (empty($_SESSION['auth'])) {
    header('Location: ../../index.php');
}
if (empty($_POST)) {
    header('Location: ../admin/addNews.php');
}

global $conn;

$path   = $_SERVER['DOCUMENT_ROOT'] . "/assets/img/news/";
$now    = date('Y-m-d H:i');

copy($_FILES['img']['tmp_name'], $path . $_FILES['img']['name']);
$pathInfo = pathinfo($_FILES['img']['name']);
$newNameFile = md5($_FILES['img']['name'] . " " . $now) . "." . $pathInfo['extension'];
rename($path . $_FILES['img']['name'], $path . $newNameFile);

$mainNews   = 0;
$views      = 0;

$stmt       = $conn->prepare("INSERT INTO news (title, description, img, datePublication, mainNews, views, idCategory, idUsers)
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssiiii", $_POST['title'], $_POST['description'], 
$newNameFile, $now, $mainNews, $views, $_POST['category'], $_SESSION['auth']['id']);

$stmt->execute();

header('Location: ../admin/view-all-news.php');



