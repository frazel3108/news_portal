<?php
session_start();
include("../database/db.php");
if (empty($_SESSION['auth'])) {
    header('Location: ../../index.php');
} else if ($_SESSION['auth']['type'] != 'admin') {
    header('Location: ../../admin.php');
}
if (empty($_POST)) {
    header('Location: ../admin/add-contract.php');
}

global $conn;

$surname          = $_POST['surname'];
$firstName        = $_POST['firstName'];
$middleName       = $_POST['middleName'];
$dateOfBirthday   = $_POST['dateOfBirthday'];
$phoneNumber      = $_POST['phoneNumber'];
$gender           = $_POST['gender'];

$stmt = $conn->prepare("INSERT INTO contract (surname, firstName, middleName, gender, phoneNumber, dateOfBirthday) 
VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $surname, $firstName, $middleName, $gender, $phoneNumber, $dateOfBirthday);
$stmt->execute();

header('Location: ../admin/view-all-contracts.php');
