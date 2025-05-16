require_once 'db.php';
<?php
session_start();
unset($_SESSION['voortgang']);
unset($_SESSION['correct_placed']);
echo json_encode(['reset' => true]);
?>

// /backend/uitleg_na_plaatsing.php
<?php
$data = json_decode(file_get_contents("php://input"), true);
if (isset($data['stuk_id'])) {
    $uitleg = [
        'stuk1' => 'Dit onderdeel laat de wieken draaien.',
        'stuk2' => 'Dit is de generator van de windmolen.',
        // ...
    ];
    $stuk = $data['stuk_id'];
    echo json_encode(['uitleg' => $uitleg[$stuk] ?? '']);
}
?>