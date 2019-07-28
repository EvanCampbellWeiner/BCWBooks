<?php
/*
  Page Name: deleteBook.php
  Programmer Name: Alan-Michael Bradshaw and Evan Campbell-Weiner
  Language: HTML5 and PHP
  Page Description:
  deleteBook deletes a particular book.



  Includes:
  reset.css: the default css file taken from  http://meyerweb.com/eric/tools/css/reset/
  style.css: overarcing css file*/

  session_start(); //start session
  //check session for user info
  if(!isset($_SESSION['user'])){
    //no user info, redirect
    header("Location:login.php");
    exit();
  }
  include "includes/library.php";
$pdo=connectdb();
$base_location = "../../www_data/";
 $sql = "SELECT * FROM bcwBooks_bookData WHERE id=?";
 $stmt = $pdo->prepare($sql);
$stmt->execute([$_POST["deleteButton"]]);
$book = $stmt->fetch(PDO::FETCH_ASSOC);
$cover_filename = $book['cover_filename'];
$cover_path = $base_location. $cover_filename;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Delete Book</title>
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
      <h1>Delete Book</h1>
      <a href="index.php" id="indexButton">Home</a>
      <a href="bookShelf.php" id="bookShelfButton">BookShelf</a>
      <a href="account.php" id="accountButton">Account</a>

    </header>
    <div class="displayBox">
      <img
        src="<?php echo "$cover_path"; ?>"
        alt="sample book cover"
        height="640"
        width="400"
      />
      <form id='cancelForm' action="viewInfo.php" method = "post">
      <button type="submit" name="coverButton" value = "<?php echo $_POST["deleteButton"]; ?>">Cancel
</button>
</form>
      <div id="displayBoxInner">
        <form method = "post" action="bookShelf.php">
          <button type="submit" id = "deletion" name="delete" value="<?php echo $_POST["deleteButton"]; ?>">Delete</button>
          <input type="checkbox" name="deleteConfirm" value="deleteConfirm" required/>
          Yes, I want to delete this book<br />
        </form>
      </div>
    </div>
  </body>
</html>
