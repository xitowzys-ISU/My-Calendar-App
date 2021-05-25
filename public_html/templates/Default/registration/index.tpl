<body class="text-center">
    <main class="form-signin">
        <form action="/registration" method="POST">
            <h1 class="h3 mb-3 fw-normal">Регистрация</h1>

            <div class="form-floating">
                <input type="text" name="login" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Логин</label>
            </div>
            <div class="form-floating">
                <input type="email" name="email" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">e-mail</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Пароль</label>
            </div>

            <div class="checkbox mb-3"></div>

            <div class="">
                <button class="btn btn-lg btn-primary" type="submit">Зарегистрироваться</button>
            </div>

            <p class="mt-5 mb-3 text-muted">© 2021–2024</p>
        </form>
    </main>
</body>