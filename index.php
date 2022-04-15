<?php
session_start();
include("app/database/db.php");
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
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/Js/jquery-1.11.1.min.js"></script>

    <title>Новости</title>
</head>

<body>
<?php require("app/include/header.php"); ?>
<main class="container" style="padding-top: 1rem; max-width: 80%">

    <?php
    $threeNews = selectAll('news', NULL, ['mainNews' => 1], 3, null, true);
    ?>


    <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">

        <div class="col-lg-8 px-0">
            <h1 class="display-4 fst-italic"><?= $threeNews[0]['title'] ?></h1>
            <p class="lead my-3"><?= substr($threeNews[0]['description'], 0, strpos($threeNews[0]['description'], '.')) ?></p>
            <p class="lead mb-0"><a href="news.php?id=<?= $threeNews[0]['id'] ?>" class="text-white fw-bold">Читать
                    далее...</a></p>
        </div>
    </div>

    <div class="row align-items-md-stretch">
        <?php for ($i = 0; $i < count($threeNews) - 1; $i++) { ?>
            <div class="col-md-6 mb-4">
                <div class="h-100 p-5 bg-light border rounded-3">
                    <h2><?= $threeNews[$i + 1]['title'] ?></h2>
                    <p><?= substr($threeNews[$i + 1]['description'], 0, strpos($threeNews[$i + 1]['description'], '.')) ?>
                        .</p>
                    <p class="lead mb-0"><a href="news.php?id=<?= $threeNews[$i + 1]['id'] ?>" class="fw-bold">Читать
                            далее...</a></p>
                </div>
            </div>
        <?php } ?>
    </div>

    <div class="mainNews row g-5">
        <div class="col-md-9">
            <?php
            $category = selectAll('category', NULL, [], null, 'id');
            for ($i = 0; $i < count($category); $i++) {
                $data = selectAll('news', NULL, ['idCategory' => $category[$i]['id'], 'mainNews' => 0],
                    3, false, true);
                if (!empty($data)) {
                    ?>
                    <h2 class="featurette-heading"><?= $category[$i]['name'] ?></h2>
                    <div class="row row-cols-1 row-cols-lg-3 align-items-stretch g-4">
                        <?php
                        for ($j = 0; $j < count($data); $j++) { ?>
                            <div class="col">
                                <a href="news.php?id=<?= $data[$j]['id'] ?>">
                                    <div class="card card-cover h-100 text-white bg-dark rounded-5 shadow-lg"
                                         style="background-image: url('assets/img/news/<?= $data[$j]['img'] ?>');">
                                        <div class="d-flex flex-column h-100 p-news text-white text-shadow-1">
                                            <h2 class=" lh-1 fw-bold"><?= $data[$j]['title'] ?></h2>
                                            <ul class="d-flex list-unstyled mt-auto">

                                                <li class="d-flex align-items-center">
                                                    <small class="opacity-80"><?= $data[$j]['datePublication'] ?></small>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                    <hr>
                <?php }
            } ?>
        </div>
        <div class="col-md-3">
            <div class="col">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header py-3 text-center">
                        <h4 class="my-0 fw-normal">Последнии новости</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        $lastNews = selectAll('news', NULL, [], 3, null, true);
                        for ($i = 0; $i < count($lastNews); $i++) { ?>
                            <a href="news.php?id=<?= $lastNews[$i]['id'] ?>"
                               class="list-group-item list-group-item-action d-flex gap-3 py-3" aria-current="true">
                                <div class="d-flex gap-2 w-100 justify-content-between">
                                    <div>
                                        <h6 class="mb-0"><?= $lastNews[$i]['title'] ?></h6>
                                        <p class="mb-0 opacity-75"><?= substr($lastNews[$i]['description'],
                                                0, strpos($lastNews[$i]['description'], '.')) ?></p>
                                    </div>
                                </div>
                            </a>
                        <?php } ?>

                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header py-3 text-center">
                        <h4 class="my-0 fw-normal">Категории</h4>
                    </div>
                    <div class="card-body">
                        <?php
                        $categoryALL = selectAll('category', NULL, [], null, 'id', false);
                        for ($i = 0; $i < count($categoryALL); $i++) { ?>
                            <a href="#" class="list-group-item list-group-item-action d-flex gap-3 py-3"
                               aria-current="true">
                                <div class="d-flex gap-2 w-100 justify-content-between">
                                    <div>
                                        <h6 class="mb-0"><?= $categoryALL[$i]['name'] ?></h6>
                                    </div>
                                </div>
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require("app/include/footer.php"); ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
        crossorigin="anonymous"></script>

</html>