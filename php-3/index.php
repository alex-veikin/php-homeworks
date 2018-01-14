<?php
session_start();

//var_dump($_SESSION['errors']);

?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP</title>
    <link rel="stylesheet" href="css/main.css" type="text/css"/>
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<?php


?>

<form action="register.php" method="post">
    <h2>Registration</h2>

    <p>
        <label for="first-name">First name: </label>
        <input id="first-name" type="text" name="first-name" value="<?=$_SESSION['first_name']?>" placeholder="first-name">
    </p>
    <p>
        <label for="last-name">Last name: </label>
        <input id="last-name" type="text" name="last-name" value="<?=$_SESSION['last_name']?>" placeholder="last-name">
    </p>
    <p>
        <label for="birth">Date of birth: </label>
        <input id="birth" type="date" name="birth" value="<?=$_SESSION['birth']?>" placeholder="date of birth">
    </p>
    <p>
        <label>Gender: </label>
        <span>
            Male: <input type="radio" name="gender" value="male" title="male">
            Female: <input type="radio" name="gender" value="female" title="female">
        </span>
    </p>
    <p>
        <label for="login">Login: </label>
        <input id="login" type="text" name="login" value="<?=$_SESSION['login']?>" placeholder="login">
    </p>
    <p>
        <label for="password">Password: </label>
        <input id="password" type="password" name="password" placeholder="password">
    </p>
    <p>
        <label for="password-confirm">Confirm password: </label>
        <input id="password-confirm" type="password" name="password-confirm" placeholder="confirm password">
    </p>
    <div class="errors">
		<?php
		foreach ($_SESSION['errors'] as $error) {
			echo "<p class='msg'>$error</p>";
		}
        ?>
    </div>
    <input class="btn" type="submit" name="submit" value="Register">
</form>


<script src="js/jquery-3.2.1.js"></script>
<script src="js/main.js"></script>
</body>

</html>
