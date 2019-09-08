<?php  include('includes/database.php');   ?>

<?php       //
            $page=isset($_GET['page'])?$_GET['page']:1;   
            $pageSize=20; //number of items in each page
              
            
            //
            $query = "SELECT count(*) AS 'numbers' FROM book";
            $result = $mysqli->query($query);
            $maxRow = $result->fetch_assoc();
            $maxRows=$maxRow['numbers'];
            
            //
            $maxPages = ceil($maxRows/$pageSize); 
            

            $limit = " limit ".(($page-1)*$pageSize).",{$pageSize}";   
       // category
            $query2= "SELECT * FROM category
                       ORDER BY cate_id DESC";
            $result2 =$mysqli->query($query2) or die($mysqli->error.__LINE__);


      
?>



<?php  
      // sort by language 
      if($_POST){
       
       $option=$_POST['alloption']; 


       
         // sort by Categoy
         $query ="SELECT
               b.isbn, b.title, b.author,
               bl.book_language, 
               c.book_category,
               p.book_publisher,
               b.price
               FROM book AS b
               INNER JOIN booklanguage AS bl
               ON b.bolanguage=bl.lan_id
               INNER JOIN category AS c
               ON b.category=c.cate_id
               INNER JOIN publisher AS p
               ON b.publisher=p.pub_id
               WHERE c.cate_id= $option 
               ORDER BY b.id DESC 
                ";
    
       $result = $mysqli->query($query) or die($mysqli->error.__LINE__); 


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
              <li class="nav-item active">
                <a class="nav-link" href="sort.php">Sort</a>
              </li>
            </ul>
          </div>
        </nav>
      </div>

   

  <!-- Preference-->
<form method="post" action="category.php" class="form-inline">
  <label class="mr-sm-2" for="inlineFormCustomSelectPref">Category Preference</label>
  <select name="alloption" class="custom-select mb-2 mr-sm-2 mb-sm-0" id="inlineFormCustomSelectPref">
<?php 
         while($row2 = $result2->fetch_assoc()){  
          $cateid=$row2['cate_id'];
          $cate=$row2['book_category'];  
          ?>
          <option value="<?php echo $cateid ?>"><?php echo $cate ?></option>
         <?php 
        }

    ?>
  </select>
  <input type="submit" class="btn btn-primary" value="Choose"></button>
</form>



<!-- display results -->      
      <div class="row">
        <div class="col-lg-12">


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
  //
      if($result->num_rows >0) {

         while($row = $result->fetch_assoc()){

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

         }

    } else  { echo "Sorry, no book was found"; }


  ?>
   
  </tbody>

</table>

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
