<?php

class UserController {


	/**
	 * Проверка строки на мин/макс длину
	 * @param $field
	 * @param $min
	 * @param $max
	 *
	 * @return bool
	 */
	private static function checkLength( $field, $min, $max ) {
		return ( mb_strlen( $field ) >= $min ) && ( mb_strlen( $field ) <= $max );
	}


	/**
	 * Проверка строки на пробелы
	 * @param $field
	 *
	 * @return bool
	 */
	private static function checkSpace( $field ) {
		return mb_strpos( trim( $field ), " " ) === false;
	}


	/**
	 * Проверка пароля на допустимое значение
	 * @param $password
	 *
	 * @return bool
	 */
	private static function checkPassword( $password ) {
		return ( preg_match( "/^[\da-zA-Z_]+$/", $password ) ) ? true : false;
	}


	/**
	 * Проверка всех введенных данных в форме
	 * и регистрация
	 * @return bool
	 */
	public static function actionRegister() {
		$_POST['first_name']       = trim( strip_tags( $_POST['first_name'] ) );
		$_POST['last_name']        = trim( strip_tags( $_POST['last_name'] ) );
		$_POST['login']            = trim( strip_tags( $_POST['login'] ) );
		$_POST['email']            = trim( strip_tags( $_POST['email'] ) );
		$_POST['gender']           = trim( strip_tags( $_POST['gender'] ) );
		$_POST['password']         = trim( strip_tags( $_POST['password'] ) );
		$_POST['password_confirm'] = trim( strip_tags( $_POST['password_confirm'] ) );
		$errors                    = false;

		// Валидация полей
		if ( ! $_POST['first_name'] || ! $_POST['last_name'] || ! $_POST['login'] || ! $_POST['email'] ||
		     ! $_POST['gender'] || ! $_POST['password'] || ! $_POST['password_confirm'] ) {
			$errors[] = "Заполните все поля";
		}

		if ( $_POST['first_name'] ) {
			if ( ! self::checkLength( $_POST['first_name'], 2, 30 ) ) {
				$errors[] = 'Имя должно быть от 2 до 30 символов';
			} elseif ( ! self::checkSpace( $_POST['first_name'] ) ) {
				$errors[] = "Имя не должно содержать пробелы";
			}
		}

		if ( $_POST['last_name'] ) {
			if ( ! self::checkLength( $_POST['last_name'], 2, 30 ) ) {
				$errors[] = 'Фамилия должна быть от 2 до 30 символов';
			} elseif ( ! self::checkSpace( $_POST['last_name'] ) ) {
				$errors[] = "Фамилия не должна содержать пробелы";
			}
		}

		if ( $_POST['login'] ) {
			if ( ! self::checkLength( $_POST['login'], 4, 30 ) ) {
				$errors[] = 'Логин должен быть от 4 до 30 символов';
			} elseif ( ! self::checkSpace( $_POST['login'] ) ) {
				$errors[] = "Логин не должен содержать пробелы";
			} elseif ( User::checkLoginExists( $_POST['login'] ) ) {
				$errors[] = 'Такой логин уже используется';
			}
		}

		if ( $_POST['email'] ) {
			if ( ! filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ) ) {
				$errors[] = 'Некорректный email';
			} elseif ( User::checkEmailExists( $_POST['email'] ) ) {
				$errors[] = 'Такой email уже используется';
			}
		}

		if ( $_POST['gender'] ) {
			if ( $_POST['gender'] !== "male" && $_POST['gender'] !== "female" ) {
				$errors[] = 'Укажите пол';
			}
		}

		if ( $_POST['password'] ) {
			if ( ! self::checkLength( $_POST['password'], 6, 20 ) ) {
				$errors[] = 'Пароль должен быть от 6 до 20 символов';
			} elseif ( ! self::checkPassword( $_POST['password'] ) ) {
				$errors[] = "Пароль должен состоять из цифр, букв латинского алфавита верхнего и нижнего регистра, и знака _";
			} else {
				if ( ! $_POST['password_confirm'] ) {
					$errors[] = "Подтвердите пароль";
				} elseif ( $_POST['password_confirm'] !== $_POST['password'] ) {
					$errors[] = 'Пароли не совпадают';
				}
			}
		}

		if ( $errors === false ) { //Если ошибок нет
			User::register( $_POST['first_name'], $_POST['last_name'], $_POST['login'], $_POST['email'], $_POST['gender'], $_POST['password'] );

			unset( $_POST['first_name'] );
			unset( $_POST['last_name'] );
			unset( $_POST['login'] );
			unset( $_POST['email'] );
			unset( $_POST['gender'] );
			unset( $_POST['password'] );
			unset( $_POST['password_confirm'] );
		}

