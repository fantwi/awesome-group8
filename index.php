<?php
require_once __DIR__ . '/includes/bootstrap.php';
$pageTitle = 'Home';
$activePage = 'home';
require __DIR__ . '/includes/header.php';

// $members = [
//     ['name' => 'Ebenezer Nana Annan', 'id' => 'MS/ITE/25/0041', 'image' => 'assets/images/ebenezer.svg', 'role' => 'Project Coordinator'],
//     ['name' => 'Okyere-Darko Addai', 'id' => 'MS/ITE/25/0044', 'image' => 'assets/images/okyere.svg', 'role' => 'Database Developer'],
//     ['name' => 'Frank Akrasi Antwi', 'id' => 'MS/ITE/25/0051', 'image' => 'assets/images/frank.svg', 'role' => 'Frontend Developer'],
//     ['name' => 'Michael Essel', 'id' => 'MS/ITE/25/0053', 'image' => 'assets/images/michael.svg', 'role' => 'Quality Assurance'],
// ];
$members = [
    [
        'name' => 'Ebenezer Nana Annan',
        'id' => 'MS/ITE/25/0041',
        'image' => 'assets/images/ebenezer.jpeg',
        'role' => 'Group Member'
    ],
    [
        'name' => 'Okyere-Darko Addai',
        'id' => 'MS/ITE/25/0044',
        'image' => 'assets/images/okyere.jpeg',
        'role' => 'Group Member'
    ],
    [
        'name' => 'Frank Akrasi Antwi',
        'id' => 'MS/ITE/25/0051',
        'image' => 'assets/images/frank.jpeg',
        'role' => 'Group Member'
    ],
    [
        'name' => 'Michael Essel',
        'id' => 'MS/ITE/25/0053',
        'image' => 'assets/images/michael.jpeg',
        'role' => 'Group Member'
    ],
];
?>
<section class="hero">
    <div class="container hero-grid">
        <div class="hero-copy">
            <span class="eyebrow">Information that moves business forward</span>
            <h1>Smarter systems.<br><span>Stronger decisions.</span></h1>
            <p>Awesome Group Company combines people, data and practical technology to help growing organisations work with confidence.</p>
            <div class="button-row">
                <a class="button primary" href="company.php">Discover our company</a>
                <a class="button secondary" href="contact.php">Talk to our team</a>
            </div>
            <div class="hero-stats" aria-label="Company highlights">
                <div><strong>4</strong><span>Specialists</span></div>
                <div><strong>24/7</strong><span>System access</span></div>
                <div><strong>100%</strong><span>Client focus</span></div>
            </div>
        </div>
        <div class="slider" data-slider aria-label="Company image showcase">
            <img src="assets/images/slide-1.svg" alt="Abstract illustration of business analytics" data-slide>
            <div class="slider-overlay">
                <span data-slide-count>01 / 05</span>
                <p data-slide-caption>Business intelligence that turns activity into insight.</p>
            </div>
            <button class="slider-button previous" type="button" data-slide-prev aria-label="Previous image">&#8592;</button>
            <button class="slider-button next" type="button" data-slide-next aria-label="Next image">&#8594;</button>
        </div>
    </div>
</section>

<section class="ticker" aria-label="Announcements">
    <span class="ticker-label">Latest</span>
    <p data-scrolling-text>Welcome to Awesome Group Company — Explore our services, meet Group 8 and access the secure company records portal.</p>
</section>

<section class="section container">
    <div class="section-heading">
        <div>
            <span class="eyebrow">Meet Group 8</span>
            <h2>The people behind the system</h2>
        </div>
        <p>Developed for the Web Development course in the MSc Information Technology programme at the University of Cape Coast.</p>
    </div>
    <div class="member-grid">
        <?php foreach ($members as $member): ?>
            <article class="member-card">
                <img src="<?= e($member['image']) ?>" alt="Profile placeholder for <?= e($member['name']) ?>">
                <div class="member-details">
                    <span><?= e($member['role']) ?></span>
                    <h3><?= e($member['name']) ?></h3>
                    <p><?= e($member['id']) ?></p>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<section class="section services-section">
    <div class="container">
        <div class="section-heading">
            <div><span class="eyebrow">What we do</span><h2>Digital capability with purpose</h2></div>
            <a class="text-link" href="company.php">Learn more about us &#8594;</a>
        </div>
        <div class="service-grid">
            <article><span>01</span><h3>Information Systems</h3><p>Secure, usable systems that keep essential company information organised.</p></article>
            <article><span>02</span><h3>Data Management</h3><p>Reliable records and reporting for faster, evidence-led decisions.</p></article>
            <article><span>03</span><h3>Digital Advisory</h3><p>Practical guidance that aligns technology with everyday business needs.</p></article>
        </div>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
