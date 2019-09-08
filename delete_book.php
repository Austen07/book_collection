<?php include('includes/database.php'); ?>
<?php
     $uid = $_GET['id'];

     
      
     $query = "SELECT * FROM book 
              INNER JOIN booklanguage
              ON book.bolanguage=booklanguage.lan_id
              INNER JOIN category
              ON book.category=category.cate_id
              INNER JOIN publisher
              ON book.publisher=publisher.pub_id
              WHERE book.id=$uid";

       $result =$mysqli->query($query) or die($mysqli->error.__LINE__);
      
      if($_POST){
        $answer=$_POST['what'];
        echo $answer;
        
        if($answer==1){
        $query="DELETE FROM book
               WHERE id=$uid";
        $result =$mysqli->query($query) or die($mysqli->error.__LINE__);
        
        $msg='book deleted';
        header('Location: bookpage.php?msg='.urlencode($msg).'');
        exit;
        } else{

          header('Location: bookpage.php');
          exit;
        }

      }
        

?>
<?php

 
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
          </div>
        </nav>
      </div>
     
      <div class="row">
        <div class="col-lg-12">
        <?php if (isset($_GET['msg'])){
            echo '<div class="msg">'. $_GET['msg'].'</div>';   
        }
        ?>

          <h4>Books</h4>
         
<table class="table">
   <thead>
         <tr>
         <th>ISBN</th>
         <th>Title</th>
         <th>Author</th>
         <th>Language</th>
         <th>Category</th>
         <th>Publisher</th>
         <th>Price</th>
         </tr>
       </thead>

  <tbody>
  
  <?php 
           
              $row = $result->fetch_assoc();

             //Display 
              $output ='<tr>';
              $output .='<td>'.$row['isbn'].'</td>';
              $output .='<td>'.$row['title'].'</td>';
              $output .='<td>'.$row['author'].'</td>';
              $output .='<td>'.$row['book_language'].'</td>';
              $output .='<td>'.$row['book_category'].'</td>';
              $output .='<td>'.$row['book_publisher'].'</td>';
              $output .='<td>'.$row['price'].'</td>';
              $output .='</tr>';
              echo $output;
  ?>
   
  </tbody>

</table>        
       <center> <div class="alert alert-danger" role="alert">
        Are you sure to delete this book?
        </div></center>
        <center>
<form method="post" action="delete_book.php?id=<?php echo $uid; ?>">
    <input name="what" type="radio" value="1" checeked="checked" />YES
    <input name="what" type="radio" value="0"/>No
    <input type="submit" class="btn btn-primary" value="Submit"></button>
</form></center>



      <!-- Site footer -->
      <footer class="footer">
        <center>
        <center><p>&copy; Expecto Patronum</p>  </center>
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
