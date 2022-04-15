<?php
session_start();
include("../database/db.php");

if (empty($_SESSION['auth'])) {
    header('Location: ../../index.php');
} else if ($_SESSION['auth']['type'] != 'admin') {
    header('Location: ../../admin.php');
}
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
    <script src="../../assets/js/jquery-1.11.1.min.js"></script>

    <title>Новости</title>
</head>

<body>
<?php require("adminheader.php");
$limit = 10;
$offset = $limit * ($page - 1);
$total_page = ceil(numRows('contract') / $limit);
$allContracts = selectALL('contract', null, [], $limit, "id", null, $offset);

?>

<section class="section">
    <div class="container-fluid">
        <div class="title-wrapper pt-30">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="title mb-30">
                        <h2>Просмотр всех контрактов</h2>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="breadcrumb-wrapper mb-30">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="/admin.php">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="#">Профили</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Просмотр всех контрактов
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card-style">
                    <div class="table-wrapper table-responsive">
                        <table class="table table-hover bg-white">
                            <thead>
                            <tr>
                                <th scope="col">
                                    <h6>id</h6>
                                </th>
                                <th scope="col">
                                    <h6>ФИО</h6>
                                </th>
                                <th scope="col">
                                    <h6>Количество новостей</h6>
                                </th>
                                <th scope="col">
                                    <h6>Номер телефона</h6>
                                </th>
                                <th scope="col" class="text-center">
                                    <h6>Пол</h6>
                                </th>
                                <th scope="col" class="text-center">
                                    <h6>Дата Рождения</h6>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php for ($i = 0; $i < count($allContracts); $i++) {
                                $id = empty(selectOne('users', ['idContract' => $allContracts[$i]['id']])['id']) ? null : selectOne('users', ['idContract' => $allContracts[$i]['id']])['id'];

                                if ($id == null) {
                                    $countNews = 0;
                                } else {
                                    $countNews = count(selectAll('news', NULL, ['idUsers' => $id]));
                                }

                                ?>
                                <tr>
                                    <td scope="row" class="min-width">
                                        <p><?= $allContracts[$i]['id'] ?></p>
                                    </td>
                                    <td class="min-width">
                                        <p>
                                            <b><?= $allContracts[$i]['surname'] . " " . $allContracts[$i]['firstName'] . " " . $allContracts[$i]['middleName'] ?></b>
                                        </p>
                                    </td>
                                    <td class="min-width">
                                        <p><?= $countNews ?></p>
                                    </td>
                                    <td class="min-width">
                                        <p><?= $allContracts[$i]['phoneNumber'] ?></p>
                                    </td>
                                    <td class="min-width text-center">
                                        <p><?= $allContracts[$i]['gender'] ?></p>
                                    </td>
                                    <td class="min-width text-center">
                                        <p><?= $allContracts[$i]['dateOfBirthday'] ?></p>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>

                        </table>
                    </div>

                    <div class="d-flex justify-content-end">
                        <ul class="pagination justify-content-center">
                            <?php if ($page != 1 && $page - 1 != 1) { ?>
                                <li class="page-item"><a class="page-link" href="?page=1">Первая страница</a></li>
                            <?php }
                            if ($page > 1 || $page - 1 == 1) { ?>
                                <li class="page-item"><a class="page-link"
                                                         href="?page=<?= ($page - 1) ?>">Предыдущая</a></li>
                            <? }
                            if (($page >= 1 && $page < $total_page) || $page + 1 == $total_page) { ?>
                                <li class="page-item"><a class="page-link" href="?page=<?= ($page + 1) ?>">Следующая</a>
                                </li>
                            <? }
                            if ($page != $total_page && $page + 1 != $total_page) { ?>
                                <li class="page-item"><a class="page-link" href="?page=<?= $total_page ?>">Последняя</a>
                                </li>
                            <?php } ?>
                        </ul>
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