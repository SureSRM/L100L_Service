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
          sprintf('story/%s', $id
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
        (?, ?, ?, ?, ?); INSERT INTO likes (id, username) VALUES (?, ?)");

      if( $stm->execute(array($id,$author,$title,$description,$genre,$id,$author))){
?>
<html>
    <head>
        <meta charset="utf-8">
        <title>Upload</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/custom.css">
    </head>
    <body>
      <div class="container">
        <div class="row">
        <h1> Your story was uploaded!</h1>
        <h1> Share it: </br> </h1>
        <code> <?php echo "{$_SERVER['HTTP_HOST']}/story/{$id}" ?> </code>
        </div>
      </div>
    </body>
</html>
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
<html>
    <head>
        <meta charset="utf-8">
        <title>Upload</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/custom.css">
    </head>
    <body>
      <div class="custom-upload-background">
        <div class="container custom-form">
          <div class="row">
            <div class="login-form">
              <form enctype="multipart/form-data" action="upload.php" method="POST" class="form-horizontal">
                <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
                <h1 class="custom-font"> Upload your story </h1>
                <div class="form-group row">
                  <label for=title class="control-label" >Title:</label>
                  <input type="text" name="title" class="form-control"/>
                </div>
                <div class="form-group row">
                  <label for=description class="control-label" >Description:</label>
                  <input type="text" name="description" class="form-control"/>
                </div>
                <div class="form-group row">
                  <label for=genre class="control-label" >Genre:</label>
                  <select class="form-control" name="genre" class="form-control"/>
                    <option value="Adventure">Adventure</option>
                    <option value="Action">Action</option>
                    <option value="Drama">Drama</option>
                    <option value="Love">Love</option>
                    <option value="Mistery">Mistery</option>
                    <option value="Scifi">Scifi</option>
                  </select>
                </div>
                <div class="form-group row">
                  <label for=user_file class="control-label" >Upload file:</label>
                  <input name="user_file" type="file" class="file"/>
                </div>
                <div class="form-group row">
                  <input type="submit" name="submit" value="Upload"
                      class="btn btn-lg btn-primary btn-block"
                      data-show-preview="false"/>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
    </body>
</html>
