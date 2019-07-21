<?php
  /*
  Page Name: index.html
  Programmer Name: Alan-Michael Bradshaw and Evan Campbell-Weiner
  Language: HTML5 and PHP
  Page Description:
  The home page for the website.
  It has links to itself, the library page, the register and login page.



  Includes:
  reset.css: the default css file taken from  http://meyerweb.com/eric/tools/css/reset/
  style.css: overarcing css file
  */
  session_start(); //start session

  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>BCW Books</title>
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <!-- reset.css file taken from assignment 1 -->
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/splitchar.css" rel="stylesheet" type="text/css">
    <!-- Script for using icons from FontAwesome.com -->
    <script src="https://kit.fontawesome.com/c155ad6c68.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- fallback for jQuery if CDN is unavailable -->
    <script>
      window.jQuery ||
        document.write('<script src="scripts/jquery.js"><\/script>');
    </script>

    <!-- Script for using icons from FontAwesome.com -->
    <script src="https://kit.fontawesome.com/c155ad6c68.js"></script>

      <script type="text/javascript" src="scripts/splitchar.js"></script>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>

  <body>
    <header class="fullHeader">
      <h1 class = "splitchar vertical">BCW Books</h1>
      <a href="index.php" id="indexButton">Home</a>
      <?php
      if(!isset($_SESSION['user'])):
      ?>
      <a href="register.php" id="accountButton">Register</a>
      <a href="login.php" id="loginButton">Login</a>
      <?php else:?>
        <a href="bookShelf.php" id="bookShelfButton">Library</a>
        <a href="login.php" id="loginButton">Account</a>
        <a href="logout.php" id="loginButton">Logout</a>
      <?php endif; ?>
    </header>
    <div id="content">
      <main>
        <h2 class = "splitchar vertical">Welcome!</h2>
        <h3>BCW Books: The only place to book your books.</h3>
      </main>
      <aside>
        <img src="images/SetForLife2.jpg" alt="sample book cover" width="300" />
      </aside>
    </div>
  </body>
</html>
