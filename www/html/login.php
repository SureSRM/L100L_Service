<?php

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form
      session_start();
      include("config_conection.php");

      $stm = $connection->prepare("SELECT * FROM users WHERE username = ? AND password= ?");
      $stm->execute(array($_POST['user'],$_POST['password']));
      $result = $stm->fetchAll();

      if(count($result) == 1) {
         $_SESSION['login_user'] = $_POST['user'];

         header("location: index.php"); //Redirects to homepage
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>
<html>
   <head>
      <meta charset="utf-8">
      <title>Login Page</title>
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="css/custom.css">
   </head>
   <body>
     <div class="custom-login-background">
       <div class="container custom-form">
         <div class="row">
             <div class="login-form">
               <h1 class="custom-font">Login</h1>
               <form action = "" method = "POST" class="form-horizontal">
                 <div class="form-group row">
                   <label for=user class="control-label" >User name:</label>
                   <input type = "text" name="user" class="form-control"/>
                 </div>
                 <div class="form-group row">
                  <label for=password class="control-label">Password:</label>
                  <input type = "password" name = "password" class="form-control"/>
                </div>
                <div class="form-group row">
                  <input type = "submit" value = "Submit"
                      class="btn btn-lg btn-primary btn-block"/><br />
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
   </body>
</html>
