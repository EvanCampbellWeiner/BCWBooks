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
  }
  include "includes/library.php";
$pdo=connectdb();
$base_location = "../../www_data/";
if (isset($_POST['editBook'])) {
$sql = "UPDATE bcwBooks_bookData SET title=?, tags=?, author=?, description=?, publication_date=? WHERE id=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_POST["bookTitle"], $_POST["bookTags"], $_POST["bookAuthor"], $_POST["bookDescription"], /*'date2'*/$_POST["bookPublicationDate"], /*'$_SESSION['user']'*/$_POST["editBook"]]);
//  $stmt->execute(['testFileName','testCoverFileName','testTitle','TestTags','testAuthor','testDescription','2019-07-06','testUser']);
$sql = "SELECT * FROM bcwBooks_bookData WHERE id=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$_POST["editBook"]]);
$book = $stmt->fetch(PDO::FETCH_ASSOC);
$cover_filename = $book['cover_filename'];
$cover_path = $base_location. $cover_filename;
$title = $book['title'];
$author = $book['author'];
$description = $book['description'];
$filename = $book['filename'];
$tags = $book['tags'];
$pubDate = $book['publication_date'];
}
else{
 $sql = "SELECT * FROM bcwBooks_bookData WHERE id=?";
 $stmt = $pdo->prepare($sql);
$stmt->execute([$_POST["coverButton"]]);
$book = $stmt->fetch(PDO::FETCH_ASSOC);
$cover_filename = $book['cover_filename'];
$cover_path = $base_location. $cover_filename;
$title = $book['title'];
$author = $book['author'];
$description = $book['description'];
$filename = $book['filename'];
$tags = $book['tags'];
$pubDate = $book['publication_date'];
}

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
    <header id="addBookHeader">
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
        alt="book cover"
        height="640"
        width="400"
      />
      <p>Description: <?php echo "$description"; ?></p>
      <p>Filename: <?php echo "$filename"; ?></p>
      <p>Tags: <?php echo "$tags"; ?></p>
      <p>Publication Date: <?php echo "$pubDate"; ?></p>
      <nav id="iconDiv">
        <!-- Icons from https://icons8.com/icons -->
        <form id="editButtonForm" method="post" action="editBook.php">
        <button type="submit" name="editButton" value = "<?php if(isset($_POST["coverButton"])){echo $_POST["coverButton"];} else{
          echo $_POST["editBook"];
        }?>" class="viewButtons"><img
            src="images/edit.png"
            alt="Edit book icon"
            height="30"
            width="30"
        /></button>
      </form>
      <form id="deleteButtonForm" method="post" action="deleteBook.php">
      <button type="submit" name="deleteButton" value = "<?php if(isset($_POST["coverButton"])){echo $_POST["coverButton"];} else{
        echo $_POST["editBook"];
      }?>" class="viewButtons"><img
          src="images/trash.png"
          alt="Delete book icon"
          height="30"
          width="30"
      /></button>
    </form>
      </nav>
    </div>
  </body>
</html>
