

<?php
   session_start();
   include 'db.php';
   $username = $_SESSION['username'];
   // Reset user progress
   $sql = "UPDATE users SET progress = NULL WHERE username = ?";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param("s", $username);
   $stmt->execute();
   echo json_encode(['success' => true, 'message' => 'Voortgang gereset.']);
   $stmt->close();
   $conn->close();
   ?>