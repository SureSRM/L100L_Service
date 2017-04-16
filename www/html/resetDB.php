<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Reset DB</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
    <body>
      <div class="container">
        <div class="row">

        <?php
        $database   = $user = $password = "project";
        $host       = "mysql";
        $connection = new PDO("mysql:host={$host};dbname={$database};charset=utf8", $user, $password);
        $query      = $connection->query("CREATE TABLE IF NOT EXISTS stories (
            id          VARCHAR(30),
            author      VARCHAR(50),
            description TEXT,
            gengre      VARCHAR(30),
            date          TIMESTAMP DEFAULT CURRENT_TIMESTAMP
          )");

        $query      = $connection->query("SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_TYPE='BASE TABLE'");
        $tables     = $query->fetchAll(PDO::FETCH_COLUMN);

        if (empty($tables)) {
            echo "<h1>There are no tables in database \"{$database}\".</h1>";
        } else {
            echo "<h1>Database \"{$database}\" has the following tables:</h1>";
            echo "<ul>";
            foreach ($tables as $table) {
                echo "<li>{$table}</li>";
            }
            echo "</ul>";
        }
        ?>
      </div>
    </div>
    </body>
</html>
