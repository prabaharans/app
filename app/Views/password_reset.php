<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <h1>Reset Password</h1>
    <form action="<?= site_url('password/reset') ?>" method="post">
        <?= csrf_field() ?>
        <input type="hidden" name="token" value="<?= esc($token) ?>">

        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" required>

        <input type="submit" value="Reset Password">
    </form>
</body>
</html>