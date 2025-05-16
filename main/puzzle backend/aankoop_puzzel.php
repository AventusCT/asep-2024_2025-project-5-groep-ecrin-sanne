require_once 'db.php';
<?php
session_start();
$stuk_id = $_POST['stuk_id'] ?? null;

if (!isset($_SESSION['punten'])) $_SESSION['punten'] = 0;
if (!isset($_SESSION['gekocht'])) $_SESSION['gekocht'] = [];

$prijzen = [
    'stuk1' => 10,
    'stuk2' => 15,
    // ...
];

if ($stuk_id && isset($prijzen[$stuk_id])) {
    $prijs = $prijzen[$stuk_id];
    if ($_SESSION['punten'] >= $prijs) {
        $_SESSION['punten'] -= $prijs;
        $_SESSION['gekocht'][] = $stuk_id;
        echo json_encode(['gekocht' => true, 'punten' => $_SESSION['punten']]);
    } else {
        echo json_encode(['gekocht' => false, 'error' => 'Niet genoeg punten']);
    }
} else {
    echo json_encode(['gekocht' => false, 'error' => 'Ongeldig stuk']);
}
?>
