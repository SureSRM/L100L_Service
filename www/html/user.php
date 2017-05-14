<?php
  session_start();

?>
 <html>
    <head>
        <meta charset="utf-8">
        <title>User</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/custom.css">
    </head>
    <body>
      <div class="custom-login-nav">
           <?php
              if(!isset($_SESSION['login_user'])){
            ?>
                <a href="/login.php" class="custom-login-nav">Login</a>
            <?php
              } else {
            ?>
                <a href="/logout.php" class="custom-login-nav">Log out from <b><?=$_SESSION['login_user']?></b></a>
            <?php
              }
            ?>
     </div>

      <div class="jumbotron text-center custom-user-background">
        <div class="custom-font">
          <h1 class="custom-banner">Stories by <?= $_GET['user'] ?></h1>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <ul class="nav nav-tabs">
            <li><a href="user.php?user=<?= $_GET['user'] ?>"                   >All</a></li>
            <li><a href="user.php?user=<?= $_GET['user'] ?>&filter=adventure"   >Adventure</a></li>
            <li><a href="user.php?user=<?= $_GET['user'] ?>&filter=action"      >Action</a></li>
            <li><a href="user.php?user=<?= $_GET['user'] ?>&filter=drama"       >Drama</a></li>
            <li><a href="user.php?user=<?= $_GET['user'] ?>&filter=love"        >Love</a></li>
            <li><a href="user.php?user=<?= $_GET['user'] ?>&filter=mistery"     >Mistery</a></li>
            <li><a href="user.php?user=<?= $_GET['user'] ?>&filter=scifi"       >Scifi</a></li>
          </ul>
        </div>
        <div class="row">
          <ul class="list-group">
          <?php
          include("config_conection.php");

          if(isset($_GET['filter'])){
            $stm        = $connection->prepare("SELECT * FROM stories WHERE genre=? AND author=?");
            $stm->execute(array($_GET['filter'],$_GET['user']));
          } else {
            $stm        = $connection->prepare("SELECT * FROM stories WHERE author=?");
            $stm->execute(array($_GET['user']));
          }

          foreach ( $stm->fetchAll() as $story ) {
              include("story_card.php");
          }
          ?>

      </div>
    </div>
    </body>
</html>
