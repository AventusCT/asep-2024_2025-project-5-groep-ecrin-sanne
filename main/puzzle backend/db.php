<?php
   $host = 'localhost'; // Database host
   $db = 'windmolen_quiz'; // Database name
   $user = 'your_username'; // Database username
   $pass = 'your_password'; // Database password
   $conn = new mysqli($host, $user, $pass, $db);
   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }
   ?>
   