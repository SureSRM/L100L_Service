<?php
  $database   = $user = $password = "project";
  $host       = "mysql";
  $connection = new PDO("mysql:host={$host};dbname={$database};charset=utf8", $user, $password);
?>
