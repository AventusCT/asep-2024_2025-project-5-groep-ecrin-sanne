<?php
   session_start();
   include 'db.php';

   $part = $_POST['part'];
   $position = $_POST['position'];

   // Check if the part is correctly placed
   $sql = "SELECT part_name FROM puzzle_parts WHERE part_name = ?";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param("s", $part);
   $stmt->execute();
   $result = $stmt->get_result();

   if ($result->num_rows > 0 && $part === $position) {
       echo json_encode(['success' => true, 'message' => 'Correct geplaatst!']);
   } else {
       echo json_encode(['success' => false, 'message' => 'Onjuist geplaatst.']);
   }

   $stmt->close();
   $conn->close();
   ?>
   