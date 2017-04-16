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
            $path = '/var/www/html/life';
            $files = array_diff(scandir($path), array('.', '..'));
            $url =  "//{$_SERVER['HTTP_HOST']}";
            foreach ( $files as $key => $value ) {
          ?>
            <li class="list-group-item">
              <a href='<?= $url ?>/life/<?= $value ?>'>
                 <?= $value ?>
              </a>
            </li>
          <?php
            }
          ?>

      </div>
    </div>
    </body>
</html>
