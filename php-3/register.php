<?php
session_start();

if (!isset($_POST['json'])) { //Если перешли не через ajax
	if (!isset($_POST['submit'])) { //Если перешли в register.php не из формы
		header("Location: index.php");
	}
}

if (isset($_POST['json']) && $_POST['json']) { //Формируем переменные из json-строки
	$arr = json_decode($_POST['json'], true);
	$_POST['first_name'] = $arr['first_name'];
	$_POST['last_name'] = $arr['last_name'];
	$_POST['birth'] = $arr['birth'];
	$_POST['gender'] = $arr['gender'];
	$_POST['login'] = $arr['login'];
	$_POST['password'] = $arr['password'];
	$_POST['password_confirm'] = $arr['password_confirm'];
}

$errors = [];

if ($_POST['first_name']) {
	if (mb_strlen($_POST['first_name']) < 2) { //Если имя меньше двух символов, то созд. ошибку
		$errors[] = "First name must be at least 2 characters in length";
	}
	$_SESSION['first_name'] = $_POST['first_name'];
} else {
	unset($_SESSION['first_name']);
	$errors[] = "Enter your first name";
}

if ($_POST['last_name']) {
	if (mb_strlen($_POST['last_name']) < 2) { //Если фамилия меньше двух символов, то созд. ошибку
		$errors[] = "Last name must be at least 2 characters in length";
	}
	$_SESSION['last_name'] = $_POST['last_name'];
} else {
	unset($_SESSION['last_name']);
	$errors[] = "Enter your last name";
}

if ($_POST['birth']) {
	$_SESSION['birth'] = $_POST['birth'];
	$birth = implode("-", array_reverse(explode("-", $_POST['birth']))); //Переводим в формат dd-mm-yyyy
} else {
	unset($_SESSION['birth']);
	$errors[] = "Select date of birth";
}

if ($_POST['gender']) {
	$_SESSION['gender'] = $_POST['gender'];
} else {
	unset($_SESSION['gender']);
	$errors[] = "Select your gender";
}

if ($_POST['login']) {
	if (mb_strlen($_POST['login']) < 4) { //Если логин меньше 4 символов, то созд. ошибку
		$errors[] = "Login must be at least 4 characters in length";
	}
	$_SESSION['login'] = $_POST['login'];
} else {
	unset($_SESSION['login']);
	$errors[] = "Enter login";
}

if ($_POST['password']) {
	if (mb_strlen($_POST['password']) < 6) { //Если пароль короче 6 символов, то созд. ошибку
		$errors[] = "Passwords must be at least 6 characters in length";
	} else {
		//Запоминаем пароль, только если он больше 6 символов
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
		"First name: " . $_SESSION['first_name'] . " || " .
		"Last name: " . $_SESSION['last_name'] . " || " .
		"Date of birth: " . $birth . " || " .
		"Gender: " . $_SESSION['gender'] . " || " .
		"Login: " . $_SESSION['login'] . " || " .
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