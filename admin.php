<?php
session_start();
include("app/database/db.php");

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

    <link rel="stylesheet" href="assets/css/adminstyle.css">
    <script src="assets/Js/jquery-1.11.1.min.js"></script>

    <title>Новости</title>
</head>

<body>
<?php require("app/admin/adminheader.php");
$numRowsNewsI = numRows('news', ['idUsers' => $_SESSION['auth']['id']]);
$sumViews = sumViews($_SESSION['auth']['id']);
if (empty($sumViews['views'])) {
    $sumViews['views'] = 0;
}
$mostPopularNews = selectAll('news', null, ['idUsers' => $_SESSION['auth']['id']], 1, 'views');
if (empty($mostPopularNews)) {
    $mostPopularNews = null;
}
$m_arr = array(1 => "Января", 2 => "Февраля", 3 => "Марта", 4 => "Апреля", 5 => "Мая", 6 => "Июня", 7 => "Июля", 8 => "Августа", 9 => "Сентября", 10 => "Октября", 11 => "Ноября", 12 => "Декабря");
if (empty($_GET['time'])) {
    $lastFive = selectALL('news', null, ['idUsers' => $_SESSION['auth']['id']], 5, null, true);
} else {
    $lastFive = selectAll('news', null, ["DATE_FORMAT(datePublication,'%Y-%m-%d')" => $_GET['time'], 'idUsers' => $_SESSION['auth']['id']], 5, null, true);
}
?>

<section class="section">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title mb-30">
                        <h2>Dashboard</h2>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="breadcrumb-wrapper mb-30">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">
                                    Dashboard
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                    <div class="icon">
                        <i class="bi bi-book"></i>
                    </div>
                    <div class="content">
                        <h6 class="mb-10">Новых новостей за день</h6>
                        <h3 class="text-bold mb-10"><?= numRows('news', ["DATE_FORMAT(datePublication,'%Y-%m-%d')" => date("Y-m-d"), 'idUsers' => $_SESSION['auth']['id']]) ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                    <div class="icon">
                        <i class="bi bi-bar-chart-fill"></i>
                    </div>
                    <div class="content">
                        <h6 class="mb-10">Количество ваших Новостей</h6>
                        <h3 class="text-bold mb-10"><?= $numRowsNewsI ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                    <div class="icon">
                        <i class="bi bi-binoculars"></i>
                    </div>
                    <div class="content">
                        <h6 class="mb-10">Количество просмотров ваших Новостей</h6>
                        <h3 class="text-bold mb-10"><?= $sumViews['views'] ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="icon-card mb-30">
                    <div class="icon">
                        <i class="bi bi-display"></i>
                    </div>
                    <div class="content">
                        <h6 class="mb-10">Самая популярная новость</h6>
                        <a style="line-height: 1; display: inline-flex;" <?php if ($mostPopularNews != null) {
                            echo 'href="news.php?id=' . $mostPopularNews[0]['id'] . '"';
                        } ?>
                           class="mb-0"><?= isset($mostPopularNews) ? $mostPopularNews[0]['title'] : "Отсутствует" ?></a>
                    </div>
                </div>
            </div>
        </div>

        <?php if ($_SESSION['auth']['type'] == 'admin') { ?>
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="icon-card mb-30">
                        <div class="icon">
                            <i class="bi bi-eye"></i>
                        </div>
                        <div class="content">
                            <h6 class="mb-10">Количество новостей в БД</h6>
                            <h3 class="text-bold mb-10"><?= numRows('news') ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-sm-6">
                    <div class="icon-card mb-30">
                        <div class="icon">
                            <i class="bi bi-eye"></i>
                        </div>
                        <div class="content">
                            <h6 class="mb-10">Количество просмотров всех Новостей</h6>
                            <h3 class="text-bold mb-10"><?= sumViews()['views'] ?></h3>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>

        <div class="row">
            <div class="col-lg-12">
                <div class="card-style">
                    <form>
                        <div class="row">
                            <div class="col-9">
                                <?php if (empty($_GET['time'])) { ?>
                                    <h2 style="margin-top:0.25em;">Ваши последнии новости</h2>
                                <?php } else {
                                    $t = strtotime($_GET['time']); ?>
                                    <h2 style="margin-top:0.25em;">Ваши новости
                                        за <?= date("j", $t) . " " . $m_arr[date("n", $t)] . " " . date("Y", $t); ?></h2>
                                <?php } ?>
                            </div>
                            <div class="col-3">
                                <div class="text-end mb-4">
                                    <div class="input-style-1">
                                        <label>Дата</label>
                                        <input name="time" class="datepicker" type="date">
                                        <button type="submit" class="btn btn-primary">Обновить</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                    <div class="table-wrapper table-responsive">
                        <?php
                        if (!empty($lastFive)) { ?>
                            <table class="table table-hover bg-white">
                                <thead>
                                <tr>
                                    <th scope="col">
                                        <h6>Заголовок</h6>
                                    </th>
                                    <th scope="col">
                                        <h6>Дата Публикации</h6>
                                    </th>
                                    <th scope="col">
                                        <h6>Просмотры</h6>
                                    </th>
                                    <th scope="col">
                                        <h6>Категория</h6>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php for ($i = 0; $i < count($lastFive); $i++) {
                                    $cat = selectOne('category', ['id' => $lastFive[$i]['idCategory']]);
                                    $time = strtotime($lastFive[$i]['datePublication']);
                                    ?>
                                    <tr>
                                        <td scope="row" class="min-width">
                                            <div class="lead">
                                                <p>
                                                    <a href="/news.php?id=<?= $lastFive[$i]['id'] ?>"><?= $lastFive[$i]['title'] ?></a>
                                                    <?php if ($lastFive[$i]['mainNews'] == 1) { ?>
                                                        <span class="badge bg-danger">Main</span>
                                                    <?php } ?>
                                                </p>
                                            </div>


                                        </td>
                                        <td class="min-width">
                                            <p><?= date("j", $time) . " " . $m_arr[date("n", $time)] . " " . date("Y", $time) ?></p>
                                        </td>
                                        <td class="min-width ">
                                            <p style="margin-left:2em"><?= $lastFive[$i]['views'] ?></p>
                                        </td>
                                        <td class="min-width">
                                            <p><?= $cat['name'] ?></p>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>

                            </table>
                        <?php } ?>


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
<script src="assets/Js/main.js"></script>
</body>

</html>