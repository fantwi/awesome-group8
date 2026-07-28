<?php
require_once __DIR__ . '/includes/bootstrap.php';
$pageTitle = 'JavaScript Pop-ups';
$activePage = 'popups';
require __DIR__ . '/includes/header.php';
?>
<section class="page-hero compact">
    <div class="container narrow">
        <span class="eyebrow">JavaScript demonstration</span>
        <h1>Three native browser pop-ups.</h1>
        <p>Use the controls below to test alert, confirm and prompt dialogue boxes.</p>
    </div>
</section>
<section class="section container">
    <div class="popup-grid">
        <article>
            <span>01</span><h2>Alert</h2>
            <p>Displays an informational message and an OK button.</p>
            <button class="button secondary dark" type="button" data-popup="alert">Try alert()</button>
        </article>
        <article>
            <span>02</span><h2>Confirm</h2>
            <p>Asks the visitor to accept or cancel a proposed action.</p>
            <button class="button secondary dark" type="button" data-popup="confirm">Try confirm()</button>
        </article>
        <article>
            <span>03</span><h2>Prompt</h2>
            <p>Requests a short text response from the visitor.</p>
            <button class="button secondary dark" type="button" data-popup="prompt">Try prompt()</button>
        </article>
    </div>
    <div class="popup-result" data-popup-result aria-live="polite">Your pop-up result will appear here.</div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
