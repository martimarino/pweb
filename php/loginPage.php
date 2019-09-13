<?php
  session_start();
    include "./util/session.php";

    if (isLogged()){
      if($_SESSION['userId'] == "amministratore"){
        header('Location: ./admin_profile.php');
      }
      else{
        header('Location: ./profile.php');
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
    <!--<script type="text/javascript" src="../js/home.js"></script>-->
    <!--<script src="../js/ajaxManager.js"></script>-->
    <link rel="icon" href = "../immagini/supernova.png" sizes="32x32" type="image/png">
    <link href="https://fonts.googleapis.com/css?family=Srisakdi:700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Marmelad" rel="stylesheet">
    <title>Supernova</title>
  </head>
  
  <body>
    <?php
      include"./layout/top_bar.php";
    ?>
    <h2>Login page</h2>
    <form class="login-container" name="login" action="./util/login.php" method="post">
        <div class="container">
          <label><b>Username</b></label>
          <input type="text" placeholder="Enter Username" name="username" id="username" required autofocus>

          <label><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="password" id="password" required>
          <input type="submit" value="Login" class="button">
          <?php
            if (isset($_GET['errorMessage'])){
              echo '<div class="sign_in_error">';
              echo '<span>' . $_GET['errorMessage'] . '</span>';
              echo '</div>';
          }
        ?>
        </div>
        <hr>
        <div class="container">
          <label><b>Non possiedi un account?</b></label>
          <p>Registrati e approfitta subito dei vantaggi riservati agli iscritti al sito Supernova.</p>
          <button type="submit" class="button" onclick="./util/login.php">Registrati ora</button>
        </div>
    </form>
  </body>
</html>