		// Подключаем вид
		require_once( ROOT . '/views/register.php' );

		return true;
	}


	/**
	 * Проверка всех введенных данных в форме
	 * и редактирование данных
	 * @return bool
	 */
	public static function actionEdit() {
		$userId = $_SESSION['user'];

		$user = User::getUser($userId);


		$_POST['first_name'] = trim( strip_tags( $_POST['first_name'] ) );
		$_POST['last_name']  = trim( strip_tags( $_POST['last_name'] ) );
		$errors              = false;

		// Валидация полей
		if ( ! $_POST['first_name'] || ! $_POST['last_name'] ) {
			$errors[] = "Заполните все поля";
		}

		if ( $_POST['first_name'] ) {
			if ( ! self::checkLength( $_POST['first_name'], 2, 30 ) ) {
				$errors[] = 'Имя должно быть от 2 до 30 символов';
			} elseif ( ! self::checkSpace( $_POST['first_name'] ) ) {
				$errors[] = "Имя не должно содержать пробелы";
			}
		}

		if ( $_POST['last_name'] ) {
			if ( ! self::checkLength( $_POST['last_name'], 2, 30 ) ) {
				$errors[] = 'Фамилия должна быть от 2 до 30 символов';
			} elseif ( ! self::checkSpace( $_POST['last_name'] ) ) {
				$errors[] = "Фамилия не должна содержать пробелы";
			}
		}

		if ( $errors === false ) { //Если ошибок нет
			User::edit( $userId, $_POST['first_name'], $_POST['last_name'] );

			unset( $_POST['first_name'] );
			unset( $_POST['last_name'] );
		}

		// Подключаем вид
		require_once( ROOT . '/views/edit.php' );

		return true;
	}


	/**
	 * Удаление аккаунта
	 * @return bool
	 */
	public static function actionDelete() {

		if ($_POST['submit'] === "deleteBtn") {
			User::delete($_SESSION['user']);
			unset($_SESSION['user']);
		}

		// Подключаем вид
		require_once( ROOT . '/views/delete.php' );

		return true;
	}


	/**
	 * Авторизация пользователя
	 * @return bool
	 */
	public static function actionLogin() {
		$_POST['login']    = trim( strip_tags( $_POST['login'] ) );
		$_POST['password'] = trim( strip_tags( $_POST['password'] ) );
		$errors            = false;

		// Валидация полей
		if ( ! $_POST['login'] || ! $_POST['password'] ) {
			$errors[] = "Заполните все поля";
		}

		if ( $_POST['login'] ) {
			if ( ! self::checkLength( $_POST['login'], 4, 30 ) ) {
				$errors[] = 'Логин должен быть от 4 до 30 символов';
			} elseif ( ! self::checkSpace( $_POST['login'] ) ) {
				$errors[] = "Логин не должен содержать пробелы";
			}
		}

		if ( $_POST['password'] ) {
			if ( ! self::checkLength( $_POST['password'], 6, 20 ) ) {
				$errors[] = 'Пароль должен быть от 6 до 20 символов';
			} elseif ( ! self::checkPassword( $_POST['password'] ) ) {
				$errors[] = "Пароль должен состоять из цифр, букв латинского алфавита верхнего и нижнего регистра, и знака _";
			}
		}

		if ( $errors === false ) { //Если ошибок нет
			$userId = User::checkUser( $_POST['login'], $_POST['password'] );

			if ( $userId == false ) {
				$errors[] = "Неверные логин или пароль";
			} else {
				self::auth( $userId );

				unset( $_POST['login'] );
				unset( $_POST['password'] );
			}
		}

		// Подключаем вид
		require_once( ROOT . '/views/login.php' );

		return true;
	}


	/**
	 * Запоминаем пользователя
	 * @param integer $userId
	 */
	public static function auth( $userId ) {
		// Записываем идентификатор пользователя в сессию
		$_SESSION['user'] = $userId;

		return;
	}


	/**
	 * Выход пользователя
	 */
	public static function actionLogout() {
		// Удаляем информацию о пользователе из сессии
		unset( $_SESSION["user"] );

		// Подключаем вид
		require_once( ROOT . '/views/index.php' );

		return true;
	}

	/**
	 * Получаем имя пользователя
	 * @param $id
	 *
	 * @return mixed
	 */
	public static function getUserName( $id ) {
		$user = User::getUser( $id );

		return $user['first_name'];
	}
}