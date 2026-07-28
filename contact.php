<?php
require_once __DIR__ . '/includes/bootstrap.php';
$pageTitle = 'Contact';
$activePage = 'contact';
$formSuccess = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    $formSuccess = true;
}
require __DIR__ . '/includes/header.php';
?>
<section class="page-hero compact">
    <div class="container narrow">
        <span class="eyebrow">Contact</span>
        <h1>Start a useful conversation.</h1>
        <p>Tell us what you want to improve. Our team will respond with a clear next step.</p>
    </div>
</section>
<section class="section container contact-grid">
    <aside class="contact-panel">
        <span class="eyebrow light">Reach us</span>
        <h2>We’d be glad to hear from you.</h2>
        <p>School of Physical Sciences<br>University of Cape Coast<br>Cape Coast, Ghana</p>
        <a href="mailto:hello@awesomegroup.test">hello@awesomegroup.test</a>
        <a href="tel:+233000000000">+233 (0) 00 000 0000</a>
        <p class="small-note">Academic demonstration contact details.</p>
    </aside>
    <div class="form-card">
        <?php if ($formSuccess): ?>
            <div class="form-success" role="status">
                <h2>Message received</h2>
                <p>Thank you. This demonstration form has validated your submission successfully.</p>
                <a class="text-link" href="contact.php">Send another message</a>
            </div>
        <?php else: ?>
            <h2>Send a message</h2>
            <form method="post" class="form-grid">
                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                <label>Full name<input type="text" name="name" required autocomplete="name"></label>
                <label>Email address<input type="email" name="email" required autocomplete="email"></label>
                <label class="full">Subject<input type="text" name="subject" required></label>
                <label class="full">Message<textarea name="message" rows="6" required></textarea></label>
                <button class="button primary" type="submit">Send message</button>
            </form>
        <?php endif; ?>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
