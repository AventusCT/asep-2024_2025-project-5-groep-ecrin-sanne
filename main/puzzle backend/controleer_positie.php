require_once 'db.php';
<?php
session_start();
if (!isset($_SESSION['correct_placed'])) {
    $_SESSION['correct_placed'] = [];
}

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['stuk_id'], $data['positie'])) {
    // Simpele validatie - voorbeeld: positie moet overeenkomen met vaste waarde
    $correct_positions = [
        'stuk1' => 'positie1',
        'stuk2' => 'positie2',
        // ...
    ];

    $stuk = $data['stuk_id'];
    $positie = $data['positie'];

    if (isset($correct_positions[$stuk]) && $correct_positions[$stuk] === $positie) {
        $_SESSION['correct_placed'][$stuk] = true;
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}
?>