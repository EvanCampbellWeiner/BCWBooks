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
  }
   include "includes/library.php";
 $pdo=connectdb();
 $base_location = "../../www_data/";
 $sql = "SELECT * FROM bcwBooks_bookData WHERE user=?";
 $stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION["user"]]);
$userBooks = $stmt->fetchAll();

$coverCount = 0;
$idArray = array();

  foreach($userBooks as $row){
$idArray[$coverCount] = $row["id"];
$coverCount++;
}

 //
 if(isset($idArray[0])){
  $sql = "SELECT * FROM bcwBooks_bookData WHERE id=?";
  $stmt = $pdo->prepare($sql);
$stmt->execute([$idArray[0]]);
$book1 = $stmt->fetch(PDO::FETCH_ASSOC);
$cover_filename1 = $book1['cover_filename'];
$book1ID = $book1['id'];
$book1Title = $book1['title'];
$cover_path1 = $base_location. $cover_filename1;
}
//
if(isset($idArray[1])){
$sql = "SELECT * FROM bcwBooks_bookData WHERE id=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$idArray[1]]);
$book2 = $stmt->fetch(PDO::FETCH_ASSOC);
$cover_filename2 = $book2['cover_filename'];
$book2ID = $book2['id'];
$book2Title = $book2['title'];
$cover_path2 = $base_location. $cover_filename2;
}
//
if(isset($idArray[2])){
$sql = "SELECT * FROM bcwBooks_bookData WHERE id=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$idArray[2]]);
$book3 = $stmt->fetch(PDO::FETCH_ASSOC);
$cover_filename3 = $book3['cover_filename'];
$book3ID = $book3['id'];
$book3Title = $book3['title'];
$cover_path3 = $base_location. $cover_filename3;
}
//
if(isset($idArray[3])){
$sql = "SELECT * FROM bcwBooks_bookData WHERE id=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$idArray[3]]);
$book4 = $stmt->fetch(PDO::FETCH_ASSOC);
$cover_filename4 = $book4['cover_filename'];
$book4ID = $book4['id'];
$book4Title = $book4['title'];
$cover_path4 = $base_location. $cover_filename4;
}
//
if(isset($idArray[4])){
$sql = "SELECT * FROM bcwBooks_bookData WHERE id=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$idArray[4]]);
$book5 = $stmt->fetch(PDO::FETCH_ASSOC);
$cover_filename5 = $book5['cover_filename'];
$book5ID = $book5['id'];
$book5Title = $book5['title'];
$cover_path5 = $base_location. $cover_filename5;
}
//
if(isset($idArray[5])){
$sql = "SELECT * FROM bcwBooks_bookData WHERE id=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$idArray[5]]);
$book6 = $stmt->fetch(PDO::FETCH_ASSOC);
$cover_filename6 = $book6['cover_filename'];
$book6ID = $book6['id'];
$book6Title = $book6['title'];
$cover_path6 = $base_location. $cover_filename6;
}
//
if(isset($idArray[6])){
$sql = "SELECT * FROM bcwBooks_bookData WHERE id=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$idArray[6]]);
$book7 = $stmt->fetch(PDO::FETCH_ASSOC);
$cover_filename7 = $book7['cover_filename'];
$book7ID = $book7['id'];
$book7Title = $book7['title'];
$cover_path7 = $base_location. $cover_filename7;
}
//
if(isset($idArray[7])){
$sql = "SELECT * FROM bcwBooks_bookData WHERE id=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$idArray[7]]);
$book8 = $stmt->fetch(PDO::FETCH_ASSOC);
$cover_filename8 = $book8['cover_filename'];
$book8ID = $book8['id'];
$book8Title = $book8['title'];
$cover_path8 = $base_location. $cover_filename8;
}
//
if(isset($idArray[8])){
$sql = "SELECT * FROM bcwBooks_bookData WHERE id=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$idArray[8]]);
$book9 = $stmt->fetch(PDO::FETCH_ASSOC);
$cover_filename9 = $book9['cover_filename'];
$book9ID = $book9['id'];
$book9Title = $book9['title'];
$cover_path9 = $base_location. $cover_filename9;
}
//
if(isset($idArray[9])){
$sql = "SELECT * FROM bcwBooks_bookData WHERE id=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$idArray[9]]);
$book10 = $stmt->fetch(PDO::FETCH_ASSOC);
$cover_filename10 = $book10['cover_filename'];
$book10ID = $book10['id'];
$book10Title = $book10['title'];
$cover_path10 = $base_location. $cover_filename10;
}
//
if(isset($idArray[10])){
$sql = "SELECT * FROM bcwBooks_bookData WHERE id=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$idArray[10]]);
$book11 = $stmt->fetch(PDO::FETCH_ASSOC);
$cover_filename11 = $book11['cover_filename'];
$book11ID = $book11['id'];
$book11Title = $book11['title'];
$cover_path11 = $base_location. $cover_filename11;
}
//
if(isset($idArray[11])){
$sql = "SELECT * FROM bcwBooks_bookData WHERE id=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$idArray[11]]);
$book12 = $stmt->fetch(PDO::FETCH_ASSOC);
$cover_filename12 = $book12['cover_filename'];
$book12ID = $book12['id'];
$book12Title = $book12['title'];
$cover_path12 = $base_location. $cover_filename12;
}
//
if(isset($idArray[12])){
$sql = "SELECT * FROM bcwBooks_bookData WHERE id=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$idArray[12]]);
$book13 = $stmt->fetch(PDO::FETCH_ASSOC);
$cover_filename13 = $book13['cover_filename'];
$book13ID = $book13['id'];
$book13Title = $book13['title'];
$cover_path13 = $base_location. $cover_filename13;
}
//
if(isset($idArray[13])){
$sql = "SELECT * FROM bcwBooks_bookData WHERE id=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$idArray[13]]);
$book14 = $stmt->fetch(PDO::FETCH_ASSOC);
$cover_filename14 = $book14['cover_filename'];
$book14ID = $book14['id'];
$book14Title = $book14['title'];
$cover_path14 = $base_location. $cover_filename14;
}
//
if(isset($idArray[14])){
$sql = "SELECT * FROM bcwBooks_bookData WHERE id=?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$idArray[14]]);
$book15 = $stmt->fetch(PDO::FETCH_ASSOC);
$cover_filename15 = $book15['cover_filename'];
$book15ID = $book15['id'];
$book15Title = $book15['title'];
$cover_path15 = $base_location. $cover_filename15;
}
//

