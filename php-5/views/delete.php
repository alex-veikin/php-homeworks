<?php require_once ROOT . "/layouts/header.php"; ?>

	<div class="container">
		<?php if ( isset( $_SESSION['user'] ) ) : ?>
			<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="form-row">
				<div class="form-group justify-content-center">
					<div class="">
						<button type="submit" name="submit" value="deleteBtn" class="btn btn-primary btn-block">Удалить ?
						</button>
					</div>
				</div>
			</form>
		<?php else : ?>
			<div class="row justify-content-center">
				<p class='h3 text-success'>Аккаунт удален</p>
				<button onclick="location.href='index.php'" class="btn btn-primary btn-block">На главную</button>
			</div>
		<?php endif; ?>
	</div>

<?php require_once ROOT . "/layouts/footer.php"; ?>