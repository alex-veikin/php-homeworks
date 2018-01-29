<?php
session_start();

define('ROOT', __DIR__);

spl_autoload_register( function ( $class_name ) {
	include $class_name . '.php';
} );

if (!isset($_POST['submit']) || $_POST['submit'] === "home") {
	require_once "views/index.php";
} elseif ($_POST['submit'] === "auth" || $_POST['submit'] === "login") {
    UserController::actionLogin();
} elseif ($_POST['submit'] === "logout") {
    UserController::actionLogout();
} elseif ($_POST['submit'] === "register" || $_POST['submit'] === "reg") {
	UserController::actionRegister();
} elseif ($_POST['submit'] === "edit" || $_POST['submit'] === "editBtn") {
	UserController::actionEdit();
} elseif ($_POST['submit'] === "delete" || $_POST['submit'] === "deleteBtn") {
	UserController::actionDelete();
}