<?php require_once ROOT . "/layouts/header.php"; ?>

    <div class="container">
		<?php if ( $errors === false ) : ?>
            <div class="row justify-content-center">
                <p class='h3 text-success'>Регистрация прошла успешно</p>
                <button onclick="location.href='index.php'" class="btn btn-primary btn-block">Back</button>
            </div>
		<?php else : ?>
            <p class="h2 text-center text-uppercase">Registration</p>

            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="form">
                <div class="form-group col-sm-10 col-md-8 col-lg-6 row">
                    <label for="first_name" class="col-sm-4 col-form-label">First name</label>
                    <div class="col-sm-8">
                        <input type="text" name="first_name" class="form-control" id="first_name"
                               placeholder="First name" value="<?= $_POST['first_name'] ?>">
                    </div>
                </div>
                <div class="form-group col-sm-10 col-md-8 col-lg-6 row">
                    <label for="last_name" class="col-sm-4 col-form-label">Last name</label>
                    <div class="col-sm-8">
                        <input type="text" name="last_name" class="form-control" id="last_name"
                               placeholder="Last name" value="<?= $_POST['last_name'] ?>">
                    </div>
                </div>
                <div class="form-group col-sm-10 col-md-8 col-lg-6 row">
                    <label for="login" class="col-sm-4 col-form-label">Login</label>
                    <div class="col-sm-8">
                        <input type="text" name="login" class="form-control" id="login"
                               placeholder="Login" value="<?= $_POST['login'] ?>">
                    </div>
                </div>
                <div class="form-group col-sm-10 col-md-8 col-lg-6 row">
                    <label for="email" class="col-sm-4 col-form-label">Email</label>
                    <div class="col-sm-8">
                        <input type="email" name="email" class="form-control" id="email"
                               placeholder="Email" value="<?= $_POST['email'] ?>">
                    </div>
                </div>
                <div class="form-group col-sm-10 col-md-8 col-lg-6 row">
                    <legend class="col-sm-4 col-form-label pt-0">Gender</legend>
                    <div class="col-sm-8">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="male"
                                   value="male" <?= ( $_POST['gender'] === "male" ) ? "checked" : "" ?>>
                            <label class="form-check-label" for="male">
                                Male
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="female"
                                   value="female" <?= ( $_POST['gender'] === "female" ) ? "checked" : "" ?>>
                            <label class="form-check-label" for="female">
                                Female
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group col-sm-10 col-md-8 col-lg-6 row">
                    <label for="password" class="col-sm-4 col-form-label">Password</label>
                    <div class="col-sm-8">
                        <input type="password" name="password" class="form-control" id="password"
                               placeholder="Password">
                    </div>
                </div>
                <div class="form-group col-sm-10 col-md-8 col-lg-6 row">
                    <label for="password_confirm" class="col-sm-4 col-form-label">Confirm password</label>
                    <div class="col-sm-8">
                        <input type="password" name="password_confirm" class="form-control" id="password_confirm"
                               placeholder="Confirm password">
                    </div>
                </div>
                <div class="form-group col-sm-10 col-md-8 col-lg-6">
					<?php
					if ( ( $_POST['submit'] === "reg" ) ) {
						foreach ( $errors as $error ) {
							echo "<p class='text-danger'>$error</p>";
						}
					}
					?>
                </div>
                <div class="form-group col-md-6 row justify-content-center">
                    <div class="col-sm-10">
                        <button type="submit" name="submit" value="reg" class="btn btn-primary btn-block">Sign up
                        </button>
                    </div>
                </div>
            </form>
            <button onclick="location.href='index.php'" class="btn btn-primary btn-block">Back</button>

		<?php endif; ?>
    </div>

<?php require_once ROOT . "/layouts/footer.php"; ?>