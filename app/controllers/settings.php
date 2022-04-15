<?php
session_start();
include("../database/db.php");
if (empty($_SESSION['auth'])) {
    header('Location: ../../index.php');
}
if (empty($_POST)) {
    header('Location: ../admin/settings.php');
}

global $conn;
$path           = $_SERVER['DOCUMENT_ROOT'] . "/assets/img/avatar/";
$now            = date("dmYHis");

$id             = $_SESSION['auth']['id'];
$login          = $_POST['login'];
$password       = $_POST['password'];

if (empty($password)) {
    $password   = $_SESSION['auth']['password'];
} else {
    $password   = md5($password);
}

$email          = $_POST['email'];

$surname        = $_POST['surname'];
$firstName      = $_POST['firstName'];
$middleName     = $_POST['middleName'];
$dateOfBirthday = $_POST['dateOfBirthday'];
$phoneNumber    = $_POST['phoneNumber'];
$gender         = $_POST['gender'];

if ($_FILES['img']['error'] == 0) {
    $img                        = selectOne('users', ['id' => $id])['img'];
    if ($img != "default.jpg") {
        unlink($path . $img);
        copy($_FILES['img']['tmp_name'], $path . $_FILES['img']['name']);
        $pathInfo = pathinfo($_FILES['img']['name']);
        $newNameFile = md5($_FILES['img']['name'] . " " . $now) . "." . $pathInfo['extension'];
        rename($path . $_FILES['img']['name'], $path . $newNameFile);
    }

    $sql_users                  = "UPDATE `users` SET login = '$login', password = '$password', email = '$email', img = '$newNameFile' WHERE `users`.`id` = '$id'";
    $_SESSION['auth']['img']    = $newNameFile;
} else {
    $sql_users                  = "UPDATE `users` SET login = '$login', password = '$password', email = '$email' WHERE `users`.`id` = '$id'";
}
$conn->query($sql_users);

$id     = $_SESSION['auth']['idContract'];
$sql_contract    = "UPDATE `contract` SET surname = '$surname', firstName = '$firstName', middleName = '$middleName', gender = '$gender', phoneNumber = '$phoneNumber', dateOfBirthday = '$dateOfBirthday' WHERE `contract`.`id` = '$id'";
$conn->query($sql_contract);

$_SESSION['auth']['login']                    = $login;
$_SESSION['auth']['password']                 = $password;
$_SESSION['auth']['email']                    = $email;

$_SESSION['auth']['data']['surname']          = $surname;
$_SESSION['auth']['data']['firstName']        = $firstName;
$_SESSION['auth']['data']['middleName']       = $middleName;
$_SESSION['auth']['data']['dateOfBirthday']   = $dateOfBirthday;
$_SESSION['auth']['data']['phoneNumber']      = $phoneNumber;
$_SESSION['auth']['data']['gender']           = $gender;

header('Location: ../admin/profile.php');






