<?php  include('includes/database.php');   ?>

<?php
    if($_POST){

      
      $isbn = mysqli_real_escape_string($mysqli, $_POST['isbn']);
      $title = mysqli_real_escape_string($mysqli, $_POST['title']);
      $author = mysqli_real_escape_string($mysqli, $_POST['author']);
      $bolanguage = mysqli_real_escape_string($mysqli, $_POST['bolanguage']);
      $category = mysqli_real_escape_string($mysqli, $_POST['category']);
      $publisher = mysqli_real_escape_string($mysqli, $_POST['publisher']);
      $price = mysqli_real_escape_string($mysqli, $_POST['price']);
    
    //Create language query
    $query ="INSERT IGNORE INTO booklanguage (book_language) VALUES ('$bolanguage')";
    $mysqli->query($query);

    $queryid ="SELECT lan_id FROM booklanguage WHERE book_language = '$bolanguage' ";
    $result=$mysqli->query($queryid);
    $id_lan=$result->fetch_assoc();

    // Create category query
    $query ="INSERT IGNORE INTO category (book_category) VALUES ('$category')";
    $mysqli->query($query);

    $queryid ="SELECT cate_id FROM category WHERE book_category = '$category' ";
    $result=$mysqli->query($queryid);
    $id_cate=$result->fetch_assoc();

   // Create publisher query
    $query ="INSERT IGNORE INTO publisher (book_publisher) VALUES ('$publisher')";
    $mysqli->query($query);

    $queryid ="SELECT pub_id FROM publisher WHERE book_publisher = '$publisher' ";
    $result=$mysqli->query($queryid);
    $id_pub=$result->fetch_assoc();
    
    
    // Create book query and run
    $query ="INSERT INTO book (isbn,title,author,price,bolanguage,category,publisher)
                  VALUES ('$isbn','$title','$author','$price','".$id_lan['lan_id']."','".$id_cate['cate_id']."','".$id_pub['pub_id']."')";
    $mysqli->query($query);


    $msg='book added';
    header('Location: index.php?msg='.urlencode($msg).'');
    exit;
    
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Book Collection</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/justified-nav.css" rel="stylesheet">
  </head>

  <body>

    <div class="container">

      <div class="masthead">
        <h3 class="text-muted">Book Collection</h3>

        <nav class="navbar navbar-expand-md navbar-light bg-light rounded mb-3">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav text-md-center nav-justified w-100">
              <li class="nav-item">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="bookpage.php?page=1">Book List</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="add_book.php">Add Book</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="sort.php">Sort</a>
              </li>
            </ul>
          </div>
        </nav>
      </div>

      <!-- Example row of columns -->
      <div class="row">
        <div class="col-lg-12">
          <h2>Add Book</h2>
         
<form role="form" method="post" action="add_book.php">
  <div class="form-group">
    <label>ISBN</label>
    <input name="isbn" type="text" class="form-control" placeholder="Enter ISBN">
    <small id="emailHelp" class="form-text text-muted">Standard format is x-xxxxx-xxx-x.</small>
  </div>
  <div class="form-group">
    <label>Book Title</label>
    <input name="title" type="text" class="form-control" placeholder="Enter Title">
  </div>
  <div class="form-group">
    <label>Author</label>
    <input name="author" type="text" class="form-control" placeholder="Enter Author">
  </div>
  <div class="form-group">
    <label>Language</label>
    <input name="bolanguage" type="text" class="form-control" placeholder="Enter Language">
  </div>
  <div class="form-group">
    <label>Category</label>
    <input name="category" type="text" class="form-control" placeholder="Enter Category">
  </div>
  <div class="form-group">
    <label>Publisher</label>
    <input name="publisher" type="text" class="form-control" placeholder="Enter Publisher">
  </div>
  <div class="form-group">
    <label>Price</label>
    <input name="price" type="text" class="form-control" placeholder="Enter Price">
  </div>


  <input type="submit" class="btn btn-primary" value="Add Book" />
</form>









        </div>
      
      </div>

      <!-- Site footer -->
      <footer class="footer">
        <center><p>&copy; Expecto Patronum</p></center>
      </footer>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../../../assets/js/vendor/popper.min.js"></script>
    <script src="../../../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
