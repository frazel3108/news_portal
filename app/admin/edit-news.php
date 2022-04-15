<?php
session_start();
include("../database/db.php");

if (empty($_SESSION['auth'])) {
    header('Location: ../../index.php');
}
if (empty($_GET['news'])) {
    header('Location: view-all-news.php');
}
$m_arr = array(1 => "Января", 2 => "Февраля", 3 => "Марта", 4 => "Апреля", 5 => "Мая", 6 => "Июня", 7 => "Июля", 8 => "Августа", 9 => "Сентября", 10 => "Октября", 11 => "Ноября", 12 => "Декабря");
$page = $_GET['page'] ?? 1;
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
    <script src="assets/js/jquery-1.11.1.min.js"></script>

    <title>Новости</title>
</head>

<body>
<?php require("adminheader.php");
$news = selectOne('news', ['id' => $_GET['news']]);
?>

<section class="section">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title mb-30">
                        <h2>Изменение новости: <a class="text-muted"><?= $news['title'] ?></a></h2>
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
                                    Изменение новости
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-elements-wrapper">
            <form action="../controllers/edit-news.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $_GET['news'] ?>"/>
                <div class="row">
                    <div class="card-style mb-30">
                        <h6 class="mb-25">Наполнение</h6>
                        <div class="input-style-1">
                            <label>Заголовок статьи</label>
                            <input type="text" name="title" value='<?= $news['title'] ?>'>
                        </div>
                        <div class="input-style-1">
                            <label>Основной текст статьи</label>
                            <textarea placeholder="Основной текст статьи" name="description"
                                      rows="5"><?= $news['description'] ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Изображение статьи</label>
                            <p class="mb-2"><img class="rounded mx-auto d-block img-thumbnail"
                                                 src="../../assets/img/news/<?= $news['img'] ?>" alt=""></p>
                            <input class="form-control" type="file" name="img" id="formFile">
                        </div>
                        <div class="select-style-1">
                            <label>Category</label>
                            <div class="select-position">
                                <select name="category">
                                    <?php
                                    $categories = selectAll('category');
                                    for ($i = 0; $i < count($categories); $i++) { ?>
                                        <option <?php if ($categories[$i]['id'] == $news['idCategory']) { ?> selected <? } ?>
                                                value="<?= $categories[$i]['id'] ?>"><?= $categories[$i]['name'] ?></option>
                                    <? } ?>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Обновить</button>
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