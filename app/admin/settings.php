<?php
session_start();
include("../database/db.php");

if (empty($_SESSION['auth'])) {
    header('Location: ../../index.php');
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
                        <h2>Настройки</h2>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="breadcrumb-wrapper mb-30">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/app/admin/profile.php">Профиль</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Настройки
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-elements-wrapper">
            <form action="../controllers/settings.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="card-style mb-30">
                        <div class="row">
                            <div class="<?= $_SESSION['auth']['type'] == 'admin' ? "col-12" : "col-6" ?>">
                                <h6 class="mb-25">Настройки</h6>
                                <div class="input-style-1">
                                    <label>Логин</label>
                                    <input type="text" name="login" value="<?= $_SESSION['auth']['login'] ?>">
                                </div>
                                <div class="input-style-1">
                                    <label>Пароль</label>
                                    <input type="hidden" name="password" value="">
                                    <input type="text" name="password" placeholder="Новый пароль">
                                </div>
                                <div class="input-style-1">
                                    <label>E-mail</label>
                                    <input type="email" name="email" value="<?= $_SESSION['auth']['email'] ?>">
                                </div>
                            </div>
                            <div class="col-6" <?= $_SESSION['auth']['type'] == 'admin' ? 'style="display: none"' : "" ?>>
                                <h6 class="mb-25">Личные данные</h6>
                                <div class="row">
                                    <div class="col">
                                        <div class="input-style-1">
                                            <label>Фамилия</label>
                                            <input type="text" name="surname"
                                                   value="<?= $_SESSION['auth']['data']['surname'] ?>">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="input-style-1">
                                            <label>Имя</label>
                                            <input type="text" name="firstName"
                                                   value="<?= $_SESSION['auth']['data']['firstName'] ?>">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="input-style-1">
                                            <label>Отчество</label>
                                            <input type="text" name="middleName"
                                                   value="<?= $_SESSION['auth']['data']['middleName'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="input-style-1">
                                            <label>Дата Рождения</label>
                                            <input name="dateOfBirthday" class="datepicker" type="date"
                                                   value="<?= $_SESSION['auth']['data']['dateOfBirthday'] ?>">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="input-style-1">
                                            <label>Номер Телефона</label>
                                            <input type="text" name="phoneNumber"
                                                   value="<?= $_SESSION['auth']['data']['phoneNumber'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="select-style-1">
                                    <label>Пол</label>
                                    <div class="select-position">
                                        <select name="gender">
                                            <option <?php if ($_SESSION['auth']['data']['gender'] == "Мужской") {
                                                echo "selected";
                                            } ?> value="Мужской">Мужской
                                            </option>
                                            <option <?php if ($_SESSION['auth']['data']['gender'] == "Женский") {
                                                echo "selected";
                                            } ?>value="Женский">Женский
                                            </option>
                                        </select>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="formFile" class="form-label">Изображение профиля</label>
                            <p class="mb-2"><img class="rounded mx-auto d-block img-thumbnail" style="max-width: 276px;"
                                                 src="../../assets/img/avatar/<?= $_SESSION['auth']['img'] ?>" alt="">
                            </p>
                            <input class="form-control" type="file" name="img" id="formFile">
                        </div>

                        <button type="submit" class="btn btn-primary">Обновить настройки профиля</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</section>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
        crossorigin="anonymous"></script>
<script src="/assets/Js/main.js"></script>
</body>

</html>