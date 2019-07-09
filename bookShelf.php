<?php
  /*Page Name: bookShelf.php
  Programmer Name: Alan-Michael Bradshaw and Evan Campbell-Weiner
  Language: HTML5 and PHP
  Page Description:
  This is the Book Shelf page that will be referenced when a user is logged in.
  It displays the cover of each book, links to edit, deltee, and view details of book.
  It limits the number of books to a page, and provides links to next page.
  There are quick sorts and search possibilities.

  Includes:
  reset.css: the default css file taken from  http://meyerweb.com/eric/tools/css/reset/
  style.css: overarcing css file*/

  session_start(); //start session
  //check session for user info
  if(!isset($_SESSION['user'])){
    //no user info, redirect
    header("Location:login.php");
    exit();
<<<<<<< HEAD
  }
=======
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

//echo $cover_path;


>>>>>>> branch1
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Main Page</title>
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
      <a href="bookShelf.php" id="bookShelfButton">BookShelf</a>
      <a href="account.php" id="accountButton">Account</a>

      <form id="searchForm">
        <input type="text" name="searchField" value="Search" id="searchField" />
        <input type="submit" value="Search" id="searchButton" />
      </form>
    </header>
    <div id="bodyDiv">
      <select name="sort" id="sortList">
        <option value="name">Name (default)</option>
        <option value="dateAdded">Date Added</option>
        <option value="lastModified">Last Modified</option>
      </select>
      <p>Sort By:</p>

      <div id="shelfDiv">
        <div class="shelfOuter">
          <a href="viewInfo.php">
            <img
              src="<?php echo "$cover_path"; ?>"
              alt="book cover"
              height="240"
              width="140"
            />
          </a>
          <div class="shelfInner"></div>
        </div>
        <div class="shelfOuter" id="shelfOuter2">
          <div class="shelfInner"></div>
        </div>
        <div class="shelfOuter" id="shelfOuter3">
          <div class="shelfInner"></div>
        </div>
        <nav id="shelfNav">
          <!-- Add icon sourced from https://icons8.com/icons/set/plus -->
          <a href="addBook.html" id="addBook"
            ><img
              src="images/plus-icon.png"
              alt="Add book icon"
              height="30"
              width="30"
          /></a>
          <a href="">first</a> <a href="">next</a> <a href="">previous</a>
          <a href="">last</a>
        </nav>
      </div>
    </div>
  </body>
</html>
