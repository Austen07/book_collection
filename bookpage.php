<?php include('includes/database.php'); ?>

<?php
						//
						$page=isset($_GET['page'])?$_GET['page']:1;		
						$pageSize=20;	//number of items in each page
							
						
						//
						$query = "SELECT count(*) AS 'numbers' FROM book";
						$result = $mysqli->query($query);
						$maxRow = $result->fetch_assoc();
            $maxRows=$maxRow['numbers'];
						
            //
						$maxPages = ceil($maxRows/$pageSize); 
						

						//
						if($page>$maxPages){
							$page=$maxPages;
						}
						if($page<1){
							$page=1;
						}
						
						//
						$limit = " limit ".(($page-1)*$pageSize).",{$pageSize}";   
					
					
					//"SELECT * FROM book ORDER BY id DESC {$limit}";
						$query = "SELECT * FROM book 
                      INNER JOIN booklanguage
                      ON book.bolanguage=booklanguage.lan_id
                      INNER JOIN category
                      ON book.category=category.cate_id
                      INNER JOIN publisher
                      ON book.publisher=publisher.pub_id
                      ORDER BY book.id DESC {$limit}";


						$result =$mysqli->query($query) or die($mysqli->error.__LINE__);
						
					
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
              <li class="nav-item ">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
              </li>
               <li class="nav-item active">
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


          <div class="row">
            <div class="col-lg-12">
            <?php if (isset($_GET['msg'])){
                  echo '<div class="msg">'. $_GET['msg'].'</div>';
                  }
            ?>

         <br> <h2>Book list</h2> </br>
           <div align="left">
				<?php
				    echo "Page{$page}/{$maxPages},&nbsp ";
					  echo "20 items/Page";
			    ?>
		    </div>
		    <div align="left">
			    <?php
					echo " <a href='bookpage.php?page=1'>First Page&nbsp&nbsp</a> &nbsp";
					echo " <a href='bookpage.php?page=".($page-1)."'>Previous</a>&nbsp &nbsp ";
					echo " <a href='bookpage.php?page=".($page+1)."'>Next</a>&nbsp ";
					echo " <a href='bookpage.php?page={$maxPages}'>&nbsp &nbsp Last Page</a> ";
			  	?>
			  </div>


     <table class="table">
        <thead>
         <tr>
         <th>ISBN</th>
         <th>Book Title</th>
         <th>Book Author</th>
         <th>Book Language</th>
         <th>Book Category</th>
         <th>Book Publisher</th>
         <th>Book Price</th>
         <th>Edit</th>
         <th>Delete</th>
         </tr>
       </thead>

             <tbody>
          <?php  
            //Check if at least one row is found
      if($result->num_rows > 0) {
			     
           while($row = $result->fetch_assoc()){
							
                    $output ='<tr>';
                   // $output .='<th scope="row">'.$row['id'].'</th>';
                    $output .='<td>'.$row['isbn'].'</td>';
                    $output .='<td>'.$row['title'].'</td>';
                    $output .='<td>'.$row['author'].'</td>';
                    $output .='<td>'.$row['book_language'].'</td>';
                    $output .='<td>'.$row['book_category'].'</td>';
                    $output .='<td>'.$row['book_publisher'].'</td>';
                    $output .='<td>'.$row['price'].'</td>';
                    $output .='<td><a href="edit_book.php?id='.$row['id'].'" class="btn btn-outline-secondary btn-sm">Edit</a></td>';
                    $output .='<td><a href="delete_book.php?id='.$row['id'].'" class="btn btn-outline-secondary btn-sm">Delete</a></td>'; 
                    $output .='</tr>';
                    echo $output;
			    	}
      }

          ?>
             </tbody>

     </table>
   			
		</div>
      
      </div>

      <div align="left">
        <?php
            echo "Page{$page}/{$maxPages},&nbsp ";
            echo "20 items/Page";
          ?>
        </div>
        <div align="left">
          <?php
          echo " <a href='bookpage.php?page=1'>First Page&nbsp&nbsp</a> &nbsp";
          echo " <a href='bookpage.php?page=".($page-1)."'>Previous</a>&nbsp &nbsp ";
          echo " <a href='bookpage.php?page=".($page+1)."'>Next</a>&nbsp ";
          echo " <a href='bookpage.php?page={$maxPages}'>&nbsp &nbspLast Page</a> ";
          ?>
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
