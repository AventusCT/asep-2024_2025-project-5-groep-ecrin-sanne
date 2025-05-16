
<?php
   session_start();
   include 'db.php';
   $username = $_SESSION['username'];
   // Get user points
   $sql = "SELECT points FROM users WHERE username = ?";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param("s", $username);
   $stmt->execute();
   $stmt->bind_result($points);
   $stmt->fetch();
   echo json_encode(['success' => true, 'points' => $points]);
   $stmt->close();
   $conn->close();
   ?>