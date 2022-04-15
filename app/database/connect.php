<?php
$conn = new mysqli("localhost", "root", "", "tkp");

if($conn->connect_error){
    die("Ошибка: " . $conn->connect_error);
}

