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
            $stm        = $connection->prepare("SELECT s.id, s.author, s.title, s.description, s.genre, COUNT(l.id) AS like_count FROM stories AS s JOIN likes AS l on l.id = s.id
                                                WHERE s.genre=? GROUP BY s.id, s.author, s.title, s.description, s.genre ORDER BY like_count DESC");
            $stm->execute(array($_GET['filter']));
          } else {
            $stm        = $connection->prepare("SELECT s.id, s.author, s.title, s.description, s.genre, COUNT(l.id) AS like_count FROM stories AS s JOIN likes AS l on l.id = s.id
                                                GROUP BY s.id, s.author, s.title, s.description, s.genre ORDER BY like_count DESC");
          }

          $stm->execute();

          foreach ( $stm->fetchAll() as $story ) {
            include("story_card.php");
          }
          ?>

      </div>
    </div>
    </body>
</html>
