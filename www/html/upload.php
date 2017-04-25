<?php
  include("session.php");
  if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {
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
    $author = $_SESSION['login_user'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $genre = $_POST['genre'];

    include("config_conection.php");
    $stm = $connection->prepare("INSERT INTO stories
      (id, author, title, description, genre) VALUES
      (?, ?, ?, ?, ?)");

    if( $stm->execute(array($id,$author,$title,$description,$genre))){
?>
      <div class="container">
      <div class="row">
        <h1> Your story was uploaded!</h1>
        <h1> Share it: </br> </h1>
        <code> <?php echo "{$_SERVER['HTTP_HOST']}/life/{$id}" ?> </code>
      </div>
      </div>
<?php
    } else {
      echo 'bad';
    }
      } catch (RuntimeException $e) {

          echo $e->getMessage();

      }
      die();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Upload</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    </head>
    <body>
          <div class="container">
            <div class="row">
              <h1> Upload your life </h1>

              <form enctype="multipart/form-data" action="upload.php" method="POST">
                <input type="hidden" name="MAX_FILE_SIZE" value="30000" />

                Title <input type="text" name="title"/>
                </br>
                Description <input type="text" name="description"/>

                genre <select name="genre"/>
                  <option value="Adventure">Adventure</option>
                  <option value="Action">Action</option>
                  <option value="Drama">Drama</option>
                  <option value="Love">Love</option>
                  <option value="Mistery">Mistery</option>
                  <option value="Scifi">Scifi</option>
                </select>

                </br>
                Upload file: <input name="user_file" type="file" />
                </br>
                <input type="submit" name="submit_button" value="Enviar"/>
              </div>
            </div>
    </body>
</html>
