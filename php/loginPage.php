<?php
    require_once __DIR__ . "/config.php";
  session_start();
    include DIR_UTIL . "session.php";

    if (isLogged()){
      if($_SESSION['userId'] == "amministratore"){
        header('Location: ./admin_profile.php');
      }
      else{
        header('Location: ./profileInformations.php');
      }
      exit;
    } 
?>

<!DOCTYPE html>
<html lang="it">
    <head>
    <meta charset="utf-8">
    <meta name = "author" content = "Martina Marino">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Supernova">
    <link rel="stylesheet" href="../css/login.css" type="text/css" media="screen"> 
    <link rel="stylesheet" href="../css/header.css" type="text/css" media="screen">
    <link rel="icon" href = "../immagini/supernova.png" sizes="32x32" type="image/png">
    <link href="https://fonts.googleapis.com/css?family=Srisakdi:700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Marmelad" rel="stylesheet">
    <script src="./../js/home.js"></script>  
    <title>Supernova</title>
  </head>
  
  <body>
    <?php
      include"./layout/top_bar.php";
    ?>
    <form action="./util/login.php" method="post">
        <div class="container">
          <label>E-mail</label>
          <input type="text" placeholder="Enter E-mail" name="email" id="email" required autofocus autocomplete="on">

          <label>Password</label>
          <input type="password" placeholder="Enter Password" name="password" id="password" required>
          <a href="">Password forgotten?</a>
          <input type="submit" value="Login" class="button">
          <?php
            if (isset($_GET['errorMessage'])){
              echo '<div class="sign_in_error">';
              echo '<span><b>' . $_GET['errorMessage'] . '</b></span>';
              echo '</div>';
            }
          ?>
       </div>
      </form>
      <form action="./registration.php">
        <div class="container">
          <label><b>Don't you have an account?</b></label>
          <p>Register now and take advantage of the benefits reserved for members of the Supernova site.</p>
          <button type="submit" class="button">Sign in</button>
        </div>
      </form>
  </body>
</html>