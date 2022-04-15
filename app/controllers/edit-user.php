<?php
session_start();
include("../database/db.php");

if (empty($_SESSION['auth'])) {
    header('Location: ../../index.php');
} else if ($_SESSION['auth']['type'] != 'admin') {
    header('Location: ../../admin.php');
}
if (empty($_POST)) {
    header('Location: ../admin/view-all-users.php');
}
global $conn;
$path   = $_SERVER['DOCUMENT_ROOT'] . "/assets/img/avatar/";
$now    = date("dmY_Hi");

if (empty($_POST['password'])) {
    $password   = selectOne('users', ['id' => $_POST['id']])['password'];
} else {
    $password   = md5($_POST['password']);
}

$id               = $_POST['id'];
$login            = $_POST['login'];
$email            = $_POST['email'];
$idContract       = $_POST['idContract'];

$surname          = $_POST['surname'];
$firstName        = $_POST['firstName'];
$middleName       = $_POST['middleName'];
$dateOfBirthday   = $_POST['dateOfBirthday'];
$phoneNumber      = $_POST['phoneNumber'];
$gender           = $_POST['gender'];

if ($_FILES['img']['error'] == 0) {
    $img                        = selectOne('users', ['id' => $id])['img'];
    if ($img != "default.jpg") {
        unlink($path . $img);
        copy($_FILES['img']['tmp_name'], $path . $_FILES['img']['name']);
        $pathInfo = pathinfo($_FILES['img']['name']);
        $newNameFile = md5($_FILES['img']['name'] . " " . $now) . "." . $pathInfo['extension'];
        rename($path . $_FILES['img']['name'], $path . $newNameFile);
    }


    $sql                        = "UPDATE `users` SET login = '$login', password = '$password', email = '$email', img = '$newNameFile' WHERE `users`.`id` = '$id'";
} else {
    $sql                        = "UPDATE `users` SET login = '$login', password = '$password', email = '$email' WHERE `users`.`id` = '$id'";
}

$conn->query($sql);
$sql    = "UPDATE `contract` SET surname = '$surname', firstName = '$firstName', middleName = '$middleName', gender = '$gender', phoneNumber = '$phoneNumber', dateOfBirthday = '$dateOfBirthday' WHERE `contract`.`id` = '$idContract'";
$conn->query($sql);
header('Location: ../admin/view-all-users.php');
