<body class="text-center">
    <div class="form-signin">
        <form action="/auth" method="POST">
            <h1 class="h3 mb-3 fw-normal">Авторизация</h1>

            <div class="form-floating">
                <input type="text" class="form-control" name='login' id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Логин</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" name='password' id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Пароль</label>
            </div>

            <div class="checkbox mb-3"></div>

            <div class="">
                <button type="submit" class="btn btn-lg btn-primary">Войти</button>
                <div class="checkbox mb-3"></div>
                <a href="\registration"><button class="btn btn-lg btn-primary" type="button">Зарегистрироваться</button></a>
            </div>

            <p class="mt-5 mb-3 text-muted">© 2021–2024</p>
        </form>
    </div>
</body>