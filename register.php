<?php
require_once __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/config/database.php';

if (!empty($_SESSION['user_id'])) {
    redirect('dashboard.php');
}

$errors = [];
$name = '';
$email = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $name = trim((string) ($_POST['name'] ?? ''));
    $email = strtolower(trim((string) ($_POST['email'] ?? '')));
    $password = (string) ($_POST['password'] ?? '');
    $confirmation = (string) ($_POST['password_confirmation'] ?? '');

    if (mb_strlen($name) < 2 || mb_strlen($name) > 100) {
        $errors[] = 'Enter a full name between 2 and 100 characters.';
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Enter a valid email address.';
    }
    if (strlen($password) < 8) {
        $errors[] = 'Password must contain at least 8 characters.';
    }
    if ($password !== $confirmation) {
        $errors[] = 'Passwords do not match.';
    }

    if (!$errors) {
        $check = $pdo->prepare('SELECT id FROM users WHERE email = ?');
        $check->execute([$email]);
        if ($check->fetch()) {
            $errors[] = 'An account already exists for this email address.';
        } else {
            $statement = $pdo->prepare('INSERT INTO users (full_name, email, password_hash) VALUES (?, ?, ?)');
            $statement->execute([$name, $email, password_hash($password, PASSWORD_DEFAULT)]);
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Registration complete. You can now log in.'];
            redirect('login.php');
        }
    }
}

$pageTitle = 'Register';
$activePage = 'register';
require __DIR__ . '/includes/header.php';
?>
<section class="auth-section">
    <div class="auth-intro">
        <a class="brand footer-brand" href="index.php"><span class="brand-mark">AG</span><span>Awesome Group<small>Company</small></span></a>
        <div><span class="eyebrow light">Secure company portal</span><h1>Create your account.</h1><p>Register to access and manage the company’s client information records.</p></div>
    </div>
    <div class="auth-form-wrap">
        <div class="auth-form">
            <span class="eyebrow">Get started</span>
            <h2>Registration</h2>
            <?php if ($errors): ?>
                <div class="alert-box error" role="alert"><ul><?php foreach ($errors as $error): ?><li><?= e($error) ?></li><?php endforeach; ?></ul></div>
            <?php endif; ?>
            <form method="post">
                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                <label>Full name<input type="text" name="name" value="<?= e($name) ?>" required autocomplete="name"></label>
                <label>Email address<input type="email" name="email" value="<?= e($email) ?>" required autocomplete="email"></label>
                <label>Password<input type="password" name="password" required minlength="8" autocomplete="new-password"></label>
                <label>Confirm password<input type="password" name="password_confirmation" required minlength="8" autocomplete="new-password"></label>
                <button class="button primary full-button" type="submit">Create account</button>
            </form>
            <p class="auth-switch">Already registered? <a href="login.php">Log in</a></p>
        </div>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
