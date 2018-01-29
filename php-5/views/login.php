<?php require_once ROOT . "/layouts/header.php"; ?>

    <div class="container">
		<?php if ( $errors === false ) : ?>
            <div class="row justify-content-center">
                <p class='h3 text-success'>Авторизация прошла успешно</p>
                <button onclick="location.href='index.php'" class="btn btn-primary btn-block">На главную</button>
            </div>
		<?php else : ?>
            <p class="h2 text-center text-uppercase">Авторизация</p>
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="form justify-content-center">
                <label class="sr-only" for="login">Логин</label>
                <input type="text" name="login" class="form-control mb-2 mr-sm-2" id="login" placeholder="Логин">

                <label class="sr-only" for="password">Пароль</label>
                <input type="text" name="password" class="form-control mb-2 mr-sm-2" id="password"
                       placeholder="Пароль">
				<?php
				if ( ( $_POST['submit'] === "login" ) ) {
					foreach ( $errors as $error ) {
						echo "<p class='text-danger'>$error</p>";
					}
				}
				?>

                <button type="submit" name="submit" value="login" class="btn btn-primary btn-block">Вход</button>
            </form>
		<?php endif; ?>
    </div>

<?php require_once ROOT . "/layouts/footer.php"; ?>