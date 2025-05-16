<?php
$host = "localhost";
$db = "projectp5-6";
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}

// Voeg admin toe
$username = "admin";
$plainPassword = "wachtwoord123";
$hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

$stmt = $conn->prepare("INSERT INTO admins (username, password) VALUES (?, ?)");
$stmt->bind_param("ss", $username, $hashedPassword);

if ($stmt->execute()) {
    echo "Admin succesvol toegevoegd.";
} else {
    echo "Fout bij toevoegen: " . $stmt->error;
}

$conn->close();
?>
