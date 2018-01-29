<?php require_once ROOT . "/layouts/header.php"; ?>

    <div class="container">
		<?php if ( isset( $_SESSION['user'] ) ) : ?>
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="form-row">
                <div class="form-group col-md-6 row justify-content-center">
                    <div class="col-sm-10">
                        <button type="submit" name="submit" value="logout" class="btn btn-primary btn-block">Sign out
                        </button>
                    </div>
                </div>
                <div class="form-group col-md-6 row justify-content-center">
                    <div class="col-sm-10">
                        <button type="submit" name="submit" value="edit" class="btn btn-primary btn-block">Edit user
                        </button>
                    </div>
                </div>
                <div class="form-group col-md-6 row justify-content-center">
                    <div class="col-sm-10">
                        <button type="submit" name="submit" value="delete" class="btn btn-primary btn-block">Delete my account
                        </button>
                    </div>
                </div>
            </form>
		<?php else : ?>
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" class="form-row">
                <div class="form-group col-md-6 row justify-content-center">
                    <div class="col-sm-10">
                        <button type="submit" name="submit" value="auth" class="btn btn-primary btn-block">Sign in
                        </button>
                    </div>
                </div>
                <div class="form-group col-md-6 row justify-content-center">
                    <div class="col-sm-10">
                        <button type="submit" name="submit" value="register" class="btn btn-primary btn-block">Register
                        </button>
                    </div>
                </div>
            </form>
		<?php endif; ?>
    </div>

<?php require_once ROOT . "/layouts/footer.php"; ?>