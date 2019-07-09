<?php
  /*Page Name: viewinfo.html
  Programmer Name: Alan-Michael Bradshaw and Evan Campbell-Weiner
  Language: HTML5 and PHP
  Page Description:
  ****************



  Includes:
  reset.css: the default css file taken from  http://meyerweb.com/eric/tools/css/reset/
  style.css: overarcing css file*/
  session_start(); //start session
  //check session for user info
  if(!isset($_SESSION['user'])){
    //no user info, redirect
    header("Location:login.php");
    exit();
  }*/
  include "includes/library.php";
$pdo=connectdb();
$base_location = "../../www_data/";
 $sql = "SELECT * FROM bcwBooks_bookData WHERE id=7";
 $stmt = $pdo->prepare($sql);
$stmt->execute();
$book = $stmt->fetch(PDO::FETCH_ASSOC);
$cover_filename = $book['cover_filename'];
$cover_path = $base_location. $cover_filename;
$title = $book['title'];
$author = $book['author'];
$description = $book['description'];
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Book Info</title>
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <!-- reset.css file taken from assignment 1 -->
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <!-- Script for using icons from FontAwesome.com -->
    <script src="https://kit.fontawesome.com/c155ad6c68.js"></script>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>

  <body>
    <header class="fullHeader" id="addBookHeader">
      <h1>Book Info</h1>
      <a href="index.php" id="homeButton">Home</a>
      <a href="bookShelf.php" id="bookShelfButton">BookShelf</a>
      <a href="account.php" id="accountButton">Account</a>

      <form id="searchForm">
        <input type="text" name="searchField" value="Search" id="searchField" />
        <input type="submit" value="Search" id="searchButton" />
      </form>
    </header>

    <div class="displayBox" id="addBookDisplayBox">
      <h2><?php echo "$title"; ?></h2>
      <h3>By: <?php echo "$author"; ?></h3>
      <img
        src="<?php echo "$cover_path"; ?>"
        alt="sample book cover"
        height="640"
        width="400"
      />
      <p>Description: <?php echo "$description"; ?></p>
      <nav id="iconDiv">
        <!-- Icons from https://icons8.com/icons -->
        <a href="EditBook.php" id="editBook" class="viewBookIcons"
          ><img
            src="images/edit.png"
            alt="Edit book icon"
            height="30"
            width="30"
        /></a>
        <a href="deleteBook.php" id="deleteBook" class="viewBookIcons"
          ><img
            src="images/trash.png"
            alt="delete book icon"
            height="30"
            width="30"
        /></a>
      </nav>
    </div>
  </body>
</html>
