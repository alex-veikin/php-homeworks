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

	private function checkLength( $field, $min, $max ) {
		return ( mb_strlen( $field ) >= $min ) && ( mb_strlen( $field ) <= $max );
	}

	private function checkSpace( $field ) {
		return mb_strpos( trim( $field ), " " ) === false;
	}

	private function checkEmailExists() {
		$db = Db::getConnection();

		$result = $db->prepare( 'SELECT COUNT(*) FROM users WHERE email = :email' );
		$result->bindParam( ':email', $this->email, PDO::PARAM_STR );
		$result->execute();

		return $result->fetchColumn() ? true : false;
	}

	private function checkLoginExists() {
		$db = Db::getConnection();

		$result = $db->prepare( 'SELECT COUNT(*) FROM users WHERE login = :login' );
		$result->bindParam( ':login', $this->login, PDO::PARAM_STR );
		$result->execute();

		return $result->fetchColumn() ? true : false;
	}

	private function checkGender() {
		return $this->gender === "male" || $this->gender === "female";
	}

	private function checkPassword() {
		return ( preg_match( "/^[\da-zA-Z_]+$/", $this->password ) ) ? true : false;
	}


	public function checkForm() {
		$errors = false;

		// Валидация полей
		if ( ! $this->first_name ) {
			$errors[] = "Введите имя";
		} else {
			if ( ! self::checkLength( $this->first_name, 2, 30 ) ) {
				$errors[] = 'Имя должно быть от 2 до 30 символов';
			} elseif ( ! self::checkSpace( $this->first_name ) ) {
				$errors[] = "Имя не должно содержать пробелы";
			}
		}

		if ( ! $this->last_name ) {
			$errors[] = "Введите фамилию";
		} else {
			if ( ! self::checkLength( $this->last_name, 2, 30 ) ) {
				$errors[] = 'Фамилия должна быть от 2 до 30 символов';
			} elseif ( ! self::checkSpace( $this->last_name ) ) {
				$errors[] = "Фамилия не должна содержать пробелы";
			}
		}

		if ( ! $this->login ) {
			$errors[] = "Введите логин";
		} else {
			if ( ! self::checkLength( $this->login, 4, 30 ) ) {
				$errors[] = 'Логин должен быть от 4 до 30 символов';
			} elseif ( ! self::checkSpace( $this->login ) ) {
				$errors[] = "Логин не должен содержать пробелы";
			} elseif ( self::checkLoginExists() ) {
				$errors[] = 'Такой логин уже используется';
			}
		}

		if ( ! $this->email ) {
			$errors[] = 'Введите email';
		} else {
			if ( ! filter_var( $this->email, FILTER_VALIDATE_EMAIL ) ) {
				$errors[] = 'Некорректный email';
			} elseif ( self::checkEmailExists() ) {
				$errors[] = 'Такой email уже используется';
			}
		}

		if ( ! $this->gender || ! self::checkGender() ) {
			$errors[] = 'Укажите пол';
		}

		if ( ! $this->password ) {
			$errors[] = "Введите пароль";
		} else {
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

		if ( $errors === false ) {
			return true;
		} else {
			self::$errors = $errors;
			return false;
		}
	}
}