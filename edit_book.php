<?php include('includes/database.php'); ?>
<?php
  //GET url id
  $uid = $_GET['id'];
  
  $query ="SELECT * FROM book 
          INNER JOIN booklanguage
          ON book.bolanguage=booklanguage.lan_id
          INNER JOIN category
          ON book.category=category.cate_id
          INNER JOIN publisher
          ON book.publisher=publisher.pub_id
          WHERE book.id= $uid";

  $result = $mysqli->query($query) or die($mysqli->error.__LINE__);

  if($result = $mysqli->query($query)){
      
      while($row = $result->fetch_assoc()){
         $isbn = $row['isbn'];
         $title = $row['title'];
         $author = $row['author'];
         $language = $row['book_language'];
         $category = $row['book_category'];
         $publisher = $row['book_publisher'];
         $price = $row['price'];

      }
      $result->close();
  }


?>
<?php  

 if($_POST){

      $uid = $_GET['id'];
      
    
    // read data from form, variables name start as p_
    
      $p_isbn = mysqli_real_escape_string($mysqli, $_POST['isbn']);
      $p_title = mysqli_real_escape_string($mysqli, $_POST['title']);
      $p_author = mysqli_real_escape_string($mysqli, $_POST['author']);
      $p_language = mysqli_real_escape_string($mysqli, $_POST['language']);
      $p_category = mysqli_real_escape_string($mysqli, $_POST['category']);
      $p_publisher = mysqli_real_escape_string($mysqli, $_POST['publisher']);
      $p_price = mysqli_real_escape_string($mysqli, $_POST['price']);
    
    
    
    //1 Update booklanguage
         // judge if the updated language has already existed in table    
           $query ="INSERT IGNORE INTO booklanguage (book_language) VALUES ('$p_language')";
           $mysqli->query($query);

           $queryid ="SELECT lan_id FROM booklanguage WHERE book_language = '$p_language' ";
           $result=$mysqli->query($queryid);
           $resultid=$result->fetch_assoc();
           $lan_id=$resultid['lan_id'];

  
  

    //2 Update category 
           $query ="INSERT IGNORE INTO category (book_category) VALUES ('$p_category')";
           $mysqli->query($query);

           $queryid ="SELECT cate_id FROM category WHERE book_category = '$p_category' ";
           $result=$mysqli->query($queryid);
           $resultid=$result->fetch_assoc();
           $cate_id=$resultid['cate_id'];

          
      

    //3 Update publisher    
           $query ="INSERT IGNORE INTO publisher (book_publisher) VALUES ('$p_publisher')";
           $mysqli->query($query);

           $queryid ="SELECT pub_id FROM publisher WHERE book_publisher = '$p_publisher' ";
           $result=$mysqli->query($queryid);
           $resultid=$result->fetch_assoc();
           $pub_id=$resultid['pub_id'];
           
          

      //echo $p_language;

    //4 Update book
           $query=" UPDATE book
                  SET isbn = '$p_isbn',
                      title= '$p_title',
                      author= '$p_author',
                      price= '$p_price',
                      bolanguage= $lan_id,
                      category= $cate_id,
                      publisher= $pub_id
                  WHERE id=$uid";
          $mysqli->query($query) or die($mysqli->error.__LINE__);

   $msg='bookinfo updated';
   header('Location: bookpage.php?msg='.urlencode($msg).'');
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
              <li class="nav-item">
                <a class="nav-link" href="add_book.php">Add Book</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="sort.php">Sort</a>
              </li>
            </ul>
          </div>
        </nav>
      </div>

      <!--  row of columns -->
      <div class="row">
        <div class="col-lg-12">
          <h2>Edit Book and Update</h2>
         
<form role="form" method="post" action="edit_book.php?id=<?php echo $uid; ?>">
  <div class="form-group">
    <label>ISBN</label>
    <input name="isbn" type="text" class="form-control" 
    value="<?php echo $isbn; ?>" placeholder="Enter ISBN">
    <small id="emailHelp" class="form-text text-muted">Standard formar is x-xxxxx-xxx-x.</small>
  </div>
  <div class="form-group">
    <label>Book Title</label>
    <input name="title" type="text" class="form-control" 
    value="<?php echo $title; ?>" placeholder="Enter Title">
  </div>
  <div class="form-group">
    <label>Author</label>
    <input name="author" type="text" class="form-control" 
    value="<?php echo $author; ?>" placeholder="Enter Author">
  </div>
  <div class="form-group">
    <label>Language</label>
    <input name="language" type="text" class="form-control" 
    value="<?php echo $language; ?>" placeholder="Enter Language">
  </div>
  <div class="form-group">
    <label>Category</label>
    <input name="category" type="text" class="form-control" 
    value="<?php echo $category; ?>" placeholder="Enter Category">
  </div>
  <div class="form-group">
    <label>Publisher</label>
    <input name="publisher" type="text" class="form-control" 
    value="<?php echo $publisher; ?>" placeholder="Enter Publisher">
  </div>
  <div class="form-group">
    <label>Price</label>
    <input name="price" type="text" class="form-control" 
    value="<?php echo $price; ?>" placeholder="Enter Price">
  </div>


  <input type="submit" class="btn btn-primary" value="Update Book" />
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
