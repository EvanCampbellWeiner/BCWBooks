<!--
  Page Name: deleteBook.html
  Programmer Name: Alan-Michael Bradshaw and Evan Campbell-Weiner
  Language: HTML5 and PHP
  Page Description:
  deleteBook deletes a particular book.



  Includes:
  reset.css: the default css file taken from  http://meyerweb.com/eric/tools/css/reset/
  style.css: overarcing css file
-->
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

      <a href="home.html" id="homeButton">Home</a>
      <a href="index.html" id="libraryButton">Library</a>
      <a href="account.html" id="accountButton">Account</a>

      <form id="searchForm">
        <input type="text" name="searchField" value="Search" id="searchField" />
        <input type="submit" value="Search" id="searchButton" />
      </form>
    </header>
    <div class="displayBox">
      <img
        src="images/SetForLife2.jpg"
        alt="sample book cover"
        height="640"
        width="400"
      />
      <a href="">Cancel</a>
      <div id="displayBoxInner">
        <form>
          <button type="button">Delete</button>
          <input type="checkbox" name="deleteConfirm" value="deleteConfirm" />
          Yes, I want to delete this book<br />
        </form>
      </div>
    </div>
  </body>
</html>