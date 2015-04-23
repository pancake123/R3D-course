<?php
/**
 * @var array $users
 * @var mixed $user
 * @var array $roles
 * @var array $privileges
 */
?>
<script type="text/javascript" src="/nastya/js/cabinet.js"></script>
<div class="col-xs-12">
    <div class="col-xs-12 text-center">
        <h1>Личный кабинет</h1>
    </div>
    <div class="col-xs-12" style="margin-bottom: 15px">
        <b>Идентификатор:&nbsp;</b><?= $user->id ?>
        <br>
        <b>Логин:&nbsp;</b><?= $user->login ?>
        <br>
        <b>Фамилия:&nbsp;</b><?= $user->surname ?>
        <br>
        <b>Имя:&nbsp;</b><?= $user->name ?>
        <br>
        <b>Отчество:&nbsp;</b><?= $user->patronymic ?>
        <br>
        <b>Дата регистрации:&nbsp;</b><?= $user->registration_date ?>
        <br>
        <b>Роль:&nbsp;</b><?= $user->role_name ?>
    </div>
</div>
<?php if (Session::getInstance()->checkAccess("canEditTables")): ?>
<div class="col-xs-12">
    <h4 style="color: #ffffff">Список пользователей</h4>
    <div class="col-xs-12" style="background-color: #f5f5f5; border-radius: 5px; padding: 0 5px; margin-bottom: 15px">
        <table class="table table-striped table-condensed" style="margin: 0;">
            <thead>
            <tr>
                <td><b>Логин</b></td>
                <td><b>Фамилия И.О.</b></td>
                <td><b>Роль</b></td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php print $user["login"] ?></td>
                    <td><?php print $user["surname"] . " " . mb_substr($user["name"], 0, 1) . "." . mb_substr($user["patronymic"], 0, 1) . "." ?></td>
                    <td><?php print $user["role_id"] ?></td>
                    <td>
                        <a class="glyphicon glyphicon-pencil user-edit-icon" data-id="<?= $user["id"] ?>" style="cursor: pointer"></a>
                        <a href="/nastya/user/remove.php?id=<?= urlencode($user["id"]) ?>" class="glyphicon glyphicon-remove"></a>
                    </td>
                </tr>
            <?php endforeach ?>
            <?php if (count($users) == 0): ?>
                <tr>
                    <td colspan="2"><b>Нет данных</b></td>
                </tr>
            <?php endif ?>
            </tbody>
        </table>
        <div class="col-xs-12 text-right" style="padding: 0">
            <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#register-user-modal">Добавить</button>
        </div>
    </div>
    <hr>
    <h4 style="color: #ffffff">Список ролей</h4>
    <div class="col-xs-12" style="background-color: #f5f5f5; border-radius: 5px; padding: 0 5px; margin-bottom: 15px">
        <table class="table table-striped table-condensed" style="margin: 0;">
            <thead>
            <tr>
                <td><b>Идентификатор</b></td>
                <td><b>Наменование</b></td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($roles as $role): ?>
                <tr>
                    <td><?php print $role["id"] ?></td>
                    <td><?php print $role["name"] ?></td>
                    <td>
                        <a class="glyphicon glyphicon-pencil role-edit-icon" data-id="<?= $role["id"] ?>" style="cursor: pointer"></a>
                        <a href="/nastya/role/remove.php?id=<?= urlencode($role["id"]) ?>" class="glyphicon glyphicon-remove"></a>
                    </td>
                </tr>
            <?php endforeach ?>
            <?php if (count($roles) == 0): ?>
                <tr>
                    <td colspan="2"><b>Нет данных</b></td>
                </tr>
            <?php endif ?>
            </tbody>
        </table>
        <div class="col-xs-12 text-right" style="padding: 0">
            <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#register-role-modal">Добавить</button>
        </div>
    </div>
    <hr>
    <h4 style="color: #fff">Список привилегий</h4>
    <div class="col-xs-12" style="background-color: #f5f5f5; border-radius: 5px; padding: 0 5px;">
        <table class="table table-striped table-condensed" style="margin: 0;">
            <thead>
            <tr>
                <td><b>Идентификатор</b></td>
                <td><b>Наменование</b></td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($privileges as $privilege): ?>
                <tr>
                    <td><?php print $privilege["id"] ?></td>
                    <td><?php print $privilege["name"] ?></td>
                    <td>
                        <a class="glyphicon glyphicon-pencil privilege-edit-icon" data-id="<?= $privilege["id"] ?>" style="cursor: pointer"></a>
                        <a href="/nastya/privilege/remove.php?id=<?= urlencode($privilege["id"]) ?>" class="glyphicon glyphicon-remove"></a>
                    </td>
                </tr>
            <?php endforeach ?>
            <?php if (count($privileges) == 0): ?>
                <tr>
                    <td colspan="2"><b>Нет данных</b></td>
                </tr>
            <?php endif ?>
            </tbody>
        </table>
        <div class="col-xs-12 text-right" style="padding: 0px">
            <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#register-privilege-modal">Добавить</button>
        </div>
    </div>
