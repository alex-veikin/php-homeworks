<?php
session_start();


if(!isset($_POST['submit'])) {
	header("Location: index.php");
} else {
	$errors = [];

	foreach($_POST as $field) {
		if($field == "") {
			$errors[] = "All fields are required";
			break;
		}
	}

	if($_POST['first-name']) {
		$_SESSION['first_name'] = $_POST['first-name'];
	} else {
		$errors[] = "Enter your first name";
	}

	if($_POST['last-name']) {
		$_SESSION['last_name'] = $_POST['last-name'];
	} else {
		$errors[] = "Enter your last name";
	}

	if($_POST['birth']) {
		$_SESSION['birth'] = $_POST['birth'];
		$birth = $_POST['birth'];
		$birth = implode("-", array_reverse(explode("-", $birth)));
	} else {
		$errors[] = "Select date of birth";
	}

	if($_POST['gender']) {
		$_SESSION['gender'] = $_POST['gender'];
	} else {
		$errors[] = "Select your gender";
	}

	if($_POST['login']) {
		$_SESSION['login'] = $_POST['login'];
	} else {
		$errors[] = "Enter login";
	}

	if($_POST['password']) {
		$password = $_POST['password'];
	} else {
		$errors[] = "Enter password";
	}

	if($_POST['password-confirm']) {
		$password_confirm = $_POST['password-confirm'];
	} else {
		$errors[] = "Confirm the password";
	}

	if($password_confirm && ($password !== $password_confirm)) {
		$errors[] = "Confirm the password correctly";
	}

	$_SESSION['errors'] = $errors;
}
header("Location: index.php");