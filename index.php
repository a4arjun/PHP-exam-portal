<?php
session_start();
session_unset();
session_destroy();
 ?>
<!DOCTYPE html>
<html>
<head>
    <title>Quiz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <link rel="stylesheet" type="text/css" href="css/custom.css">
     <meta id="Viewport" name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
</head>
<body class="text-center">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
  <header class="masthead mb-auto">
    <div class="inner">
      <h3 class="masthead-brand">mocktest.io</h3>
      <nav class="nav nav-masthead justify-content-center">
        <a class="nav-link active" href="#">Home</a>
        <a class="nav-link" href="#">Features</a>
        <a class="nav-link" href="#">Contact</a>
      </nav>
    </div>
  </header>

  <main role="main" class="inner cover">
    <h1 class="cover-heading">mocktest.io</h1>
    <p class="lead">Create and Share mocktests for free.</p>
    <p class="lead">
      <a href="test.php" class="btn btn-rounded btn-md btn-primary">Create Test</a>
      <a data-toggle="modal" data-target="#myModal" class="btn text-dark btn-rounded btn-md btn-secondary">Take Test</a>
    </p>
  </main>

  <?php 
  session_start();
  if (isset($_GET['key']) and $_GET['key'] != '') {
    $_SESSION['exam_key'] = strip_tags($_GET['key']);
    header('Location:register.php');
    exit;
  }
  if (isset($_GET['key']) and $_GET['key'] == '') {
    echo '<script>alert("Please enter a valid key")</script>';
  }

  ?>
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
    
      <!-- Modal content-->
      <div class="modal-content">
      <form action="" method="get">  
        <div class="modal-header">
          
          <h4 class="modal-title text-dark">Modal Header</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body text-dark">
            <input type="text" name="key" placeholder="Enter Your Exam Key Here" class="form-control">
          
        </div>
        <div class="modal-footer">
          <input type="submit" name="btnSubmit" value="Okay" class="btn btn-sm btn-success">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </form>
      </div>
      
    </div>
  </div>


  <!--footer-->
  <footer class="mastfoot mt-auto">
    <div class="inner">
      <p>mocktest.io</p>
    </div>
  </footer>
</div>



<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body></html>