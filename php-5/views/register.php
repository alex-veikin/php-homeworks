<?php require_once ROOT . "/layouts/header.php"; ?>

    <div class="container">
		<?php if ( $errors === false ) : ?>
            <div class="row justify-content-center">
                <p class='h3 text-success'>Регистрация прошла успешно</p>
                <button onclick="location.href='index.php'" class="btn btn-primary btn-block">На главную</button>
            </div>
		<?php else : ?>
            <p class="h2 text-center text-uppercase">Регистрация</p>

            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="form">
                <div class="form-group row">
                    <label for="first_name" class="col-sm-4 col-form-label">Имя</label>
                    <div class="col-sm-8">
                        <input type="text" name="first_name" class="form-control" id="first_name"
                               placeholder="Имя" value="<?= $_POST['first_name'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="last_name" class="col-sm-4 col-form-label">Фамилия</label>
                    <div class="col-sm-8">
                        <input type="text" name="last_name" class="form-control" id="last_name"
                               placeholder="Фамилия" value="<?= $_POST['last_name'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="login" class="col-sm-4 col-form-label">Логин</label>
                    <div class="col-sm-8">
                        <input type="text" name="login" class="form-control" id="login"
                               placeholder="Логин" value="<?= $_POST['login'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-4 col-form-label">Email</label>
                    <div class="col-sm-8">
                        <input type="email" name="email" class="form-control" id="email"
                               placeholder="Email" value="<?= $_POST['email'] ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <legend class="col-sm-4 col-form-label pt-0">Пол</legend>
                    <div class="col-sm-8">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="male"
                                   value="male" <?= ( $_POST['gender'] === "male" ) ? "checked" : "" ?>>
                            <label class="form-check-label" for="male">Мужской</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="female"
                                   value="female" <?= ( $_POST['gender'] === "female" ) ? "checked" : "" ?>>
                            <label class="form-check-label" for="female">Женский</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-4 col-form-label">Пароль</label>
                    <div class="col-sm-8">
                        <input type="password" name="password" class="form-control" id="password"
                               placeholder="Пароль">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password_confirm" class="col-sm-4 col-form-label">Подтвердите пароль</label>
                    <div class="col-sm-8">
                        <input type="password" name="password_confirm" class="form-control" id="password_confirm"
                               placeholder="Подтвердите пароль">
                    </div>
                </div>
                <div class="form-group">
					<?php
					if ( ( $_POST['submit'] === "reg" ) ) {
						foreach ( $errors as $error ) {
							echo "<p class='text-danger'>$error</p>";
						}
					}
					?>
                </div>
                <div class="form-group row justify-content-center">
                    <div class="col-sm-12">
                        <button type="submit" name="submit" value="reg" class="btn btn-primary btn-block">Зарегистрироваться
                        </button>
                    </div>
                </div>
            </form>
            <button onclick="location.href='index.php'" class="btn btn-primary btn-block">На главную</button>

		<?php endif; ?>
    </div>

<?php require_once ROOT . "/layouts/footer.php"; ?>