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

  */session_start(); //start session
  //check session for user info
  if(!isset($_SESSION['user'])){
    //no user info, redirect
    header("Location:login.php");
    exit();
  }

 include "includes/library.php";
 $errors = array();
 //Base location for moving uploaded files
 $new_location = "../../www_data/";
 $pdo=connectdb();
 //If the form has been submitted, execute database query using info
 if (isset($_POST['addBook'])) {
   if(isset($_FILES['ebookToUpload']) && isset($_FILES['ebookCover'])){
     //The book file and the cover file are given unique id keys
     $ebookKey = uniqid();
     $coverKey = uniqid();
     //The book and cover files are given destination variables
     $destination = $new_location. $ebookKey. urlencode(basename($_FILES["ebookToUpload"]["name"]));
    $cover_destination = $new_location. $coverKey. urlencode(basename($_FILES["ebookCover"]["name"]));
     $ebookFileName = $ebookKey. urlencode(basename($_FILES["ebookToUpload"]["name"]));
      $coverFileName = $coverKey. urlencode(basename($_FILES["ebookCover"]["name"]));
      $toExplode = $_FILES['ebookToUpload']['name'];
      //The ebook file name is exploded and the result stored in a variable
  $file_ext = strtolower(end(explode('.', $toExplode)));
  $file_size = $_FILES['ebookToUpload']['size'];
  $cover_file_size = $_FILES['ebookCover']['size'];

//The site will not accept files over 2MB in size
if($file_size > 2000000) {
    $errors[] = 'Error: Ebook file size exceeds 2MB.';
}
if($cover_file_size > 2000000) {
    $errors[] = 'Error: Cover file size exceeds 2MB.';
}

//File extension checker code based on example from https://www.tutorialspoint.com/php/php_file_uploading.htm
$extensions = array("mobi","pdf","epub");

    if(in_array($file_ext,$extensions)=== false){
       $errors[]="Invalid ebook file extension detected. Ebook file extensions must be .mobi, .epub or .pdf";
    }

//If no errors were thrown the script executes a query to add an entry into the database using the form info
if(empty($errors) ==true ){
   $sql = "INSERT INTO bcwBooks_bookData(filename, cover_filename, title, tags, author, description, publication_date, user) VALUES (?,?,?,?,?,?,?,?)";
   $stmt = $pdo->prepare($sql);
 $stmt->execute([$ebookFileName,$coverFileName, $_POST["bookTitle"], $_POST["bookTags"], $_POST["bookAuthor"], $_POST["bookDescription"], $_POST["bookPublicationDate"], $_SESSION["user"]]);
    move_uploaded_file($_FILES["ebookToUpload"]["tmp_name"], $destination);
    move_uploaded_file($_FILES["ebookCover"]["tmp_name"], $cover_destination);
  }
  else{
    //if the errors array is not empty then the errors are printed
    print_r($errors);
  }
}
//if both an ebook and cover file were not uploaded the program will throw an error
else{
$errors[]="Error: User must upload an ebook file and a cover file.";
  print_r($errors);
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
    <header id="addBookHeader">
      <h1>Add Book</h1>
      <!-- Navigation bar -->
      <a href="index.php" id="indexButton">Home</a>
      <a href="bookShelf.php" id="bookShelfButton">BookShelf</a>
      <a href="account.php" id="accountButton">Account</a>

    </header>
<!-- display box for page elements-->
    <div class="displayBox" id="addBookDisplayBox">
      <form enctype="multipart/form-data" class="enclosedForm" id="uploadForm" action = "<?php echo $_SERVER['PHP_SELF'];?>" method = "post">
        <div class="addBookFormDiv">
          <!-- input for ebook file -->
          <label for="ebookToUpload" class="addBookLabel"
            >Upload Ebook File(.mobi, .epub, .pdf)</label
          >
          <input type="file" name="ebookToUpload" class ="required" id="ebookToUpload" required/>
        </div>
        <!-- input for ebook cover -->
        <div class="addBookFormDiv">
          <label for="ebookCover" class="addBookLabel"
            >Upload Ebook Cover(.jpg, .png)</label
          >
          <input type="file" name="ebookCover" id="ebookCover" required/>
        </div>
        <div class="addBookFormDiv">
          <label for="bookTitle" class="addBookLabel">Title: </label>
          <input
            type="text"
            placeholder="Title"
            name="bookTitle"
            id="bookTitle" class ="required"
          />
        </div>
        <!-- input for ebook author -->
        <div class="addBookFormDiv">
          <label for="bookAuthor" class="addBookLabel">Author: </label>
          <input
            type="text"
            placeholder="Author Name"
            name="bookAuthor"
            id="bookAuthor"
            required
          />
        </div>
        <!-- input for ebook description -->
        <div class="addBookFormDiv" id="addBookFormTextareaDiv">
          <label class="addBookLabel">Description: </label>
          <textarea name="bookDescription"  rows="10" cols="100"> </textarea>
        </div>
        <!-- input for ebook tags -->
        <div class="addBookFormDiv">
          <label for="bookTags" class="addBookLabel">Tags: </label>
          <input
            type="text"
            placeholder="Tag1, Tag2, Tag3..."
            name="bookTags"
            id="bookTags"
            required
          />
        </div>
        <!-- input for ebook publication date -->
        <div class="addBookFormDiv">
          <label for="bookPublicationDate" class="addBookLabel">Publication Date: </label>
          <input
            type="date"
            value="2019-07-06"
            name="bookPublicationDate"
            id="bookPublicationDate"
            required
          />
        </div>
        <!-- submit button -->
        <div class="addBookFormDiv">
          <input type="submit" name="addBook" />
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
