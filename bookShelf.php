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

//Includes/connect to database/ declare base location for files
include "includes/library.php";
 $pdo=connectdb();
 $base_location = "../../www_data/";
//if statement for if the page has been reloaded by pressing the next button
if(!isset($_POST['next'])){
  //If statement for if the page has been reloaded by oressing the search button
if(isset($_POST['searchSubmit'])){
  //search value is stored in variable and used to run a query
  $tags = "%".$_POST['searchField']."%";
  $sql = "SELECT * FROM bcwBooks_bookData WHERE user=? AND tags LIKE ?";
  $stmt = $pdo->prepare($sql);
 $stmt->execute([$_SESSION["user"], $tags]);
}
else{
//if statement for processing book deletion
 if(isset($_POST['delete'])){
   //Executes a deletion query based on the id passed by the value of the delete button
   $sql = "DELETE FROM bcwBooks_bookData WHERE id=?";
   $stmt = $pdo->prepare($sql);
 $stmt->execute([$_POST["delete"]]);
 }
//If statement for if the sort button has been pressed
if(isset($_POST['sortSubmit'])){
  //If the user selected sort by name the fetch query is ordered by title column
  if($_POST['sort'] == "name"){
     $sql = "SELECT * FROM bcwBooks_bookData WHERE user=? ORDER BY title";
  }
  else{
    //Default fetch query to get all books belonging to user, ordered by date added
     $sql = "SELECT * FROM bcwBooks_bookData WHERE user=?";
  }

}
else{
    //Default fetch query to get all books belonging to user, ordered by date added
 $sql = "SELECT * FROM bcwBooks_bookData WHERE user=?";
}
 $stmt = $pdo->prepare($sql);
$stmt->execute([$_SESSION["user"]]);
}
//Query results are stored in array
$userBooks = $stmt->fetchAll();

//increment variable
$coverCount = 0;
//array for storing book id's
$idArray = array();

//Foreach statement that grabs the id of each row from the query and stores them in an array
foreach($userBooks as $row){
$idArray[$coverCount] = $row["id"];
$coverCount++;
}
$_SESSION['idArray'] = $idArray;
}
else{
  //Id array can be stored in session for turning pages and sorting
  $idArray = $_SESSION['idArray'];
}
//Increment variable used to change books as bookshelf pages are turned
$increment = 0;

