<?php require_once ROOT . "/layouts/header.php"; ?>

	<div class="container">
		<?php if ( $errors === false ) : ?>
			<div class="row justify-content-center">
				<p class='h3 text-success'>Данные отредактированы</p>
				<button onclick="location.href='index.php'" class="btn btn-primary btn-block">На главную</button>
			</div>
		<?php else : ?>
			<p class="h2 text-center text-uppercase">Редактировать данные</p>

			<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="">
				<div class="form-group row">
					<label for="first_name" class="col-sm-4 col-form-label">Имя</label>
					<div class="col-sm-8">
						<input type="text" name="first_name" class="form-control" id="first_name"
						       placeholder="Имя" value="<?= $_POST['first_name'] ? $_POST['first_name'] : $user['first_name'] ?>">
					</div>
				</div>
				<div class="form-group row">
					<label for="last_name" class="col-sm-4 col-form-label">Фамилия</label>
					<div class="col-sm-8">
						<input type="text" name="last_name" class="form-control" id="last_name"
						       placeholder="Фамилия" value="<?= $_POST['last_name'] ? $_POST['last_name'] : $user['last_name'] ?>">
					</div>
				</div>
				<div class="form-group">
					<?php
					if ( ( $_POST['submit'] === "editBtn" ) ) {
						foreach ( $errors as $error ) {
							echo "<p class='text-danger'>$error</p>";
						}
					}
					?>
				</div>
				<div class="form-group justify-content-center">
					<div class="">
						<button type="submit" name="submit" value="editBtn" class="btn btn-primary btn-block">Изменить
						</button>
					</div>
				</div>
			</form>
			<button onclick="location.href='index.php'" class="btn btn-primary btn-block">На главную</button>

		<?php endif; ?>
	</div>

<?php require_once ROOT . "/layouts/footer.php"; ?>