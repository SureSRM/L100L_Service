<?php
  session_start();

?>
 <html>
    <head>
        <meta charset="utf-8">
        <title>Live 100 lifes!</title>
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

      <div class="jumbotron text-center custom-banner-background">
        <div class="custom-font">
          <h1 class="custom-banner">Live 100 lifes</h1>
          <h2 class="custom-banner">New adventures are waiting for you!</h2>
          <?php
            if(!isset($_GET['mode'])){
          ?>
              <input type="button" class="btn btn-info" value="Upload yours" onclick="location.href = 'upload.php';">
          <?php
            } else {
              $currentURLparam="mode=native&";
            }
          ?>
        </div>
      </div>
      <div class="container">
        <div class="row">
          <ul class="nav nav-tabs">
            <li><a href="/?<?=$currentURLparam?>"                   >All</a></li>
            <li><a href="/?<?=$currentURLparam?>filter=adventure"   >Adventure</a></li>
            <li><a href="/?<?=$currentURLparam?>filter=action"      >Action</a></li>
            <li><a href="/?<?=$currentURLparam?>filter=drama"       >Drama</a></li>
            <li><a href="/?<?=$currentURLparam?>filter=love"        >Love</a></li>
            <li><a href="/?<?=$currentURLparam?>filter=mistery"     >Mistery</a></li>
            <li><a href="/?<?=$currentURLparam?>filter=scifi"       >Scifi</a></li>
          </ul>
        </div>
        <div class="row">
          <ul class="list-group">
          <?php
          include("config_conection.php");

          if(isset($_GET['filter'])){
            $stm        = $connection->prepare("SELECT * FROM stories where genre=?");
            $stm->execute(array($_GET['filter']));
          } else {
            $stm        = $connection->prepare("SELECT * FROM stories");
          }

          $stm->execute();

          foreach ( $stm->fetchAll() as $story ) {
          ?>
            <li class="list-group-item">

              <div class="media">
                <div class="media-left">
                  <img src="pics/<?= $story['genre']?>.png" class="media-object" style="width:60px">
                </div>
                <div class="media-body">
                  <h3 class="media-heading">
                    <a href='story/<?= $story['id'] ?>'>
                      <?= $story['title'] ?>
                    </a>
                    <small> by <?= $story['author'] ?> </small>
                  </h3>
                  <p><?= $story['description'] ?></p>
                </div>
              </div>
            </li>
          <?php
            }
          ?>

      </div>
    </div>
    </body>
</html>
