<?php require_once ROOT . "/layouts/header.php"; ?>

<!--	--><?php //var_dump($user); ?>
	<div class="container">
		<?php if ( $errors === false ) : ?>
			<div class="row justify-content-center">
				<p class='h3 text-success'>Данные отредактированы</p>
				<button onclick="location.href='index.php'" class="btn btn-primary btn-block">Back</button>
			</div>
		<?php else : ?>
			<p class="h2 text-center text-uppercase">Редактировать данные</p>

			<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="form">
				<div class="form-group col-sm-10 col-md-8 col-lg-6 row">
					<label for="first_name" class="col-sm-4 col-form-label">Имя</label>
					<div class="col-sm-8">
						<input type="text" name="first_name" class="form-control" id="first_name"
						       placeholder="First name" value="<?= $_POST['first_name'] ? $_POST['first_name'] : $user['first_name'] ?>">
					</div>
				</div>
				<div class="form-group col-sm-10 col-md-8 col-lg-6 row">
					<label for="last_name" class="col-sm-4 col-form-label">Фамилия</label>
					<div class="col-sm-8">
						<input type="text" name="last_name" class="form-control" id="last_name"
						       placeholder="Last name" value="<?= $_POST['last_name'] ? $_POST['last_name'] : $user['last_name'] ?>">
					</div>
				</div>
				<div class="form-group col-sm-10 col-md-8 col-lg-6">
					<?php
					if ( ( $_POST['submit'] === "editBtn" ) ) {
						foreach ( $errors as $error ) {
							echo "<p class='text-danger'>$error</p>";
						}
					}
					?>
				</div>
				<div class="form-group col-md-6 row justify-content-center">
					<div class="col-sm-10">
						<button type="submit" name="submit" value="editBtn" class="btn btn-primary btn-block">Изменить
						</button>
					</div>
				</div>
			</form>
			<button onclick="location.href='index.php'" class="btn btn-primary btn-block">Back</button>

		<?php endif; ?>
	</div>

<?php require_once ROOT . "/layouts/footer.php"; ?>