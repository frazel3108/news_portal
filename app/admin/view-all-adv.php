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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <link rel="stylesheet" href="https://material.io/components/text-fields/web#using-text-fields">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <link rel="stylesheet" href="../../assets/css/adminstyle.css">
    <script src="../../assets/js/jquery-1.11.1.min.js"></script>

    <title>Новости</title>
</head>

<body>
    <?php require("adminheader.php");
    $limit        = 10;
    $offset       = $limit * ($page - 1);
    $total_page   = ceil(numRows('advertisement') / $limit);
    if (empty(getAdv()['img'])) {
        $allAdv    = selectALL('advertisement', null, [], $limit, 'id', false, $offset);
    } else {
        $allAdv    = selectALL('advertisement', null, [], $limit, 'used', false, $offset);
    }

    ?>

    <section class="section">
        <div class="container-fluid">
            <div class="title-wrapper pt-30">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="title mb-30">
                            <h2>Работа с рекламой</h2>
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
                                        Просмотр всей рекламы
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
                                            <h6>title</h6>
                                        </th>
                                        <th scope="col">
                                            <h6>href</h6>
                                        </th>
                                        <th scope="col">
                                            <h6>used</h6>
                                        </th>
                                        <th scope="col" class="text-center">
                                            <h6>Действие</h6>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($i = 0; $i < count($allAdv); $i++) {
                                    ?>
                                        <tr>
                                            <form action="../controllers/change-used-adv.php" method="post">
                                                <th scope="row" class="min-width">
                                                    <p><?= $allAdv[$i]['id'] ?></p>
                                                </th>
                                                <td class="min-width">
                                                    <div class="lead">
                                                        <p><?= $allAdv[$i]['title'] ?></p>
                                                    </div>
                                                </td>
                                                <td class="min-width">
                                                    <p><a href="<?= $allAdv[$i]['href'] ?>"><?= substr($allAdv[$i]['href'],
                                                                0, strpos($allAdv[$i]['href'], '/', 8)) ?>/</a></p>
                                                </td>
                                                <td class="min-width">

                                                    <?php if ($allAdv[$i]['used'] == 1) { ?>

                                                        <div class="form-check form-switch toggle-switch">
                                                            <input type="hidden" name="used[<?= $allAdv[$i]['id'] ?>]" value="0" />
                                                            <input class="form-check-input" name="used[<?= $allAdv[$i]['id'] ?>]" type="checkbox" checked>
                                                        </div>

                                                    <? } else if (empty(getAdv()['img'])) { ?>
                                                        <div class="form-check form-switch toggle-switch">
                                                            <input class="form-check-input" name="used[<?= $allAdv[$i]['id'] ?>]" type="checkbox">
                                                        </div>
                                                    <? } ?>

                                                </td>
                                                <td class="min-width">
                                                    <div class="action">
                                                        <button type="submit" class="text-primary">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2" viewBox="0 0 16 16">
                                                                <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z" />
                                                            </svg>
                                                        </button>
                                                        <a href="edit-adv.php?id=<?= $allAdv[$i]['id'] ?>" class="text-success">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                            </svg>
                                                        </a>
                                                        <a href="../controllers/delete-adv.php?id=<?= $allAdv[$i]['id'] ?>" class="text-danger">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </td>
                                            </form>
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
                                    <li class="page-item"><a class="page-link" href="?page=<?= ($page - 1) ?>">Предыдущая</a></li>
                                <? }

                                if (($page >= 1 && $page < $total_page) || $page + 1 == $total_page) { ?>
                                    <li class="page-item"><a class="page-link" href="?page=<?= ($page + 1) ?>">Следующая</a></li>
                                <? }
                                if ($page != $total_page && $page + 1 != $total_page) { ?>
                                    <li class="page-item"><a class="page-link" href="?page=<?= $total_page ?>">Последняя</a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="../../assets/Js/main.js"></script>
</body>

</html>