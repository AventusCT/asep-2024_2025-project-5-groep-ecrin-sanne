require_once 'db.php';
<?php
session_start();
echo json_encode(['punten' => $_SESSION['punten'] ?? 0]);
?>
