<header>
    <div class="px-3 py-2 border-bottom">
        <div class="container d-flex flex-wrap justify-content-center">
            <div class="col-lg-auto mb-2 mb-lg-0 me-lg-auto">
                <h1><a class="text-black" href="/index.php">Новостной портал</a></h1>
            </div>
            <div class="text-end">
                <ul style="display: flex;">
                    <li class="px-3 pt-3 mail">
                        <a class="mail" href="mailto:mail@example.com">mail@example.com</a>
                    </li>
                    <div class="pt-3 separator">|</div>
                    <li class="px-3 pt-3 ContacUS">Contact Us</li>
                    <div class="pt-3 separator">|</div>
                    <li class="px-3 pt-3 numberPhone">+7 999 999 99 99</li>
                    <div class="pt-3 separator">|</div>
                    <li class="px-3 login">
                        <?php if (!empty($_SESSION['auth'])) {
                        ?>
                            <div class="dropdown">
                                <a class="btn btn-link dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                    Здравствуйте,
                                    <?php if ($_SESSION['auth']['type'] == 'admin') {
                                        echo "Администратор";
                                    } else {
                                        echo $_SESSION['auth']['data']['firstName'] . " " . mb_substr($_SESSION['auth']['data']['surname'], 0, 1) . ".";
                                    } ?>
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <li><a class="dropdown-item" href="/admin.php">Зайти в Админ-Панель</a></li>

                                    <li><a class="dropdown-item" href="/app/controllers/logout.php">Выйти</a></li>
                                </ul>
                            </div>
                        <?php } else { ?>
                            <a class="btn btn-secondary text-white" data-bs-toggle="modal" data-bs-target="#SignIn" role="button">Войти</a>
                        <?php } ?>
                    </li>
                </ul>

            </div>
        </div>
    </div>
    <div class="modal fade" id="SignIn" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-5 shadow">
                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <h2 class="fw-bold mb-0">Авторизация</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-5 pt-0">
                    <hr class="my-4">
                    <form action="/app/controllers/users.php" method="post">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-4" name="login[login]" id="floatingInput" placeholder="Логин">
                            <label for="floatingInput">Логин</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control rounded-4" name="login[password]" id="floatingPassword" placeholder="Пароль">
                            <label for="floatingPassword">Пароль</label>
                        </div>
                        <button class="w-100 mb-2 btn btn-lg rounded-4 btn-primary" type="submit">Sign up</button>
                        <small class="text-muted">Вы сотрудник и хотите <a class="btn btn-link" data-bs-target="#reg" data-bs-toggle="modal" data-bs-dismiss="modal">зарегестрироваться?</a></small>
                        <hr class="my-4">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="reg" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-5 shadow">
                <div class="modal-header p-5 pb-4 border-bottom-0">
                    <h2 class="fw-bold mb-0">Регистрация</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-5 pt-0">
                    <hr class="my-4">
                    <form action="/app/controllers/registration.php" method="post">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control rounded-4" name="login" id="login" placeholder="Логин">
                            <label for="login">Логин</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control rounded-4" name="password" id="password" placeholder="Пароль">
                            <label for="password">Пароль</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control rounded-4" name="email" id="email" placeholder="mail@example.com">
                            <label for="email">mail@example.com</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control rounded-4" name="numbercontract" id="numbercontract" placeholder="">
                            <label for="numbercontract">Номер вашего контракта</label>
                        </div>
                        <button class="w-100 mb-2 btn btn-lg rounded-4 btn-primary" type="submit">Зарегестрироваться</button>
                        <small class="text-muted"><a class="btn btn-link" data-bs-target="#SignIn" data-bs-toggle="modal">Вернутся на форму авторизации</a></small>
                        <hr class="my-4">
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>