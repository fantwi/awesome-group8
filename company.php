<?php
require_once __DIR__ . '/includes/bootstrap.php';
$pageTitle = 'About the Company';
$activePage = 'company';
require __DIR__ . '/includes/header.php';
?>
<section class="page-hero">
    <div class="container narrow">
        <span class="eyebrow">About Awesome Group</span>
        <h1>Technology built around how people actually work.</h1>
        <p>We help organisations organise information, streamline operations and turn reliable data into confident action.</p>
    </div>
</section>
<section class="section container story-grid">
    <div>
        <span class="eyebrow">Our story</span>
        <h2>A modern company with a practical point of view</h2>
    </div>
    <div class="prose">
        <p>Awesome Group Company is a fictional technology and business services organisation created for this academic project. Its information system demonstrates how a company can securely manage client records while maintaining a welcoming public website.</p>
        <p>Our approach is straightforward: understand the work, protect the information and design an experience that people can use without friction.</p>
    </div>
</section>
<section class="section values-section">
    <div class="container">
        <div class="section-heading"><div><span class="eyebrow">How we work</span><h2>Values that guide every engagement</h2></div></div>
        <div class="value-grid">
            <article><strong>01</strong><h3>Clarity</h3><p>We make complex information easy to understand and act on.</p></article>
            <article><strong>02</strong><h3>Integrity</h3><p>We protect data and communicate honestly at every stage.</p></article>
            <article><strong>03</strong><h3>Curiosity</h3><p>We ask better questions before we begin designing solutions.</p></article>
            <article><strong>04</strong><h3>Impact</h3><p>We measure success by meaningful improvements in real work.</p></article>
        </div>
    </div>
</section>
<section class="section container callout">
    <div><span class="eyebrow">Ready to begin?</span><h2>Let’s improve the way your information works.</h2></div>
    <a class="button primary" href="contact.php">Contact Awesome Group</a>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
