<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Upload</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
    <body>
        <?php if ( empty($_POST['author']) ) { ?>
          <div class="container">
            <div class="row">
              <h1> Upload your life </h1>

              <form enctype="multipart/form-data" action="upload.php" method="POST">
                <input type="hidden" name="MAX_FILE_SIZE" value="30000" />

                Author <input type="text" name="author" value=""/>
                Title <input type="text" name="title" value=""/>
                </br>
                Description <input type="text" name="author" value=""/>
                Gengre <input type="text" name="author" value=""/>
                </br>
                Upload file: <input name="user_file" type="file" />
                </br>
                <input type="submit" name="submit_button" value="Enviar"/>
              </div>
            </div>
        <?php } else {
          $database   = $user = $password = "project";
          $host       = "mysql";
          $connection = new PDO("mysql:host={$host};dbname={$database};charset=utf8", $user, $password);

          $id = sha1_file($_FILES['user_file']['tmp_name']);

          try {
            if (
                !isset($_FILES['user_file']['error']) ||
                is_array($_FILES['user_file']['error'])
            ) {
                throw new RuntimeException('Invalid parameters.');
            }
            switch ($_FILES['user_file']['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new RuntimeException('No file sent.');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new RuntimeException('Exceeded filesize limit.');
                default:
                    throw new RuntimeException('Unknown errors.');
            }

            if ($_FILES['upfile']['size'] > 1000000) {
                throw new RuntimeException('Exceeded filesize limit.');
            }

            if (!move_uploaded_file(
                $_FILES['user_file']['tmp_name'],
                sprintf('life/%s', $id
                )
            )) {
                throw new RuntimeException('Failed to move uploaded file.');
            }

          $author = $_POST['author'];
          $title = $_POST['title'];
          $description = $_POST['description'];
          $gengre = $_POST['gengre'];

          $query = $connection->query("INSERT INTO life
            (id, author, description, gengre) VALUES
            ('$id', '$author', '$description','$gengre')");

        ?>
        <div class="container">
          <div class="row">
            <h1> Your story was uploaded!</h1>
            <h1> Share it: </br> </h1>
            <code> <?php echo "{$_SERVER['HTTP_HOST']}/life/{$id}" ?> </code>
          </div>
        </div>
        <?php
            } catch (RuntimeException $e) {

                echo $e->getMessage();

            }
          } ?>

    </body>
</html>