//the next button checks if the user has more books, and increases increment by 15
if(isset($_POST['next'])){
  if(isset($idArray[$_POST['next']+15])){
  $increment = $_POST['next'] + 15;
}
else{
  //If there are no more books then clicking next will load the same page
  $increment = $_POST['next'];
}
}
//The previous button will decrease increment by 15, to a minimum of 0
//clicking previous on the first page will just load the first page
if(isset($_POST['previous'])){
  if($_POST['previous'] > 0){
      $increment = $_POST['previous'] - 15;
  }

}
//Each piece of book info is stored in it's own array
$cover_filename = array();
$bookID = array();
$bookTitle = array();
$cover_path = array();
for($i = $increment; $i<$increment+15; $i++)
{
  //The info arrays are filled with info from each book
  if(isset($idArray[$i])){
    $sql = "SELECT * FROM bcwBooks_bookData WHERE id=?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$idArray[$i]]);
    $book = $stmt->fetch(PDO::FETCH_ASSOC);
    $cover_filename[$i] = $book['cover_filename'];
    $bookID[$i] = $book['id'];
    $bookTitle[$i] = $book['title'];
    $cover_path[$i] = $base_location. $cover_filename[$i];
  }
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
<!-- Primary stylesheet link -->
    <link href="css/style.css" rel="stylesheet" type="text/css" />

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>

  <body>
    <header>
      <h1>Library</h1>
      <!-- navigation buttons -->
      <a href="index.php" id="indexButton">Home</a>
      <a href="bookShelf.php" id="bookShelfButton">BookShelf</a>
      <a href="account.php" id="accountButton">Account</a>
<!-- search bar -->
      <form id="searchForm" method="post">
        <input type="text" name="searchField" id="searchField" placeholder="enter tags" action=" <?php echo $_SERVER['PHP_SELF'];?>" />
        <button type="submit" value="search" name="searchSubmit" id="searchButton" />Search</button>
      </form>
    </header>
    <div id="bodyDiv">
      <!-- form for selecting book sort method -->
      <form method = "post" action=" <?php echo $_SERVER['PHP_SELF'];?>">
                <p>Sort By:</p>
      <select name="sort" id="sortList">
        <option value="dateAdded">Date Added (default)</option>
        <option value="name">Name</option>
      </select>
      <button type="submit" id="sortButton" name="sortSubmit">Select</button>
    </form>

<!-- Bookshelf page contains 3 shelves, each with an inner and outer div. Each shelf holds 5 books in the form of buttons -->
      <div id="shelfDiv">
        <div class="shelfOuter">
          <form id='coverForm' action="viewInfo.php" method = "post" class = "coverForm">
            <?php
            //for loop that repeats up to five times, creating book buttons with the correct cover and id value pulled from the corresponding array
            for($i=$increment; $i<$increment+5; $i++):
              if(isset($bookID[$i])):
              ?>
            <button type='submit' name='coverButton' value = "<?php echo $bookID[$i];?>"
            class='coverButton'>
            <img
            src= "<?php echo ($cover_path[$i]); ?>"
            alt= "<?php echo $bookTitle[$i]; ?>"
            height='240'
            width='140'/>
            </button>
            <?php endif; endfor;?>
          </form>
        <div class = "shelfInner"></div>
      </div>
      <!-- Bookshelf page contains 3 shelves, each with an inner and outer div. Each shelf holds 5 books in the form of buttons -->
        <div class="shelfOuter">
            <form id='coverForm' action="viewInfo.php" method = "post" class = "coverForm">
            <?php
              //for loop that repeats up to five times, creating book buttons with the correct cover and id value pulled from the corresponding array
            for($i=$increment+5; $i<$increment+10; $i++):
              if(isset($bookID[$i])):
              ?>
            <button type='submit' name='coverButton' value = "<?php echo $bookID[$i];?>"
            class='coverButton'>
            <img
            src= "<?php echo ($cover_path[$i]); ?>"
            alt= "<?php echo $bookTitle[$i]; ?>"
            height='240'
            width='140'/>
            </button>
            <?php endif; endfor;?>
          </form>
        <div class = "shelfInner"></div>
        </div>
        <!-- Bookshelf page contains 3 shelves, each with an inner and outer div. Each shelf holds 5 books in the form of buttons -->
        <div class="shelfOuter">
            <form id='coverForm' action="viewInfo.php" method = "post" class = "coverForm">
              <?php
                //for loop that repeats up to five times, creating book buttons with the correct cover and id value pulled from the corresponding array
              for($i=$increment+10; $i<$increment+15; $i++):
                if(isset($bookID[$i])):
                ?>
              <button type='submit' name='coverButton' value = "<?php echo $bookID[$i];?>"
              class='coverButton'>
              <img
              src= "<?php echo ($cover_path[$i]); ?>"
              alt= "<?php echo $bookTitle[$i]; ?>"
              height='240'
              width='140'/>
              </button>
              <?php endif; endfor;?>
          </form>
          <div class="shelfInner"></div>
        </div>
        <nav id="shelfNav">
          <!-- Add icon sourced from https://icons8.com/icons/set/plus -->
          <!-- addBook button -->
          <a href="addBook.php" id="addBook"
            ><img
              src="images/plus-icon.png"
              alt="Add book icon"
              height="30"
              width="30"
          /></a>
            <!-- next and previous page buttons for the bookshelf -->
  <form method = "post" id="shelfNavForm" action=" <?php echo $_SERVER['PHP_SELF'];?>">
    <button type="submit" name="previous" class = "shelfButtons" value="<?php echo $increment;?>" alt="Previous page button">Previous Page</button>
<button type="submit" name="next" class = "shelfButtons" value="<?php echo $increment;?>" alt="Next page button">Next Page</button>
  </form>
        </nav>
      </div>
    </div>
  </body>
</html>
