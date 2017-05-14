<?php
  include("session.php");
  //GET BECAUSE WE DONT WANNA USE JAVASCRIPT
  $id = $_GET['story_id'];
  $username = $_GET['username'];

  include("config_conection.php");
  $stm = $connection->prepare("INSERT INTO likes
    (id, username) VALUES (?, ?)");

  $stm->execute(array($id,$username));
  header("location:index.php");
  die();
?>
