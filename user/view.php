<h1>Регистрация</h1>
<div class="body-form">
    <form method="post" action="user/register.php" id="registration-form">
        <input name="login" placeholder="Логин" title="" class="form-control"/>
        <input name="password" placeholder="Пароль" type="password" title="" class="form-control"/>
        <input name="repeat-password" placeholder="Повторите пароль" type="password"  title="" class="form-control"/>
        <input name="surname" placeholder="Фамилия" title="" class="form-control"/>
        <input name="name" placeholder="Имя" title="" class="form-control"/>
        <input name="patronymic" placeholder="Отчество" title="" class="form-control"/>
        <button type="submit" class="btn btn-success btn-block">Зарегистрироваться</button>
    </form>
</div>
<hr>
<h1>Вход</h1>
<div class="body-form">
    <form method="post" action="user/login.php" id="login-form">
        <input name="login" placeholder="Логин" title="" class="form-control"/>
        <input name="password" placeholder="Пароль" type="password" title="" class="form-control"/>
        <button type="submit" class="btn btn-success btn-block">Войти</button>
    </form>
</div>