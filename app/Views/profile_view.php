<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?>User Profile <?= $this->endSection() ?>

<?= $this->section('main') ?>
<?= $this->include(config('Auth')->views['menu_layout']) ?>
    <div class="container d-flex justify-content-center p-5">

        <div class="card col-12 col-md-5 shadow-sm">
            <div class="card-body">
                <h5 class="card-title mb-5">User Profile</h5>
                <form action="<?= site_url('profile/update') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="username" name="username" value="<?= esc($user->username) ?>" required>
                        <label for="username">Username:</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" value="<?= esc($user->email) ?>" required>
                        <label for="email">Email:</label>
                    </div>
                    <div class="d-grid col-12 col-md-8 mx-auto m-3">
                        <input type="submit" class="btn btn-primary btn-block" value="Update Profile">
                    </div>
                </form>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>
