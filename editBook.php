<?php
/*  Page Name: oci_set_editionBook.php
  Programmer Name: Alan-Michael Bradshaw and Evan Campbell-Weiner
  Language: HTML5 and PHP
  Page Description:
  Allows the user to edit the details for a book including a cover and copies of the books
  in relative formats.


  Includes:
  reset.css: the default css file taken from  http://meyerweb.com/eric/tools/css/reset/
  style.css: overarcing css file

  */session_start(); //start session
  //check session for user info
  if(!isset($_SESSION['user'])){
    //no user info, redirect
    header("Location:login.php");
    exit();
  }

 include "includes/library.php";
 $errors = array();
 $new_location = "../../www_data/";
 $pdo=connectdb();

 $base_location = "../../www_data/";
  $sql = "SELECT * FROM bcwBooks_bookData WHERE id=?";
  $stmt = $pdo->prepare($sql);
 $stmt->execute([$_POST["editButton"]]);
 $book = $stmt->fetch(PDO::FETCH_ASSOC);
 $cover_filename = $book['cover_filename'];
 $cover_path = $base_location. $cover_filename;
 $title = $book['title'];
 $author = $book['author'];
 $description = $book['description'];
 $filename = $book['filename'];
  $book_path = $base_location. $filename;
 $tags = $book['tags'];
 $pubDate = $book['publication_date'];



  ?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Edit Book</title>
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <!-- reset.css file taken from assignment 1 -->
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <!-- Script for using icons from FontAwesome.com -->
    <script src="https://kit.fontawesome.com/c155ad6c68.js"></script>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>

  <body>
    <header id="addBookHeader">
      <h1>Edit Book</h1>
      <a href="index.php" id="indexButton">Home</a>
      <a href="bookShelf.php" id="bookShelfButton">BookShelf</a>
      <a href="account.php" id="accountButton">Account</a>

      <form id="searchForm">
        <input type="text" name="searchField" value="Search" id="searchField" />
        <input type="submit" value="Search" id="searchButton" />
      </form>
    </header>

    <div class="displayBox" id="addBookDisplayBox">
      <form enctype="multipart/form-data" class="enclosedForm" id="uploadForm" action = "viewInfo.php" method = "post">
        <div class="addBookFormDiv">
          <label for="bookTitle" class="addBookLabel">Title: </label>
          <input
            type="text"
            value='<?php echo "$title"; ?>'
            name="bookTitle"
            id="bookTitle"
          />
        </div>
        <div class="addBookFormDiv">
          <label for="bookAuthor" class="addBookLabel">Author: </label>
          <input
            type="text"
            value='<?php echo "$author"; ?>'
            name="bookAuthor"
            id="bookAuthor"
            required
          />
        </div>
        <div class="addBookFormDiv" id="addBookFormTextareaDiv">
          <label class="addBookLabel">Description: </label>
          <textarea name="bookDescription" cols="100"> <?php echo "$description"; ?> </textarea>
        </div>
        <div class="addBookFormDiv">
          <label for="bookTags" class="addBookLabel">Tags: </label>
          <input
            type="text"
            value='<?php echo "$tags"; ?>'
            name="bookTags"
            id="bookTags"
            required
          />
        </div>
        <div class="addBookFormDiv">
          <label for="bookPublicationDate" class="addBookLabel">Publication Date: </label>
          <input
            type="date"
            value='<?php echo "$pubDate"; ?>'
            name="bookPublicationDate"
            id="bookPublicationDate"
            required
          />
        </div>
        <div class="addBookFormDiv">
          <button type="submit" name="editBook" value = "<?php echo $_POST["editButton"]; ?>">Submit</button>
        </div>
      </form>
    </div>
  </body>
</html>
