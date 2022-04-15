<?php
session_start();
include("../database/db.php");
if (empty($_SESSION['auth'])) {
    header('Location: ../../index.php');
} else if ($_SESSION['auth']['type'] != 'admin') {
    header('Location: ../../admin.php');
}
if (empty($_GET['id'])) {
    header('Location: ../admin/view-all-adv.php');
}

global $conn;

$adv   = $_GET['id'];
$path   = $_SERVER['DOCUMENT_ROOT'] . "/assets/img/advertisement/";

$img = selectOne('advertisement', ['id' => $adv])['img'];
if ($img != NULL) {
    unlink($path . $img);
}

$sql    = "DELETE FROM advertisement WHERE id = $adv";
$conn->query($sql);

header('Location: ../admin/view-all-adv.php');
