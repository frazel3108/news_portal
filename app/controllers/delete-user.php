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

$user   = $_GET['id'];
$path   = $_SERVER['DOCUMENT_ROOT'] . "/assets/img/avatar/";

$img = selectOne('users', ['id' => $user])['img'];
if ($img != NULL) {
    if ($img != "default.jpg") {
        unlink($path . $img);
    }
}

$sql    = "DELETE FROM users WHERE id = $user";
$conn->query($sql);

header('Location: ../admin/view-all-users.php');
