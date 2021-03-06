<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>PHP</title>
    <link rel="stylesheet" href="css/main.css" type="text/css"/>
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="css/bootstrap.css">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>


<?php
spl_autoload_register( function ( $class_name ) {
	include $class_name . '.php';
} );

if ( isset( $_POST['register'] ) ) {
	$user = new User( $_POST['first_name'], $_POST['last_name'], $_POST['login'],
		$_POST['email'], $_POST['gender'], $_POST['password'], $_POST['password_confirm'] );
}
?>


<div class="container">
    <p class="h2 text-center text-uppercase">Registration</p>

	<?php if ( isset( $user ) && $user->checkForm() ) : ?>
        <div class="row justify-content-center">
			<?php if ( $user->registerUser() ) : ?>
                <p class='h3 text-success'>Регистрация прошла успешно</p>
			<?php else : ?>
                <p class='h3 text-danger'>Регистрация не удалась</p>
			<?php endif; ?>
            <button onclick="location.href='index.php'" class="btn btn-primary btn-block">Back to form</button>
        </div>
	<?php else : ?>
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="row flex-column align-items-center">
            <div class="form-group col-sm-10 col-md-8 col-lg-6 row">
                <label for="first_name" class="col-sm-4 col-form-label">First name</label>
                <div class="col-sm-8">
                    <input type="text" name="first_name" class="form-control" id="first_name"
                           placeholder="First name" value="<?= $user->first_name ?>">
                </div>
            </div>
            <div class="form-group col-sm-10 col-md-8 col-lg-6 row">
                <label for="last_name" class="col-sm-4 col-form-label">Last name</label>
                <div class="col-sm-8">
                    <input type="text" name="last_name" class="form-control" id="last_name"
                           placeholder="Last name" value="<?= $user->last_name ?>">
                </div>
            </div>
            <div class="form-group col-sm-10 col-md-8 col-lg-6 row">
                <label for="login" class="col-sm-4 col-form-label">Login</label>
                <div class="col-sm-8">
                    <input type="text" name="login" class="form-control" id="login"
                           placeholder="Login" value="<?= $user->login ?>">
                </div>
            </div>
            <div class="form-group col-sm-10 col-md-8 col-lg-6 row">
                <label for="email" class="col-sm-4 col-form-label">Email</label>
                <div class="col-sm-8">
                    <input type="email" name="email" class="form-control" id="email"
                           placeholder="Email" value="<?= $user->email ?>">
                </div>
            </div>
            <div class="form-group col-sm-10 col-md-8 col-lg-6 row">
                <legend class="col-sm-4 col-form-label pt-0">Gender</legend>
                <div class="col-sm-8">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="male"
                               value="male" <?= ( $user->gender === "male" ) ? "checked" : "" ?>>
                        <label class="form-check-label" for="male">
                            Male
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="gender" id="female"
                               value="female" <?= ( $user->gender === "female" ) ? "checked" : "" ?>>
                        <label class="form-check-label" for="female">
                            Female
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group col-sm-10 col-md-8 col-lg-6 row">
                <label for="password" class="col-sm-4 col-form-label">Password</label>
                <div class="col-sm-8">
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
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
				if ( isset( $user ) && ! $user->checkForm() ) {
					foreach ( $user::$errors as $error ) {
						echo "<p class='text-danger'>$error</p>";
					}
				}
				?>
            </div>
            <div class="form-group col-md-6 row justify-content-center">
                <div class="col-sm-10">
                    <button type="submit" name="register" value="submit" class="btn btn-primary btn-block">Sign up
                    </button>
                </div>
            </div>
        </form>

	<?php endif; ?>
</div>


<script src="js/jquery-3.2.1.js"></script>
<script src="js/bootstrap.bundle.js"></script>
<script src="js/main.js"></script>
</body>

</html>
