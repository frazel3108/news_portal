<?php
session_start();
include("../database/db.php");

if (empty($_SESSION['auth'])) {
    header('Location: ../../index.php');
}
$m_arr    = array(1 => "Января", 2 => "Февраля", 3 => "Марта", 4 => "Апреля", 5 => "Мая", 6 => "Июня", 7 => "Июля", 8 => "Августа", 9 => "Сентября", 10 => "Октября", 11 => "Ноября", 12 => "Декабря");
$page     = $_GET['page'] ?? 1;
?>

<!doctype html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <link rel="stylesheet" href="https://material.io/components/text-fields/web#using-text-fields">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <link rel="stylesheet" href="../../assets/css/adminstyle.css">
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
                            <h2>Добавить Категорию</h2>
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
                                        <a href="#">Новости</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Добавить Категорию
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-elements-wrapper">
                <form action="../controllers/add-category.php" method="post">
                    <div class="row">
                        <div class="col-lg-9 mb-3">
                            <div class="card-style mb-30">
                                <h6 class="mb-25">Добавление Категории</h6>
                                <div class="input-style-1">
                                    <label>Наименование категории</label>
                                    <input type="text" name="category_name" placeholder="Наименование категории" aria-describedby="categoryNameHelpBlock">
                                    <div id="categoryNameHelpBlock" class="form-text">
                                        Убедитесь что вашей категории нет в списке справа
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Добавить</button>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card-style mb-30">
                                <h6 class="mb-3">Просмот категорий</h6>
                                <?php
                                $categoryALL = selectAll('category', NULL, [], null, 'id', false);
                                for ($i = 0; $i < count($categoryALL); $i++) { ?>
                                    <a class="list-group-item list-group-item-action d-flex gap-3" aria-current="true">
                                        <div class="d-flex gap-2 w-100 justify-content-between">
                                            <div>
                                                <h6 class="mb-0"><?= $categoryALL[$i]['name'] ?></h6>
                                            </div>
                                        </div>
                                    </a>
                                <? } ?>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="../../assets/Js/main.js"></script>
</body>

</html>