<?php 
session_start();
if (isset($_GET['key'])) {
  $_SESSION['quiz_key_share'] = $_GET['key'];
  
  $quiz_key = $_SESSION['quiz_key_share'];

}else{
    header('Location:test.php');
    exit;

}
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
          <h3 class="masthead-brand">Cover</h3>
          <nav class="nav nav-masthead justify-content-center">
            <a class="nav-link active" href="#">Home</a>
            <a class="nav-link" href="#">Features</a>
            <a class="nav-link" href="#">Contact</a>
          </nav>
        </div>
      </header>

      <main role="main" class="inner cover text-dark">
        
        <div class="card">
          <div class="card-body text-left">
            Your quiz/exam has been created successfully. Please save the links for the future uses.
          </div>
        </div>
        <br/>
        <?php $url = "http://" . $_SERVER['SERVER_NAME']; ?>
        <div class="card text-left">
          <div class="card-body">
            <label><a target="_blank" class="text-primary" href="<?php echo $url; ?>/quiz/main.php?key=<?php echo $quiz_key; ?>">Link to Invite</a></label>
            <input type="text" value="<?php echo $url; ?>/quiz/main.php?key=<?php echo $quiz_key; ?>" class="form-control"><br/>
          <a href="whatsapp://send?text=You're invited to attend a Quiz. Can you answer few questions and become the champion? Click here>> <?php echo $url; ?>/quiz/main.php?key=<?php echo $quiz_key; ?>" class="btn btn-block btn-md btn-success">Share On WhatsApp</a>
          </div>
        </div>
      </main>

      <!--footer-->
      <footer class="mastfoot mt-auto">
        <p>mocktest.io</p>
      </footer>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    </body>
    </html>