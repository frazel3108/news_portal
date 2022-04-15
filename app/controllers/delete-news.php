<?php
session_start();
include("../database/db.php");
if (empty($_SESSION['auth'])) {
    header('Location: ../../index.php');
} else if ($_SESSION['auth']['type'] != 'admin') {
    header('Location: ../../admin.php');
}
if (empty($_GET['id'])) {
    header('Location: ../../admin.php');
}

global $conn;

$news   = $_GET['id'];
$path   = $_SERVER['DOCUMENT_ROOT'] . "/assets/img/news/";

$img = selectOne('news', ['id' => $news])['img'];
if ($img != NULL) {
    unlink($path . $img);
}

$sql    = "DELETE FROM news WHERE id = $news";
$conn->query($sql);

header('Location: ../admin/news-handling.php');



