<?php
require_once __DIR__ . '/includes/bootstrap.php';
require_login();
require_once __DIR__ . '/config/database.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT) ?: filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$editing = (bool) $id;
$record = ['company_name' => '', 'contact_person' => '', 'email' => '', 'phone' => '', 'service_type' => 'Information Systems', 'status' => 'Lead'];
$errors = [];

if ($editing) {
    $statement = $pdo->prepare('SELECT * FROM clients WHERE id = ?');
    $statement->execute([$id]);
    $found = $statement->fetch();
    if (!$found) {
        $_SESSION['flash'] = ['type' => 'error', 'message' => 'The requested record does not exist.'];
        redirect('dashboard.php');
    }
    $record = array_merge($record, $found);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    verify_csrf();
    foreach (array_keys($record) as $key) {
        if (array_key_exists($key, $_POST)) {
            $record[$key] = trim((string) $_POST[$key]);
        }
    }
    if ($record['company_name'] === '' || mb_strlen($record['company_name']) > 120) $errors[] = 'Company name is required and must not exceed 120 characters.';
    if ($record['contact_person'] === '' || mb_strlen($record['contact_person']) > 100) $errors[] = 'Contact person is required and must not exceed 100 characters.';
    if (!filter_var($record['email'], FILTER_VALIDATE_EMAIL)) $errors[] = 'Enter a valid email address.';
    if (!in_array($record['service_type'], ['Information Systems', 'Data Management', 'Digital Advisory', 'Support'], true)) $errors[] = 'Select a valid service.';
    if (!in_array($record['status'], ['Lead', 'Active', 'Inactive'], true)) $errors[] = 'Select a valid status.';

    if (!$errors) {
        $values = [$record['company_name'], $record['contact_person'], $record['email'], $record['phone'], $record['service_type'], $record['status']];
        if ($editing) {
            $statement = $pdo->prepare('UPDATE clients SET company_name=?, contact_person=?, email=?, phone=?, service_type=?, status=? WHERE id=?');
            $statement->execute([...$values, $id]);
            $message = 'Record updated successfully.';
        } else {
            $statement = $pdo->prepare('INSERT INTO clients (company_name, contact_person, email, phone, service_type, status) VALUES (?, ?, ?, ?, ?, ?)');
            $statement->execute($values);
            $message = 'Record added successfully.';
        }
        $_SESSION['flash'] = ['type' => 'success', 'message' => $message];
        redirect('dashboard.php');
    }
}

$pageTitle = $editing ? 'Update Record' : 'Add Record';
$activePage = 'dashboard';
require __DIR__ . '/includes/header.php';
?>
<section class="page-hero compact">
    <div class="container narrow"><span class="eyebrow"><?= $editing ? 'Update record' : 'Add record' ?></span><h1><?= $editing ? 'Edit client information.' : 'Create a client record.' ?></h1><p>Complete the fields below. Required information is marked by the browser.</p></div>
</section>
<section class="section container narrow-form">
    <?php if ($errors): ?><div class="alert-box error" role="alert"><ul><?php foreach ($errors as $error): ?><li><?= e($error) ?></li><?php endforeach; ?></ul></div><?php endif; ?>
    <form method="post" class="form-card form-grid">
        <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
        <?php if ($editing): ?><input type="hidden" name="id" value="<?= (int) $id ?>"><?php endif; ?>
        <label>Company name<input type="text" name="company_name" value="<?= e($record['company_name']) ?>" required maxlength="120"></label>
        <label>Contact person<input type="text" name="contact_person" value="<?= e($record['contact_person']) ?>" required maxlength="100"></label>
        <label>Email address<input type="email" name="email" value="<?= e($record['email']) ?>" required></label>
        <label>Telephone<input type="tel" name="phone" value="<?= e($record['phone']) ?>" maxlength="30"></label>
        <label>Service
            <select name="service_type"><?php foreach (['Information Systems', 'Data Management', 'Digital Advisory', 'Support'] as $option): ?><option <?= $record['service_type'] === $option ? 'selected' : '' ?>><?= e($option) ?></option><?php endforeach; ?></select>
        </label>
        <label>Status
            <select name="status"><?php foreach (['Lead', 'Active', 'Inactive'] as $option): ?><option <?= $record['status'] === $option ? 'selected' : '' ?>><?= e($option) ?></option><?php endforeach; ?></select>
        </label>
        <div class="button-row full"><button class="button primary" type="submit"><?= $editing ? 'Update record' : 'Add record' ?></button><a class="button secondary dark" href="dashboard.php">Cancel</a></div>
    </form>
</section>
<?php require __DIR__ . '/includes/footer.php'; ?>