if(isset($_POST['delete'])){
  $sql = "DELETE FROM bcwBooks_bookData WHERE id=?";
  $stmt = $pdo->prepare($sql);
$stmt->execute([$_POST["delete"]]);
}

//echo $cover_path;


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Main Page</title>
    <link href="css/reset.css" rel="stylesheet" type="text/css" />
    <!-- reset.css file taken from assignment 1 -->

    <!-- Stylesheet link for using icons from FontAwesome.com -->
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
      integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf"
      crossorigin="anonymous"
    />

    <link href="css/style.css" rel="stylesheet" type="text/css" />

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
      </select>
      <p>Sort By:</p>

      <div id="shelfDiv">
        <div class="shelfOuter">
          <form id='coverForm' action="viewInfo.php" method = "post" class = "coverForm">
              <?php if(isset($book1)){
                echo"
          <button type='submit' name='coverButton' value = "; ?> <?php echo $book1ID; ?> <?php echo" class='coverButton'><img
                    src= ";?> <?php echo ($cover_path2); ?><?php echo" alt= "; ?> <?php echo $book1Title; ?> <?php echo "
                    height='240'
                    width='140'/>
</button>
 "; } ?>
<button type="submit" name="coverButton" value ="<?php echo "$book2ID"; ?>" class="coverButton"><img
          src="<?php echo "$cover_path2"; ?>"
          alt="book cover"
          height="240"
          width="140"/>
</button>
<button type="submit" name="coverButton" value ="<?php echo "$book3ID"; ?>" class="coverButton"><img
          src="<?php echo "$cover_path3"; ?>"
          alt="book cover"
          height="240"
          width="140"/>
</button>
<button type="submit" name="coverButton" value ="<?php echo "$book4ID"; ?>" class="coverButton"><img
          src="<?php echo "$cover_path4"; ?>"
          alt="book cover"
          height="240"
          width="140"/>
</button>
<button type="submit" name="coverButton" value ="<?php echo "$book5ID"; ?>" class="coverButton"><img
          src="<?php echo "$cover_path5"; ?>"
          alt="book cover"
          height="240"
          width="140"/>
</button>
</form>
          <div class="shelfInner"></div>
        </div>
        <div class="shelfOuter" id="shelfOuter2">

          <form id='coverForm' action="viewInfo.php" method = "post" class = "coverForm">

            <button type="submit" name="coverButton" value ="<?php echo "$book6ID"; ?>" class="coverButton"><img
                      src="<?php echo "$cover_path6"; ?>"
                      alt="book cover"
                      height="240"
                      width="140"/>
            </button>

            <button type="submit" name="coverButton" value ="<?php echo "$book7ID"; ?>" class="coverButton"><img
                      src="<?php echo "$cover_path7"; ?>"
                      alt="book cover"
                      height="240"
                      width="140"/>
            </button>
            <button type="submit" name="coverButton" value ="<?php echo "$book8ID"; ?>" class="coverButton"><img
                      src="<?php echo "$cover_path8"; ?>"
                      alt="book cover"
                      height="240"
                      width="140"/>
            </button>
            <button type="submit" name="coverButton" value ="<?php echo "$book9ID"; ?>" class="coverButton"><img
                      src="<?php echo "$cover_path9"; ?>"
                      alt="book cover"
                      height="240"
                      width="140"/>
            </button>
            <button type="submit" name="coverButton" value ="<?php echo "$book10ID"; ?>" class="coverButton"><img
                      src="<?php echo "$cover_path10"; ?>"
                      alt="book cover"
                      height="240"
                      width="140"/>
            </button>
          </form>
          <div class="shelfInner"></div>
        </div>
        <div class="shelfOuter" id="shelfOuter3">
          <form id='coverForm' action="viewInfo.php" method = "post" class = "coverForm">
            <button type="submit" name="coverButton" value ="<?php echo "$book11ID"; ?>" class="coverButton"><img
                      src="<?php echo "$cover_path11"; ?>"
                      alt="book cover"
                      height="240"
                      width="140"/>
            </button>
            <button type="submit" name="coverButton" value ="<?php echo "$book12ID"; ?>" class="coverButton"><img
                      src="<?php echo "$cover_path12"; ?>"
                      alt="book cover"
                      height="240"
                      width="140"/>
            </button>
            <button type="submit" name="coverButton" value ="<?php echo "$book13ID"; ?>" class="coverButton"><img
                      src="<?php echo "$cover_path13"; ?>"
                      alt="book cover"
                      height="240"
                      width="140"/>
            </button>
            <button type="submit" name="coverButton" value ="<?php echo "$book14ID"; ?>" class="coverButton"><img
                      src="<?php echo "$cover_path14"; ?>"
                      alt="book cover"
                      height="240"
                      width="140"/>
            </button>
            <button type="submit" name="coverButton" value ="<?php echo "$book15ID"; ?>" class="coverButton"><img
                      src="<?php echo "$cover_path15"; ?>"
                      alt="book cover"
                      height="240"
                      width="140"/>
            </button>
          </form>
          <div class="shelfInner"></div>
        </div>
        <nav id="shelfNav">
          <!-- Add icon sourced from https://icons8.com/icons/set/plus -->
          <a href="addBook.php" id="addBook"
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
