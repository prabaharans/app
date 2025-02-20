<!DOCTYPE html>
<html>
<head>
    <title>Password Reset Request</title>
</head>
<body>
    <h1>Request Password Reset</h1>
    <form action="<?= site_url('password/reset-request') ?>" method="post">
        <?= csrf_field() ?>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <input type="submit" value="Request Reset Link">
    </form>
</body>
</html>