</div>
<?php endif ?>
<div class="col-xs-12">
    <div class="col-xs-12 text-center" style="margin-top: 15px;">
        <a href="logout.php" class="btn btn-danger">Выйти</a>
    </div>
</div>
<form method="post" action="/nastya/role/create.php">
    <div class="modal fade" id="register-role-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Добавить роль</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-11">
                            <div class="form-group row">
                                <label class="col-xs-4">Идентификатор</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" placeholder="Идентификатор" name="id">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xs-4">Наименование</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" placeholder="Наименование" name="name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xs-4">Привилегии</label>
                                <div class="checkbox col-xs-8 text-left">
                                    <?php foreach ($privileges as $privilege): ?>
                                        <label>
                                            <input type="checkbox" value="<?= $privilege["id"] ?>" name="privileges[]">
                                            <?= $privilege["name"] ?>
                                        </label>
                                        <br>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</form>
<form method="post" action="/nastya/role/update.php">
    <div class="modal fade" id="update-role-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Редактировать роль</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-11">
                            <div class="form-group row">
                                <label class="col-xs-4">Идентификатор</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" readonly="true" placeholder="Идентификатор" name="id">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xs-4">Наименование</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" placeholder="Наименование" name="name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xs-4">Привилегии</label>
                                <div class="checkbox col-xs-8 text-left check-box-list">
                                    <?php foreach ($privileges as $privilege): ?>
                                        <label>
                                            <input type="checkbox" value="<?= $privilege["id"] ?>" name="privileges[]">
                                            <?= $privilege["name"] ?>
                                        </label>
                                        <br>
                                    <?php endforeach ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</form>
<form method="post" action="/nastya/privilege/create.php">
<div class="modal fade" id="register-privilege-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Добавить привилегию</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group row">
                            <label class="col-xs-4">Идентификатор</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" placeholder="Идентификатор" name="id">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-xs-4">Наименование</label>
                            <div class="col-xs-8">
                                <input type="text" class="form-control" placeholder="Наименование" name="name">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="submit" class="btn btn-primary">Сохранить</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
</form>
<form method="post" action="/nastya/privilege/update.php">
    <div class="modal fade" id="update-privilege-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Редактировать привилегию</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group row">
                                <label class="col-xs-4">Идентификатор</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" readonly="true" placeholder="Идентификатор" name="id">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xs-4">Наименование</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" placeholder="Наименование" name="name">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</form>
<form method="post" action="/nastya/user/create.php">
    <div class="modal fade" id="register-user-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Добавить пользователя</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group row">
                                <label class="col-xs-4">Логин</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" placeholder="Логин" name="login">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xs-4">Пароль</label>
                                <div class="col-xs-8">
                                    <input type="password" class="form-control" placeholder="Пароль" name="password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xs-4">Фамилия</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" placeholder="Фамилия" name="surname">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xs-4">Имя</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" placeholder="Имя" name="name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xs-4">Отчество</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" placeholder="Отчество" name="patronymic">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xs-4">Роль</label>
                                <div class="col-xs-8">
                                    <select title="" name="role_id" class="form-control">
                                        <?php foreach ($roles as $role): ?>
                                            <option value="<?= $role["id"] ?>"><?= $role["name"] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</form>
<form method="post" action="/nastya/user/update.php">
    <div class="modal fade" id="update-user-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Редактирование пользователя</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <input type="hidden" placeholder="#" name="id">
                            <div class="form-group row">
                                <label class="col-xs-4">Логин</label>
                                <div class="col-xs-8">
                                    <input type="text" readonly="true" class="form-control" placeholder="Логин" name="login">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xs-4">Пароль</label>
                                <div class="col-xs-8">
                                    <input type="password" class="form-control" placeholder="Пароль" name="password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xs-4">Фамилия</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" placeholder="Фамилия" name="surname">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xs-4">Имя</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" placeholder="Имя" name="name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xs-4">Отчество</label>
                                <div class="col-xs-8">
                                    <input type="text" class="form-control" placeholder="Отчество" name="patronymic">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-xs-4">Роль</label>
                                <div class="col-xs-8">
                                    <select title="" name="role_id" class="form-control">
                                        <?php foreach ($roles as $role): ?>
                                            <option value="<?= $role["id"] ?>"><?= $role["name"] ?></option>
                                        <?php endforeach ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</form>