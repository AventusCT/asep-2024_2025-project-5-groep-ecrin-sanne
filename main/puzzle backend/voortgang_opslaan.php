require_once 'db.php';
<?php
session_start();
$data = json_decode(file_get_contents("php://input"), true);
if (isset($data['voortgang'])) {
    $_SESSION['voortgang'] = $data['voortgang'];
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>

// /backend/voortgang_reset.php
<?php
session_start();
unset($_SESSION['voortgang']);
unset($_SESSION['correct_placed']);
echo json_encode(['reset' => true]);
?>
