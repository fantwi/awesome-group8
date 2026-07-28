<?php
require_once __DIR__ . '/includes/bootstrap.php';
require_login();
require_once __DIR__ . '/config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method not allowed.');
}
verify_csrf();
$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if ($id) {
    $statement = $pdo->prepare('DELETE FROM clients WHERE id = ?');
    $statement->execute([$id]);
    $_SESSION['flash'] = ['type' => 'success', 'message' => $statement->rowCount() ? 'Record deleted successfully.' : 'Record was not found.'];
}
redirect('dashboard.php');
