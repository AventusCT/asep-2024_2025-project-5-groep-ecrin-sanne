<?php
   include 'db.php';
   $part = $_POST['part'];
   // Get explanation from the database
   $sql = "SELECT explanation FROM puzzle_parts WHERE part_name = ?";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param("s", $part);
   $stmt->execute();
   $stmt->bind_result($explanation);
   $stmt->fetch();
   echo json_encode(['success' => true, 'explanation' => $explanation ?? 'Geen uitleg beschikbaar.']);
   $stmt->close();
   $conn->close();
   ?>