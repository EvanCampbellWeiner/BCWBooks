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
 //The base location for moving files
 $new_location = "../../www_data/";
 $pdo=connectdb();
 //The base location for moving files
 $base_location = "../../www_data/";
 //Book info is pulled from database using id passed by viewInfo.php
  $sql = "SELECT * FROM bcwBooks_bookData WHERE id=?";
  $stmt = $pdo->prepare($sql);
 $stmt->execute([$_POST["editButton"]]);
 $book = $stmt->fetch(PDO::FETCH_ASSOC);
 //Display variables are set
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
        <!-- nav buttons -->
      <a href="index.php" id="indexButton">Home</a>
      <a href="bookShelf.php" id="bookShelfButton">BookShelf</a>
      <a href="account.php" id="accountButton">Account</a>
      <a href="logout.php" id="loginButton">Logout</a>
</header>
  <!-- div for displaying page contents on different background color -->
    <div class="displayBox" id="addBookDisplayBox">
      <form enctype="multipart/form-data" class="enclosedForm" id="uploadForm" action = "viewInfo.php" method = "post">
        <div class="addBookFormDiv">
          <label for="bookTitle" class="addBookLabel">Title: </label>
            <!-- Edit book forms are prepopulated with variables containing the book info -->
              <!-- book title input-->
          <input
            type="text"
            value='<?php echo "$title"; ?>'
            name="bookTitle"
            id="bookTitle"
             class ="required"
          />
        </div>
        <!-- book author input-->
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
        <!-- book description input-->
        <div class="addBookFormDiv" id="addBookFormTextareaDiv">
          <label class="addBookLabel">Description: </label>
          <textarea name="bookDescription" cols="100"> <?php echo "$description"; ?> </textarea>
        </div>
        <!-- book tags input-->
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
        <!-- book publication date input-->
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
        <!-- submission button that passes the id of the book being edited -->
        <div class="addBookFormDiv">
          <button type="submit" name="editBook" value = "<?php echo $_POST["editButton"]; ?>">Submit</button>
        </div>
      </form>
    </div>
    <!-- include scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- fallback for jQuery if CDN is unavailable -->
    <script>
      window.jQuery ||
        document.write('<script src="scripts/jquery.js"><\/script>');
    </script>

    <!-- script.js include - -->
    <script src="scripts/script.js"></script>
  </body>
</html>
