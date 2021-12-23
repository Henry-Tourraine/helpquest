<?php
    $conn = new mysqli("localhost", "root", "", "helpquest");
    if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
     }


?>