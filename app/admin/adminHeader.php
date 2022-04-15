<aside class="sidebar-nav-wrapper">
    <div class="navbar-logo">
        <a href="../../admin.php">
            <span class="text">Добро пожаловать!</span>
        </a>
    </div>
    <nav class="sidebar-nav">
        <ul>
            <li class="nav-item nav-item-has-children">
                <a href="/admin.php">
                    <span class="icon">
                        <svg width="22" height="22" viewBox="0 0 22 22">
                            <path d="M17.4167 4.58333V6.41667H13.75V4.58333H17.4167ZM8.25 4.58333V10.0833H4.58333V4.58333H8.25ZM17.4167 11.9167V17.4167H13.75V11.9167H17.4167ZM8.25 15.5833V17.4167H4.58333V15.5833H8.25ZM19.25 2.75H11.9167V8.25H19.25V2.75ZM10.0833 2.75H2.75V11.9167H10.0833V2.75ZM19.25 10.0833H11.9167V19.25H19.25V10.0833ZM10.0833 13.75H2.75V19.25H10.0833V13.75Z"></path>
                        </svg>
                    </span>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-item-has-children">
                <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#news" aria-controls="news"
                   aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon">
                        <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.8334 1.83325H5.50008C5.01385 1.83325 4.54754 2.02641 4.20372 2.37022C3.8599 2.71404 3.66675 3.18036 3.66675 3.66659V18.3333C3.66675 18.8195 3.8599 19.2858 4.20372 19.6296C4.54754 19.9734 5.01385 20.1666 5.50008 20.1666H16.5001C16.9863 20.1666 17.4526 19.9734 17.7964 19.6296C18.1403 19.2858 18.3334 18.8195 18.3334 18.3333V7.33325L12.8334 1.83325ZM16.5001 18.3333H5.50008V3.66659H11.9167V8.24992H16.5001V18.3333Z"></path>
                        </svg>
                    </span>
                    <span class="text">Новости</span>
                </a>
                <ul id="news" class="dropdown-nav collapse">
                    <li><a href="/app/admin/view-all-news.php"> Просмотр всех новостей </a></li>
                    <li><a href="/app/admin/addNews.php"> Добавить Новость </a></li>
                    <li><a href="/app/admin/add-category.php"> Добавить Категорию </a></li>
                    <?php if ($_SESSION['auth']['type'] == 'admin') { ?>
                        <li><a href="/app/admin/news-handling.php"> Работа с новостями </a></li>
                    <?php } ?>
                </ul>
            </li>
            <?php if ($_SESSION['auth']['type'] == 'admin') { ?>
                <li class="nav-item nav-item-has-children">
                    <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#profilecollapsed"
                       aria-controls="profilecollapsed" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon">
                            <i class="bi bi-people"></i>
                        </span>
                        <span class="text">Профили</span>
                    </a>
                    <ul id="profilecollapsed" class="dropdown-nav collapse">
                        <li><a href="/app/admin/view-all-users.php"> Просмотр всех пользователей </a></li>
                        <li><a href="/app/admin/add-contract.php"> Добавить контракт </a></li>
                        <li><a href="/app/admin/view-all-contracts.php"> Просмотр всех контрактов </a></li>
                    </ul>
                </li>
            <?php } ?>
            <span class="divider">
                <hr>
            </span>
            <?php if ($_SESSION['auth']['type'] == 'admin') { ?>
                <li class="nav-item nav-item-has-children">
                    <a href="#0" class="collapsed" data-bs-toggle="collapse" data-bs-target="#ad" aria-controls="ad"
                       aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon">
                            <i class="bi bi-badge-ad"></i>
                        </span>
                        <span class="text">Реклама</span>
                    </a>
                    <ul id="ad" class="dropdown-nav collapse">
                        <li><a href="/app/admin/view-all-adv.php"> Просмотр всей рекламы </a></li>
                        <li><a href="/app/admin/add-adv.php"> Добавить рекламу </a></li>
                    </ul>
                </li>
            <?php } ?>
            <span class="divider">
                <hr>
            </span>
            <li class="nav-item nav-item-has-children">
                <a href="/">
                    <span class="icon">
                        <i class="bi bi-chevron-bar-left"></i>
                    </span>
                    <span class="text">Вернуться</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>

<div class="overlay"></div>

<main class="main-wrapper">
    <header class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-6">
                    <div class="header-left d-flex align-items-center">
                        <div class="menu-toggle-btn mr-20">
                            <button id="menu-toggle" class="main-btn primary-btn btn-hover">
                                <i class="bi bi-chevron-left"></i>
                                Menu
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-7 col-6">
                    <div class="header-right">
                        <!-- profile start -->
                        <div class="profile-box ml-15">
                            <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="profile-info">
                                    <div class="info">
                                        <h6><?php
                                            if ($_SESSION['auth']['type'] == 'admin') {
                                                echo "Администратор";
                                            } else {
                                                echo $_SESSION['auth']['data']['firstName'] . " " . mb_substr($_SESSION['auth']['data']['surname'], 0, 1) . ".";
                                            } ?></h6>
                                        <div class="image">
                                            <img src="/assets/img/avatar/<?= $_SESSION['auth']['img'] ?>">
                                            <span class="status"></span>
                                        </div>
                                    </div>
                                </div>
                                <i class="lni lni-chevron-down"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
                                <li><a href="/app/admin/profile.php"><i class="bi bi-person"></i> View Profile</a></li>
                                <li><a href="/app/admin/settings.php"><i class="bi bi-gear"></i> Settings</a></li>
                                <li><a href="/app/controllers/logout.php"><i class="bi bi-box-arrow-right"></i> Sign Out</a>
                                </li>
                            </ul>
                        </div>
                        <!-- profile end -->
                    </div>
                </div>
            </div>
        </div>
    </header>