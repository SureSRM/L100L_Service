<html>
    <head>
        <meta charset="utf-8">
        <title>Live 100 lifes!</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/custom.css">
    </head>
    <body>
      <div class="jumbotron text-center custom-banner-background">
        <div class="custom-font">
          <h1 class="custom-banner">Live 100 lifes</h1>
          <h2 class="custom-banner">New adventures are waiting for you!</h2>
          <input type="button" class="btn btn-info" value="Upload yours" onclick="location.href = 'upload.php';">
        </div>
      </div>
      <div class="container">
        <div class="row">
          <ul class="list-group">
          <?php
          include("config_conection.php");
          $stm        = $connection->prepare("SELECT * FROM stories");
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
