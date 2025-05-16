<?php
session_start();
$host = "localhost";
$db = "projectp5-6";
$user = "root";
$pass = "";

// Maak verbinding met de database
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Verbinding mislukt: " . $conn->connect_error);
}

// Haal gebruikersnaam en wachtwoord op uit het formulier
$username = $_POST['username'];
$password = $_POST['password'];

// Zoek gebruiker in de database
$sql = "SELECT * FROM admins WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.html");
        exit;
    } else {
        echo "Wachtwoord is onjuist.";
    }
} else {
    echo "Gebruiker niet gevonden.";
}
?>

<form method="POST" action="login.php">
    <input type="text" name="username" placeholder="Gebruikersnaam" required>
    <input type="password" name="password" placeholder="Wachtwoord" required>
    <button type="submit">Inloggen</button>
</form>
