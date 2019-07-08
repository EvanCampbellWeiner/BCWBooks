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
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>BCW Books</title>
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <!-- reset.css file taken from assignment 1 -->
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <!-- Script for using icons from FontAwesome.com -->
    <script src="https://kit.fontawesome.com/c155ad6c68.js"></script>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>

  <body>
    <header class="fullHeader">
      <h1>Library</h1>
      <a href="index.php" id="indexButton">Home</a>
      <a href="bookShelf.php" id="bookShelfButton">Library</a>
      <a href="register.php" id="accountButton">Register</a>
      <a href="login.php" id="loginButton">Login</a>
    </header>
    <div id="content">
      <main>
        <h2>Welcome!</h2>
        <h3>BCW Books: The only place to book your books.</h3>
      </main>
      <aside>
        <img src="images/SetForLife2.jpg" alt="sample book cover" width="300" />
      </aside>
    </div>
  </body>
</html>
