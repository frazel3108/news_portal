<?php
session_start();
include("../database/db.php");

if (empty($_SESSION['auth'])) {
    header('Location: ../../index.php');
}

if ($_SESSION['auth']['type'] == 'admin') {
    $fio = "Администратор";
    $contractNumber = "0";
    $accessLevel = "Администратор";
    $email = "example@mail.ru";
    $birthDate = "xx.xx.xxxx";
    $gender = "Мужской";
    $phoneNumber = "+7 (XXX) XXX XX-XX";
} else {
    $fio = $_SESSION['auth']['data']['firstName'] . " " . $_SESSION['auth']['data']['middleName'] . " " . $_SESSION['auth']['data']['surname'];
    $contractNumber = $_SESSION['auth']['idContract'];
    if ($_SESSION['auth']['type'] == 'editor') {
        $accessLevel = "Редактор";
    } else {
        $accessLevel = $_SESSION['auth']['type'];
    }
    $email = $_SESSION['auth']['email'];
    $birthDate = date("j.m.Y", strtotime($_SESSION['auth']['data']['dateOfBirthday']));
    $gender = $_SESSION['auth']['data']['gender'];
    $phoneNumber = $_SESSION['auth']['data']['phoneNumber'];
}


?>

<!doctype html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <link rel="stylesheet" href="https://material.io/components/text-fields/web#using-text-fields">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700&display=swap"
          rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <link rel="stylesheet" href="/assets/css/adminstyle.css">
    <script src="assets/js/jquery-1.11.1.min.js"></script>

    <title>Новости</title>
</head>

<body>
<?php require("adminheader.php"); ?>
<section class="section">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title mb-30">
                        <h2>Просмотр профиля</h2>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="breadcrumb-wrapper mb-30">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="#">Профиль</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Просмотр профиля
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="card-style">
                    <div class="lead">
                        <div class="image">
                            <img src="/assets/img/avatar/<?= $_SESSION['auth']['img'] ?>" alt="">
                        </div>
                        <span><?= $fio ?></span>
                    </div>
                    <div class="container">
                        <div class="row" style="margin-top:2em;">
                            <div class="col-8">
                                <h4>Номер Контракта</h4>
                            </div>
                            <div class="col-4 text-end">
                                <p><?= $contractNumber ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <h4>Уровень Доступа</h4>
                            </div>
                            <div class="col-4 text-end">
                                <p><?= $accessLevel ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <h4>E-mail</h4>
                            </div>
                            <div class="col-4 text-end">
                                <p><?= $email ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card-style">
                    <h2>Личные данные</h2>
                    <div class="container">
                        <div class="row">
                            <div class="col-8">
                                <h5>Дата Рождения</h5>
                            </div>
                            <div class="col-4 text-end">
                                <p><?= $birthDate ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <h5>Пол</h5>
                            </div>
                            <div class="col-4 text-end">
                                <p><?= $gender ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-7">
                                <h5>Номер телефона</h5>
                            </div>
                            <div class="col-5 text-end">
                                <p><?= $phoneNumber ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
        crossorigin="anonymous"></script>
<script src="../../assets/Js/main.js"></script>
</body>

</html>