<?php require_once ROOT . "/layouts/header.php"; ?>

    <div class="container">
		<?php if ( $errors === false ) : ?>
            <div class="row justify-content-center">
                <p class='h3 text-success'>Авторизация прошла успешно</p>
                <button onclick="location.href='index.php'" class="btn btn-primary btn-block">Back</button>
            </div>
		<?php else : ?>
            <p class="h2 text-center text-uppercase">Login</p>
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="form justify-content-center">
                <label class="sr-only" for="login">Login</label>
                <input type="text" name="login" class="form-control mb-2 mr-sm-2" id="login" placeholder="Login">

                <label class="sr-only" for="inlineFormInputName2">Name</label>
                <input type="text" name="password" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2"
                       placeholder="Password">
				<?php
				if ( ( $_POST['submit'] === "login" ) ) {
					foreach ( $errors as $error ) {
						echo "<p class='text-danger'>$error</p>";
					}
				}
				?>

                <button type="submit" name="submit" value="login" class="btn btn-primary mb-2">Sign in</button>
            </form>
		<?php endif; ?>
    </div>

<?php require_once ROOT . "/layouts/footer.php"; ?>