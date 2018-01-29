<?php require_once ROOT . "/layouts/header.php"; ?>

    <div class="container">
		<?php if ( isset( $_SESSION['user'] ) ) : ?>
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="">
                <div class="form-group row justify-content-center">
                    <div class="col-sm-10">
                        <button type="submit" name="submit" value="logout" class="btn btn-primary btn-block">Выйти
                        </button>
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <div class="col-sm-10">
                        <button type="submit" name="submit" value="edit" class="btn btn-primary btn-block">Изменить данные
                        </button>
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <div class="col-sm-10">
                        <button type="submit" name="submit" value="delete" class="btn btn-primary btn-block">Удалить аккаунт
                        </button>
                    </div>
                </div>
            </form>
		<?php else : ?>
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="">
                <div class="form-group row justify-content-center">
                    <div class="col-sm-10">
                        <button type="submit" name="submit" value="auth" class="btn btn-primary btn-block">Авторизация
                        </button>
                    </div>
                </div>
                <div class="form-group row justify-content-center">
                    <div class="col-sm-10">
                        <button type="submit" name="submit" value="register" class="btn btn-primary btn-block">Регистрация
                        </button>
                    </div>
                </div>
            </form>
		<?php endif; ?>
    </div>

<?php require_once ROOT . "/layouts/footer.php"; ?>