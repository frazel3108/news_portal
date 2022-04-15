<?php
session_start();
include("../database/db.php");
if (empty($_SESSION['auth'])) {
    header('Location: ../../index.php');
}
if (empty($_POST)) {
    header('Location: ../admin/add-category.php');
}

global $conn;

$stmt = $conn->prepare("INSERT INTO category (name) VALUES (?)");
$stmt->bind_param("s", $_POST['category_name']);

$stmt->execute();

header('Location: ../admin/add-category.php');
