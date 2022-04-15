<?php
session_start();
include("../database/db.php");

if (empty($_SESSION['auth'])) {
    header('Location: ../../index.php');
} else if ($_SESSION['auth']['type'] != 'admin') {
    header('Location: ../../admin.php');
}

if (empty($_GET['id'])) {
    header("Location: view-all-adv.php");
}

$idAdv = $_GET['id'];
$adv = selectOne('advertisement', ['id' => $idAdv]);
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

    <link rel="stylesheet" href="../../assets/css/adminstyle.css">
    <script src="/assets/Js/jquery-1.11.1.min.js"></script>

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
                        <h2>Добавить рекламное объявление</h2>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="breadcrumb-wrapper mb-30">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="../../admin.php">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="#">Реклама</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Добавить рекламное объявление
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-elements-wrapper">
            <form action="/app/controllers/edit-adv.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $_GET['id'] ?>"/>
                <div class="row">
                    <div class="col-lg-12 mb-3">
                        <div class="card-style mb-30">
                            <h6 class="mb-25">Добавление рекламного объявления</h6>
                            <div class="row">
                                <div class="col">
                                    <div class="input-style-1">
                                        <label>Наименование</label>
                                        <input type="text" name="title" placeholder="Наименование рекламы"
                                               aria-describedby="title" value="<?= $adv['title'] ?>">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="input-style-1">
                                        <label>Наименование</label>
                                        <input type="text" name="href" placeholder="Ссылка" aria-describedby="href"
                                               value="<?= $adv['href'] ?>">
                                    </div>
                                </div>
                                <div class="input-style-1">
                                    <label>Изображение</label>
                                    <p class="mb-2"><img class="rounded mx-auto d-block img-thumbnail"
                                                         src="../../assets/img/advertisement/<?= $adv['img'] ?>" alt="">
                                    </p>
                                    <input class="form-control" type="file" name="img" id="img" require>
                                    <div id="img" class="form-text">
                                        Убедитесь, что размер изображения соответствует 1:2 (250x500 - самое
                                        оптимальное)
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Изменить</button>
                        </div>
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
<script src="../../assets/Js/main.js"></script>
</body>

</html>