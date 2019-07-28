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
<!-- Head of the doc with links to css and js -->
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BCW Books</title>
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <!-- reset.css file taken from assignment 1 -->
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/splitchar.css" rel="stylesheet" type="text/css">
    <!-- Script for using icons from FontAwesome.com -->
    <script src="https://kit.fontawesome.com/c155ad6c68.js"></script>
    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- fallback for jQuery if CDN is unavailable -->
    <script>
      window.jQuery ||
        document.write('<script src="scripts/jquery.js"><\/script>');
    </script>
    <!-- script to connect to splitchar.js  -->
    <script src="scripts/splitchar.js"></script>
  </head>
  <!-- Main body of the page -->
  <body>
    <!-- header of the page -->
    <header>
      <!-- H1 uses splitchar -->
      <h1 class = "splitchar vertical">BCW Books</h1>
      <a href="index.php" id="indexButton">Home</a>
      <?php
      if(!isset($_SESSION['user'])): //if the user is set show register/login
      ?>
      <a href="register.php" id="accountButton">Register</a>
      <a href="login.php" id="loginButton">Login</a>
    <?php else: //if the user is not set show library account logout?>
        <a href="bookShelf.php" id="bookShelfButton">BookShelf</a>
        <a href="login.php" id="accountButton">Account</a>
        <a href="logout.php" id = "loginButton">Logout</a>
      <?php endif; ?>
    </header>
    <!-- Div to position main and aside side by side -->
    <div id="content">
      <!-- main area -->
      <main>
        <h2 class = "splitchar vertical">Welcome!</h2>
        <h3>BCW Books: The only place to book your books.</h3>
      </main>
      <!-- aside image -->
      <aside>
        <img src="images/SetForLife2.jpg" alt="sample book cover" width="300"/>
      </aside>
    </div>
  </body>
</html>
