<?php

class Db {

	public static function getConnection() {
		$host = "localhost";
		$database = "itstep_users";
		$user = "root";
		$password = "";
		$charset = "utf8";

		$dsn = "mysql:host=$host;dbname=$database;charset=$charset";
		$options = array(
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES   => false
		);

		$db  = new PDO($dsn, $user, $password, $options);

		return $db;
	}

}