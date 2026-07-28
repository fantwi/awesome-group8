<?php
require_once __DIR__ . '/includes/bootstrap.php';
require_login();
require_once __DIR__ . '/config/database.php';

$records = $pdo->query('SELECT id, company_name, contact_person, email, phone, service_type, status, created_at FROM clients ORDER BY id DESC')->fetchAll();
$total = count($records);
$active = count(array_filter($records, fn(array $record): bool => $record['status'] === 'Active'));
$pageTitle = 'Client Records';
$activePage = 'dashboard';
require __DIR__ . '/includes/header.php';
?>
<section class="dashboard-hero">
    <div class="container dashboard-heading">
        <div><span class="eyebrow light">Information system</span><h1>Client records</h1><p>Welcome, <?= e($_SESSION['user_name'] ?? 'Team member') ?>. Manage company information from one secure workspace.</p></div>
        <a class="button gold" href="record-form.php">+ Add record</a>
    </div>
</section>
<section class="section container dashboard-content">
    <div class="dashboard-stats">
        <article><span>Total records</span><strong><?= $total ?></strong></article>
        <article><span>Active clients</span><strong><?= $active ?></strong></article>
        <article><span>Other statuses</span><strong><?= $total - $active ?></strong></article>
    </div>
    <div class="table-card">
        <div class="table-heading"><div><span class="eyebrow">Retrieve records</span><h2>Company client directory</h2></div><label class="search-label">Search<input type="search" placeholder="Filter records..." data-table-search></label></div>
        <div class="table-responsive">
            <table data-record-table>
                <thead><tr><th>ID</th><th>Company / Contact</th><th>Communication</th><th>Service</th><th>Status</th><th>Actions</th></tr></thead>
                <tbody>
                <?php if (!$records): ?>
                    <tr><td colspan="6" class="empty-state">No records yet. Use “Add record” to create the first one.</td></tr>
                <?php else: ?>
                    <?php foreach ($records as $record): ?>
                        <tr>
                            <td>#<?= (int) $record['id'] ?></td>
                            <td><strong><?= e($record['company_name']) ?></strong><small><?= e($record['contact_person']) ?></small></td>
                            <td><a href="mailto:<?= e($record['email']) ?>"><?= e($record['email']) ?></a><small><?= e($record['phone']) ?></small></td>
                            <td><?= e($record['service_type']) ?></td>
                            <td><span class="status status-<?= strtolower(e($record['status'])) ?>"><?= e($record['status']) ?></span></td>
                            <td class="actions">
                                <a class="icon-button" href="record-form.php?id=<?= (int) $record['id'] ?>">Update</a>
                                <form method="post" action="record-delete.php" data-delete-form>
                                    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
                                    <input type="hidden" name="id" value="<?= (int) $record['id'] ?>">
                                    <button class="icon-button danger" type="submit">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
