<?php
session_start();
include("../database/db.php");
tt($_POST);

global $conn;

$login        = $_POST['login'];
$password     = $_POST['password'];
$email        = $_POST['email'];
$idContract   = $_POST['numbercontract'];
$count_valid  = validateUser($login, $email, $idContract);

if($count_valid == true) {
    $pass   = md5($password);
    $type   = "editor";
    $img    = "default.jpg";
    $stmt   = $conn->prepare("INSERT INTO users (login, password, email ,idContract, type, img)
        VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiss", $login, $pass, $email, $idContract, $type, $img);
    $stmt->execute();
    header('Location: users.php?login='.$login.'&password='.$pass);
} else {
    header('Location: ../../index.php');
}



