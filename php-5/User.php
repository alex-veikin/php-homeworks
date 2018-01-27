<?php

class User {
	public $first_name;
	public $last_name;
	public $login;
	public $email;
	public $gender;
	private $password;
	private $password_confirm;
	public static $errors = false;

	public function __construct( $first_name, $last_name, $login, $email, $gender, $password, $password_confirm ) {
		$this->first_name       = trim( strip_tags( $first_name ) );
		$this->last_name        = trim( strip_tags( $last_name ) );
		$this->login            = trim( strip_tags( $login ) );
		$this->email            = trim( strip_tags( $email ) );
		$this->gender           = trim( strip_tags( $gender ) );
		$this->password         = trim( strip_tags( $password ) );
		$this->password_confirm = trim( strip_tags( $password_confirm ) );
	}

	//Проверка на мин/макс длину
	private function checkLength( $field, $min, $max ) {
		return ( mb_strlen( $field ) >= $min ) && ( mb_strlen( $field ) <= $max );
	}

	//Проверка данных на пробелы
	private function checkSpace( $field ) {
		return mb_strpos( trim( $field ), " " ) === false;
	}

	//Проверка email на уникальность
	private function checkEmailExists() {
		//Подключение к базе
		$db = Db::getConnection();

		//Запрос
		$stmt = 'SELECT COUNT(*) FROM users WHERE email = :email';

		$result = $db->prepare( $stmt );
		$result->bindParam( ':email', $this->email, PDO::PARAM_STR );
		$result->execute();

		return $result->fetchColumn() ? true : false;
	}

	//Проверка логина на уникальность
	private function checkLoginExists() {
		//Подключение к базе
		$db = Db::getConnection();

		//Запрос
		$stmt = 'SELECT COUNT(*) FROM users WHERE login = :login';

		$result = $db->prepare( $stmt );
		$result->bindParam( ':login', $this->login, PDO::PARAM_STR );
		$result->execute();

		return $result->fetchColumn() ? true : false;
	}

	//Проверка пола на допустимое значение
	private function checkGender() {
		return $this->gender === "male" || $this->gender === "female";
	}

	//Проверка пароля на допустимое значение
	private function checkPassword() {
		return ( preg_match( "/^[\da-zA-Z_]+$/", $this->password ) ) ? true : false;
	}


	//Проверка всех введенных данных в форме
	public function checkForm() {
		$errors = false;

		// Валидация полей
		if ( ! $this->first_name || ! $this->last_name || ! $this->login || ! $this->email ||
		     ! $this->gender || ! $this->password || ! $this->password_confirm ) {
			$errors[] = "Заполните все поля";
		}

		if ( $this->first_name ) {
			if ( ! self::checkLength( $this->first_name, 2, 30 ) ) {
				$errors[] = 'Имя должно быть от 2 до 30 символов';
			} elseif ( ! self::checkSpace( $this->first_name ) ) {
				$errors[] = "Имя не должно содержать пробелы";
			}
		}

		if ( $this->last_name ) {
			if ( ! self::checkLength( $this->last_name, 2, 30 ) ) {
				$errors[] = 'Фамилия должна быть от 2 до 30 символов';
			} elseif ( ! self::checkSpace( $this->last_name ) ) {
				$errors[] = "Фамилия не должна содержать пробелы";
			}
		}

		if ( $this->login ) {
			if ( ! self::checkLength( $this->login, 4, 30 ) ) {
				$errors[] = 'Логин должен быть от 4 до 30 символов';
			} elseif ( ! self::checkSpace( $this->login ) ) {
				$errors[] = "Логин не должен содержать пробелы";
			} elseif ( self::checkLoginExists() ) {
				$errors[] = 'Такой логин уже используется';
			}
		}

		if ( $this->email ) {
			if ( ! filter_var( $this->email, FILTER_VALIDATE_EMAIL ) ) {
				$errors[] = 'Некорректный email';
			} elseif ( self::checkEmailExists() ) {
				$errors[] = 'Такой email уже используется';
			}
		}

		if ( $this->gender ) {
			if ( $this->gender !== "male" && $this->gender !== "female" ) {
				$errors[] = 'Укажите пол';
			}
		}

		if ( $this->password ) {
			if ( ! self::checkLength( $this->password, 6, 20 ) ) {
				$errors[] = 'Пароль должен быть от 6 до 20 символов';
			} elseif ( ! self::checkPassword() ) {
				$errors[] = "Пароль должен состоять из цифр, букв латинского алфавита верхнего и нижнего регистра, и знака _";
			} else {
				if ( ! $this->password_confirm ) {
					$errors[] = "Подтвердите пароль";
				} elseif ( $this->password_confirm !== $this->password ) {
					$errors[] = 'Пароли не совпадают';
				}
			}
		}

		if ( $errors === false ) { //Если ошибок нет
			return true;
		} else { //Если ошибки есть
			self::$errors = $errors; //Записываем ошибки в $errors

			return false;
		}
	}

	public function registerUser() {
		// Соединение с БД
		$db = Db::getConnection();

		//Запрос
		$stmt = 'INSERT INTO users (first_name, last_name, login, email, gender, password) ' .
		        'VALUES (:first_name, :last_name, :login, :email, :gender, :password)';

		$result = $db->prepare( $stmt );
		$result->bindParam( ':first_name', $this->first_name, PDO::PARAM_STR );
		$result->bindParam( ':last_name', $this->last_name, PDO::PARAM_STR );
		$result->bindParam( ':login', $this->login, PDO::PARAM_STR );
		$result->bindParam( ':email', $this->email, PDO::PARAM_STR );
		$result->bindParam( ':gender', $this->gender, PDO::PARAM_STR );
		$result->bindParam( ':password', $this->password, PDO::PARAM_STR );

		return $result->execute();
	}
}