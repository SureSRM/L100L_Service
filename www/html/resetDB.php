<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Reset DB</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/custom.css">
    </head>
    <body>
      <div class="container">
        <div class="row">

        <?php
        include("config_conection.php");
        $query      = $connection->query("DROP TABLE IF EXISTS stories");
        $query      = $connection->query("CREATE TABLE stories (
            id          VARCHAR(45),
            author      VARCHAR(50),
            title       VARCHAR(50),
            description VARCHAR(300),
            genre      VARCHAR(30)
          )");
        $query      = $connection->query("DROP TABLE IF EXISTS likes");
        $query      = $connection->query("CREATE TABLE likes (
            id          VARCHAR(45),
            username      VARCHAR(45),
            CONSTRAINT PK_Like PRIMARY KEY (id,username)
          )");
        $query      = $connection->query("DROP TABLE IF EXISTS users");
        $query      = $connection->query("CREATE TABLE users (
            username          VARCHAR(45),
            password      VARCHAR(50)
          )");
        $query      = $connection->query("INSERT INTO users (username, password) VALUES ('test','pass1234')");

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
