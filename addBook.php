<?php
/*  Page Name: addBook.php
  Programmer Name: Alan-Michael Bradshaw and Evan Campbell-Weiner
  Language: HTML5 and PHP
  Page Description:
  Allows the user to upload the details for a book including a cover and copies of the books
  in relative formats.


  Includes:
  reset.css: the default css file taken from  http://meyerweb.com/eric/tools/css/reset/
  style.css: overarcing css file
*/
  session_start();
 include "includes/library.php";
 $realImageFlag =1;
 $errors = array();

 $pdo=connectdb();
 if (isset($_POST['addBook'])) {
   $check = getimagesize($_FILES["ebookToUpload"]["tmp_name"]);
if($check !== false) {
    $realImageFlag = 1;
} else {
    $realImageFlag = 0;
}

if($realImageFlag == 1){
   $sql = "INSERT INTO bcwBooks_bookData(filename, cover_filename, title, tags, author, description, publication_date, user) VALUES (?,?,?,?,?,?,?,?)";
   $stmt = $pdo->prepare($sql);
   //$stmt->execute('$_FILE["ebookToUpload"]','$_FILE["ebookCover"]','$_POST["bookTitle"]', '$_POST["bookTags"]', '$_POST["bookAuthor"]', '$_POST["bookDe"]', '$_POST["bookDescription"]', '$_SESSION['user']');
    $stmt->execute(['testFileName','testCoverFileName','testTitle','TestTags','testAuthor','testDescription','2019-07-06','testUser']);
  }
 }

  ?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Add Book</title>
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
      <h1>Add Book</h1>
      <a href="index.php" id="homeButton">Home</a>
      <a href="bookShelf.php" id="bookShelfButton">BookShelf</a>
      <a href="account.php" id="accountButton">Account</a>

      <form id="searchForm">
        <input type="text" name="searchField" value="Search" id="searchField" />
        <input type="submit" value="Search" id="searchButton" />
      </form>
    </header>

    <div class="displayBox" id="addBookDisplayBox">
      <form enctype="multipart/form-data" class="enclosedForm" id="uploadForm" action = "<?php echo $_SERVER['PHP_SELF'];?>" method = "post">
        <div class="addBookFormDiv">
          <label for="ebookToUpload" class="addBookLabel"
            >Upload Ebook File(.mobi, .epub, .pdf)</label
          >
          <input type="file" name="ebookToUpload" id="ebookToUpload" />
        </div>
        <div class="addBookFormDiv">
          <label for="ebookCover" class="addBookLabel"
            >Upload Ebook Cover(.jpg, .png)</label
          >
          <input type="file" name="ebookCover" id="ebookCover" />
        </div>
        <div class="addBookFormDiv">
          <label for="bookTitle" class="addBookLabel">Title: </label>
          <input
            type="text"
            placeholder="Title"
            name="bookTitle"
            id="bookTitle"
          />
        </div>
        <div class="addBookFormDiv">
          <label for="bookAuthor" class="addBookLabel">Author: </label>
          <input
            type="text"
            placeholder="Author Name"
            name="bookAuthor"
            id="bookAuthor"
          />
        </div>
        <div class="addBookFormDiv" id="addBookFormTextareaDiv">
          <label class="addBookLabel">Description: </label>
          <textarea name="bookDescription"  rows="10" cols="100"> </textarea>
        </div>
        <div class="addBookFormDiv">
          <label for="bookTags" class="addBookLabel">Tags: </label>
          <input
            type="text"
            placeholder="Tag1, Tag2, Tag3..."
            name="bookTags"
            id="bookTags"
          />
        </div>
        <div class="addBookFormDiv">
          <label for="bookPublicationDate" class="addBookLabel">Publication Date: </label>
          <input
            type="date"
            value="2019-07-06"
            name="bookPublicationDate"
            id="bookPublicationDate"
          />
        </div>
        <div class="addBookFormDiv">
          <input type="submit" name="addBook" />
        </div>
      </form>
    </div>
  </body>
</html>
