<?php
require_once __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/config/database.php';

if (!empty($_SESSION['user_id'])) {
    redirect('dashboard.php');
}

$error = '';
$email = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $email = strtolower(trim((string) ($_POST['email'] ?? '')));
    $password = (string) ($_POST['password'] ?? '');
    $statement = $pdo->prepare('SELECT id, full_name, password_hash FROM users WHERE email = ?');
    $statement->execute([$email]);
    $user = $statement->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        session_regenerate_id(true);
        $_SESSION['user_id'] = (int) $user['id'];
        $_SESSION['user_name'] = $user['full_name'];
        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Welcome back, ' . $user['full_name'] . '.'];
        redirect('dashboard.php');
    }
    $error = 'The email address or password is incorrect.';
}

$pageTitle = 'Login';
$activePage = 'login';
require __DIR__ . '/includes/header.php';
?>
<section class="auth-section">
    <div class="auth-intro">
        <a class="brand footer-brand" href="index.php"><span class="brand-mark">AG</span><span>Awesome Group<small>Company</small></span></a>
        <div><span class="eyebrow light">Secure company portal</span><h1>Your records.<br>One clear view.</h1><p>Sign in to add, retrieve, update and delete client information.</p></div>
    </div>
    <div class="auth-form-wrap">
        <div class="auth-form">
            <span class="eyebrow">Welcome back</span><h2>Account login</h2>
            <?php if ($error): ?><div class="alert-box error" role="alert"><?= e($error) ?></div><?php endif; ?>
            <form method="post">
                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                <label>Email address<input type="email" name="email" value="<?= e($email) ?>" required autocomplete="email"></label>
                <label>Password<input type="password" name="password" required autocomplete="current-password"></label>
                <button class="button primary full-button" type="submit">Log in</button>
            </form>
            <p class="auth-switch">Need an account? <a href="register.php">Register now</a></p>
        </div>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
