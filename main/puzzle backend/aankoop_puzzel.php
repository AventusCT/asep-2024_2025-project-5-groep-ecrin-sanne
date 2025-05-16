

<?php
   session_start();
   include 'db.php';
   $username = $_SESSION['username'];
   $part = $_POST['part'];
   $cost = 10; // Cost of each puzzle piece
   // Get user points
   $sql = "SELECT points FROM users WHERE username = ?";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param("s", $username);
   $stmt->execute();
   $stmt->bind_result($points);
   $stmt->fetch();
   if ($points >= $cost) {
       // Deduct points and update user
       $new_points = $points - $cost;
       $sql = "UPDATE users SET points = ? WHERE username = ?";
       $stmt = $conn->prepare($sql);
       $stmt->bind_param("is", $new_points, $username);
