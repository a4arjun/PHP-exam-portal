<!DOCTYPE html>
<html>
<head>
  <meta id="Viewport" name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
	<title>Quiz</title>
  <link rel="stylesheet" href="css/index.css"/>
</head>
<body id="test" onmousedown='return false;' onselectstart='return false;'>
  <div class="container">
<div id="quiz">
  <div id="quiz-header">
  </div>
  <div id="quiz-start-screen">
    <h1>Super quiz</h1>
    <p class="faded">Simple and exciting quiz game</p>
    <p><a href="#" id="quiz-start-btn" class="quiz-button">START</a></p>
    <p><a href="#" id="quiz-start-btn" class="quiz-button">CREATE</a></p>
  </div>
</div>
</div>
<!-- Latest compiled and minified JavaScript -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="js/index.js"></script>
<script type="text/javascript">
$('#quiz').quiz({
  counterFormat: '<b><font size="4.5">Question %current</b></font>/%total',
  questions: [
<?php include 'questions.php'; ?>
]
});  
</script>

</body>
</html>