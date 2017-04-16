<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Live 100 lifes!</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
    <body>
      <div class="jumbotron text-center">
        <h1> Live 100 lifes </h1>
        <p>New adventures are waiting for you!</p>
      </div>
      <div class="container">
        <div class="row">
          <ul class="list-group">
          <?php
          $database   = $user = $password = "project";
          $host       = "mysql";
          $connection = new PDO("mysql:host={$host};dbname={$database};charset=utf8", $user, $password);
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
                    <a href='life/<?= $story['id'] ?>'>
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
