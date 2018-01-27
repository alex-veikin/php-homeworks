<?php
session_start();

if (!isset($_POST['json'])) { //Если перешли не через ajax
	if (!isset($_POST['submit'])) { //Если перешли в register.php не из формы
		header("Location: index.php");
	}
}

if (isset($_POST['json']) && $_POST['json']) { //Формируем переменные из json-строки
	$arr = json_decode($_POST['json'], true);
	$_POST['login'] = $arr['login'];
	$_POST['email'] = $arr['email'];
	$_POST['password'] = $arr['password'];
	$_POST['password_confirm'] = $arr['password_confirm'];
}

$errors = [];

function checkLogin($val) {
	$file = file("users.txt");

	foreach ($file as $value) {
		list($login,,) = explode("||", $value);
		$login = preg_replace("/(Login:)/", '', $login);
		if($val == trim($login)) return true;
	}

	return false;
}

function checkEmail($val) {
	$file = file("users.txt");

	foreach ($file as $value) {
		list(,$email,) = explode("||", $value);
		$email = preg_replace("/(E-mail:)/", '', $email);
		if($val == trim($email)) return true;
	}

	return false;
}


$_POST['login'] = trim($_POST['login']);
$_POST['email'] = trim($_POST['email']);
$_POST['password'] = trim($_POST['password']);
$_POST['password_confirm'] = trim($_POST['password_confirm']);

if ($_POST['login']) {
	if (mb_strlen($_POST['login']) < 3 || mb_strlen($_POST['login']) > 30) { //Если логин < 3 или > 30 символов, то созд. ошибку
		$errors[] = "Login must be at least 3 or not more than 30 characters in length";
	}

	if (checkLogin($_POST['login'])) {
		$errors[] = "This login already exists";
	}

	$_SESSION['login'] = $_POST['login'];
} else {
	unset($_SESSION['login']);
	$errors[] = "Enter login";
}

if ($_POST['email']) {
	if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) { //Если неверный формат email
		$errors[] = "Incorrect email";
	}

	if (checkEmail($_POST['email'])) {
		$errors[] = "This email already exists";
	}

	$_SESSION['email'] = $_POST['email'];
} else {
	unset($_SESSION['email']);
	$errors[] = "Enter email";
}

if ($_POST['password']) {
	if (mb_strlen($_POST['password']) < 4) { //Если пароль короче 4 символов, то созд. ошибку
		$errors[] = "Passwords must be at least 4 characters in length";
	} else {
		//Запоминаем пароль, только если он больше 4 символов
		//Чтобы не выводить лишнюю ошибку о некорректном подтверждении
		$password = $_POST['password'];
	}
} else {
	$errors[] = "Enter password";
}

if ($_POST['password_confirm']) {
	$password_confirm = $_POST['password_confirm'];
} else {
	$errors[] = "Confirm the password";
}

if (isset($password) && isset($password_confirm) && ($password !== $password_confirm)) { //Если пароли не совпадают, то созд. ошибку
	$errors[] = "Confirm the password correctly";
}

$_SESSION['errors'] = $errors; //Записываем ошибки в сессию, для вывоба в index.php

if (!count($_SESSION['errors'])) { //Если ошибок нет
	$file = fopen('users.txt', 'a+');

	$user = //Строка с данными пользователя
		"Login: " . $_SESSION['login'] . " || " .
		"E-mail: " . $_SESSION['email'] . " || " .
		"Password: " . $password . PHP_EOL;

	fwrite($file, $user); //Записываем данные пользователя в файл
	fclose($file);

	session_unset();//Чистим сессии при успешной регистрации
	$_SESSION['good'] = "Registration success!"; //Создаем сообщение об успешной регистрации, для вывода в index.php
} else {
	unset($_SESSION['good']);
}

if (!isset($_POST['json'])) { //Если перешли не через ajax
	header("Location: index.php"); //Перенаправляем обратно в index.php
}

if (isset($_POST['json']) && $_POST['json']) { //Отдаем данные через ajax
	if(count($_SESSION['errors'])) {
		foreach ($_SESSION['errors'] as $error) {
			echo "<p class='error'>- $error</p>";
		}
	} elseif (($_SESSION['good'])) {
		echo "<p class='good'>" . $_SESSION['good'] . "</p>";
	}
}