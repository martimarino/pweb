
<?php
include "./database/session.php";
  // Start the session
  session_start();
  if(isLogged())
  {
    header('Location: ./profile.php');
    exit;
  }
?>

<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name = "author" content = "Martina Marino">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Supernova">
    <link rel="stylesheet" href="../css/login.css" type="text/css" media="screen"> 
    <script type="text/javascript" src="../js/home.js"></script>
    <script src="../js/ajaxManager.js"></script>
    <link rel="icon" href = "../immagini/supernova.png" sizes="32x32" type="image/png">
    <link href="https://fonts.googleapis.com/css?family=Srisakdi:700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Marmelad" rel="stylesheet">
    <title>Supernova</title>
  </head>
  
  <body>
    <header>
      <form id="search">
        <input type="text" name="search" placeholder="Search..">
        <img src="../immagini/search.png" alt="search">
      </form>
      <nav id="right-icons">
        <ul id="right-list">
          <li id="favourites" onclick="favourites()"><img src="../immagini/heart.png" alt="favourites"></li>
          <li id="login" onclick="fade('element')"><img src="../immagini/login.png" alt="login"></li>
          <li id="cart"><a href="cart.php"><img src="../immagini/cart.png" alt="cart"></a></li> 
        </ul>
      </nav>
      <h1>
        <a id="titolo" href="../index.php"> Supernova </a>
      </h1>
    </header>
    <h2>Login page</h2>
    <form class="modal-content">
        <div class="container">
          <label for="username"><b>Username</b></label>
          <input type="text" placeholder="Enter Username" name="username" id="username" required>

          <label for="password"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="password" id="password" required>
          <button type="submit" onclick="AjaxManager.login();">Login</button>
        </div>
        <hr>
        <div class="container">
          <label for="newUser"><b>Non possiedi un account?</b></label>
          <p>Registrati e approfitta subito dei vantaggi riservati agli iscritti al sito Supernova.</p>
          <button type="submit">Registrati ora</button>
        </div>
    </form>
  </body>
</html>