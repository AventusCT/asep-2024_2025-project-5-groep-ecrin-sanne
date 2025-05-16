<?php
   session_start();
   include 'db.php';
   $username = $_SESSION['username']; // Assuming username is stored in session
   $progress = $_POST['progress'];
   // Update user progress
   $sql = "UPDATE users SET progress = ? WHERE username = ?";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param("ss", $progress, $username);
   $stmt->execute();
   echo json_encode(['success' => true, 'message' => 'Voortgang opgeslagen.']);
   $stmt->close();
   $conn->close();
   ?>
