<?php
$pageTitle = $pageTitle ?? 'Awesome Group Company';
$activePage = $activePage ?? '';
$isLoggedIn = !empty($_SESSION['user_id']);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Awesome Group Company information system developed by UCC MSc Information Technology students.">
    <title><?= e($pageTitle) ?> | Awesome Group</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="assets/js/main.js" defer></script>
</head>
<body>
<a class="skip-link" href="#main-content">Skip to content</a>
<header class="site-header">
    <nav class="navbar container" aria-label="Main navigation">
        <a class="brand" href="index.php" aria-label="Awesome Group home">
            <span class="brand-mark">AG</span>
            <span>Awesome Group<small>Company</small></span>
        </a>
        <button class="menu-toggle" type="button" aria-expanded="false" aria-controls="main-menu">Menu</button>
        <ul class="nav-links" id="main-menu">
            <li><a class="<?= $activePage === 'home' ? 'active' : '' ?>" href="index.php">Home</a></li>
            <li><a class="<?= $activePage === 'company' ? 'active' : '' ?>" href="company.php">Company</a></li>
            <li><a class="<?= $activePage === 'contact' ? 'active' : '' ?>" href="contact.php">Contact</a></li>
            <li><a class="<?= $activePage === 'popups' ? 'active' : '' ?>" href="popups.php">Pop-ups</a></li>
            <?php if ($isLoggedIn): ?>
                <li><a class="<?= $activePage === 'dashboard' ? 'active' : '' ?>" href="dashboard.php">Records</a></li>
                <li><a href="logout.php">Log out</a></li>
            <?php else: ?>
                <li><a class="<?= $activePage === 'login' ? 'active' : '' ?>" href="login.php">Login</a></li>
                <li><a class="nav-cta <?= $activePage === 'register' ? 'active' : '' ?>" href="register.php">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
<?php if ($flash = flash_message()): ?>
    <div class="toast <?= e($flash['type'] ?? 'success') ?>" role="status">
        <?= e($flash['message'] ?? '') ?>
    </div>
<?php endif; ?>
<main id="main-content">
