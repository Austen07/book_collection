<?php  include('includes/database.php');   ?>



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
          </div>
        </nav>
      </div>

      <!-- Jumbotron -->
      <?php if(isset($_GET['msg'])){
      echo '<div class="msg">'.$_GET['msg'].'</div>';
    }
    ?> 
      
       <br>
        <center><h1>Sort by</h1></center>
        </br>    
  
    <br><center>
     <div class="row">
        <div class="col-lg-4">
          <h2>Language</h2>
          <p><a class="btn btn-primary" href="language.php?page=1" role="button">&nbsp Go &nbsp</a></p>
        </div>
        <div class="col-lg-4">
          <h2>Category</h2>
          <p><a class="btn btn-primary" href="category.php?page=1" role="button">&nbsp Go &nbsp</a></p>
        </div>
        <div class="col-lg-4">
          <h2>Publisher</h2>
          <p><a class="btn btn-primary" href="publisher.php?page=1" role="button">&nbsp Go &nbsp</a></p>
        </div>
      </div>
    </center></br>


      <!-- Site footer -->
       </footer><footer class="footer">
        
        <center><p>&copy; Expecto Patronum</p></center>
     

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
