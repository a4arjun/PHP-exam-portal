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

      <main role="main" class="inner cover text-dark">
<?php 
session_start();
include 'config.php';
if (isset($_GET['key']) and $_GET['key'] != '') {
  $url = "http://" . $_SERVER['SERVER_NAME'];
  $exam_key = $_GET['key'];
  $stmt = $db->query('SELECT * FROM exams where exam_key="'.$exam_key.'"');
  $row = $stmt->fetch();
  $count = $stmt->rowCount();

  $exam_name = $row['exam_name'];

  if ($count > 0){
?>

        
        <div class="card">
          <div class="card-body text-left">
            <h5><?php echo $exam_name; ?></h5>
          </div>
        </div>
        <br/>
        <div class="card text-left">
          <div class="card-body">
            <a href="<?php echo $url; ?>/quiz/?key=<?php echo $exam_key; ?>" class="text-white btn btn-block btn-md btn-primary">Take Test</a>
            <a href="<?php echo $url; ?>/quiz/leaderboard.php?key=<?php echo $exam_key; ?>" class="text-white btn btn-block btn-md btn-success">Leaderboard</a>
          </div>
        </div>
   

<?php
 }
else{
  ?>

<div class="card">
  <div class="card-body">
    No exam/quiz found matching your key.
  </div>
</div>
<?php
}
}else{
  echo '
<div class="card">
  <div class="card-body">
    Invalid invitation Link or Key
  </div>
</div>
  ';
}
?>

   </main>
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

</body>
</html>