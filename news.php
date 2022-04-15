<?php
session_start();
include("app/database/db.php");

if (empty($_GET['id'])) {
    header("Location: index.php");
}

$idNews = intval($_GET['id']);
$news = selectOne('news', ['id' => $idNews]);

if ($news == NULL) {
    header('Location: /index.php');
}

//$_SESSION['visit'][$idNews] == null;
$category = selectOne('category', ['id' => $news['idCategory']])['name'];

if (empty($_SESSION['visit'][$idNews])) {
    $_SESSION['visit'][$idNews] = 1;
    addingViews($idNews);
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
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/Js/jquery-1.11.1.min.js"></script>

    <title>Новости</title>
</head>

<body>
<?php require("app/include/header.php");

?>
<main class="container pt-3">
    <div class="row flex-wrap">
        <div class="col-md-6">
            <article class="blog-post">
                <h1 class="blog-post-title"><?= $news['title']; ?></h1>
                <p class="blog-post-meta"><?= date("d m Y H:i", strtotime($news['datePublication'])) ?> <span
                            class="badge bg-info text-dark"><?= $category ?></span></p>
                <?php if (!empty($news['img'])) { ?>
                    <img class="img-fluid rounded d-block" src="assets/img/news/<?= $news['img']; ?>" alt="">
                <?php } ?>
            </article>
        </div>
        <div class="col-md-3 mt-3 lastNews">
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
                                </div>
                            </div>
                        </a>
                    <?php } ?>

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="bd-example" max-width="250" height="500">
                <?php
                if (!empty(getAdv()['img'])) { ?>
                    <a href="<?= getAdv()['href'] ?>"><img class="img-fluid rounded d-block"
                                                           style=" max-width: 250px; width: 100%;"
                                                           src="assets/img/advertisement/<?= getAdv()['img']; ?>" alt=""></a>
                <?php } else { ?>
                    <svg class="bd-placeholder-img bd-placeholder-img-lg img-fluid" width="250" height="500"
                         xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Responsive image"
                         preserveAspectRatio="xMidYMid slice" focusable="false">
                        <rect width="100%" height="100%" fill="#868e96"></rect>
                        <text x="10%" y="50%" fill="#dee2e6" dy=".3em">Место под вашу рекламу</text>
                    </svg>
                <?php } ?>
            </div>
        </div>
    </div>
    <hr class="featurette-divider">
    <div class="bodyNews">
        <p style=""><?= $news['description']; ?></p>
    </div>
    <hr class="featurette-divider">
    <?php

    $avg = selectAVG('news', 'views', '<=');
    $reed = array_rand($avg, 2);

    ?>
    <div class="b-material-incut-themes-links">
        <p class="title">Читайте также</p>
        <ul style="display:flex">
            <li class="mx-auto"><a href="?id=<?= $avg[$reed[0]]['id'] ?>"><?= $avg[$reed[0]]['title'] ?></a></li>
            <li class="mx-auto"><a href="?id=<?= $avg[$reed[1]]['id'] ?>"><?= $avg[$reed[1]]['title'] ?></a></li>
        </ul>
    </div>
</main>
<?php require("app/include/footer.php"); ?>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
        crossorigin="anonymous"></script>

</html>