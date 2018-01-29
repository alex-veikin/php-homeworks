<?php

class User {


	/**
	 * Проверка email на уникальность
	 * @param $email
	 *
	 * @return bool
	 */
	public static function checkEmailExists( $email ) {
		//Подключение к базе
		$db = Db::getConnection();

		$stmt = 'SELECT COUNT(*) FROM users WHERE email = :email';

		$result = $db->prepare( $stmt );
		$result->bindParam( ':email', $email, PDO::PARAM_STR );
		$result->execute();

		return $result->fetchColumn() ? true : false;
	}


	/**
	 * Проверка логина на уникальность
	 * @param $login
	 *
	 * @return bool
	 */
	public static function checkLoginExists( $login ) {
		//Подключение к базе
		$db = Db::getConnection();

		$stmt = 'SELECT COUNT(*) FROM users WHERE login = :login';

		$result = $db->prepare( $stmt );
		$result->bindParam( ':login', $login, PDO::PARAM_STR );
		$result->execute();

		return $result->fetchColumn() ? true : false;
	}


	/**
	 * Регистрация пользователя, запись в базу данных
	 * @param $first_name
	 * @param $last_name
	 * @param $login
	 * @param $email
	 * @param $gender
	 * @param $password
	 *
	 * @return bool
	 */
	public static function register( $first_name, $last_name, $login, $email, $gender, $password ) {
		// Соединение с БД
		$db = Db::getConnection();

		$stmt = 'INSERT INTO users (first_name, last_name, login, email, gender, password) ' .
		        'VALUES (:first_name, :last_name, :login, :email, :gender, :password)';

		$result = $db->prepare( $stmt );
		$result->bindParam( ':first_name', $first_name, PDO::PARAM_STR );
		$result->bindParam( ':last_name', $last_name, PDO::PARAM_STR );
		$result->bindParam( ':login', $login, PDO::PARAM_STR );
		$result->bindParam( ':email', $email, PDO::PARAM_STR );
		$result->bindParam( ':gender', $gender, PDO::PARAM_STR );
		$result->bindParam( ':password', $password, PDO::PARAM_STR );

		return $result->execute();
	}


	/**
	 * Регистрация пользователя, запись в базу данных
	 * @param $id
	 * @param $first_name
	 * @param $last_name
	 *
	 * @return bool
	 */
	public static function edit( $id, $first_name, $last_name ) {
		// Соединение с БД
		$db = Db::getConnection();

		$stmt = 'UPDATE users SET first_name = :first_name, last_name = :last_name WHERE id = :id';

		$result = $db->prepare( $stmt );
		$result->bindParam( ':id', $id, PDO::PARAM_INT );
		$result->bindParam( ':first_name', $first_name, PDO::PARAM_STR );
		$result->bindParam( ':last_name', $last_name, PDO::PARAM_STR );

		return $result->execute();
	}


	/**
	 * Удаление пользователя
	 * @param $id
	 *
	 * @return bool
	 */
	public static function delete( $id ) {
		// Соединение с БД
		$db = Db::getConnection();

		$stmt = 'DELETE FROM users WHERE id = :id';

		$result = $db->prepare( $stmt );
		$result->bindParam( ':id', $id, PDO::PARAM_INT );

		return $result->execute();
	}


	/**
	 * Проверяем существует ли пользователь с заданными $login и $password
	 * @param string $login
	 * @param string $password
	 *
	 * @return mixed : integer user id or false
	 */
	public static function checkUser( $login, $password ) {
		// Соединение с БД
		$db = Db::getConnection();

		$stmt = 'SELECT * FROM users WHERE login = :login AND password = :password';

		$result = $db->prepare( $stmt );
		$result->bindParam( ':login', $login, PDO::PARAM_STR );
		$result->bindParam( ':password', $password, PDO::PARAM_STR );
		$result->execute();

		$user = $result->fetch();

		if ( $user ) {
			// Если запись существует, возвращаем id пользователя
			return $user['id'];
		}

		return false;
	}


	/**
	 * Получаем данные пользователя
	 * @param integer $userId
	 *
	 * @return string user name
	 */
	public static function getUser( $userId ) {
		// Соединение с БД
		$db = Db::getConnection();

		$stmt = 'SELECT * FROM users WHERE id = :id';

		$result = $db->prepare( $stmt );
		$result->bindParam( ':id', $userId, PDO::PARAM_INT );
		$result->execute();

		return $result->fetch();
	}

}