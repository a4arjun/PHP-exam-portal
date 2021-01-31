<!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
	<style type="text/css">
		html,
		body{
			color: #000;
			height: auto;
		}
		.form-control{
			margin-top: 4px;
		}
		.input-group{
			margin-top: 4px;
		}
		.input-group-text{
			margin-top: 4px;
		}

	</style>

	<meta id="Viewport" name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">	
</head>
<body>
	<div class="container">
<?php
session_start();
require_once 'config.php';


//$_SESSION['exam_key'] = 'd8076d4a24daf94fb0195e0f22ea45b1589218909';
if (isset($_SESSION['exam_key'])) {
	$exam_key = $_SESSION['exam_key'];
}
if (isset($exam_key)) {
	$stmt = $db->query('SELECT * FROM exams where exam_key="'.$exam_key.'"');
	$row = $stmt->fetch();
	$count = $stmt->rowCount();

	if ($count > 0){

		if(isset($exam_key) and $exam_key != '' and isset($_POST['candidate']) and $_POST['candidate'] != '') {

		

		$candidate = strip_tags($_POST['candidate']);
		$_SESSION['candidate'] = $candidate;

		echo '
		<br/><br/>
		<div class="alert alert-success">
			<h5>Hello <b>'.$_SESSION['candidate'].'</b>, read the instrustions before you start</h5>
		</div>

		<div class="card">
			<div class="card-header">Instructions</div>
			<div class="card-body">
				<ul class="list-group">
					<li class="list-group-item">There will be 10 questions</li>
					<li class="list-group-item">Each question carries 1 marks.</li>
					<li class="list-group-item">There is no negative marks</li>
					<li class="list-group-item">There is a System-defined time limit. Tou will get 45 seconds per question.
				</ul>
			</div>
			<div class="card-header">Viewing and Answering</div>
			<div class="card-body">
				<ul class="list-group">
					<li class="list-group-item">To view a question, click on a Question number to expand it.</li>
					<li class="list-group-item">There will be four options. Choose the answer by clicking an option.</li>
					<li class="list-group-item">Attended questions are highlighted by "green" and those questions which are unattended are highlighted in "grey" colors.</li>
					<li class="list-group-item">When you finish answering, click the "Complete" button to view your scores and leaderboard</li>
				</ul>
				<br/><br/>
				<a class="text-white btn btn-md btn-block btn-success" href="exam.php">START EXAM</a>
			</div>
		</div>
		<br/>
		
		<br/><br/>

		';

	}
	else{
		echo '
		<br>
		<div class="card">
			<div class="card-header">Fill the form below*</div>
			<div class="card-body">
				<form action="" method="post">
					<label>Your name</label><br/>';
					if(isset($_POST['candidate']) and $_POST['candidate'] == ''){ echo "<p class='text-danger'>Please Enter your name</p>";}
		echo '		
					<input type="text" class="form-control" name="candidate" placeholder="Type Your Name Here..." ><br/>
					<input type="submit" value="CONTINUE" class="btn btn-md btn-block btn-primary">
				</form>
			</div>		
		</div>
		';
	}
}else{
	echo '

	<br/><br/><br/>


	<div class="card">
		<div class="card-body">
			<div class="text-center alert alert-danger"><h4>There\'s no matching exams were found. Your invite link may broken</h4></div>
			<a href="index.php" class="btn btn-primary btn-block">Back to Home</a>
		</div>
	</div>
	';

}

}else{
	header('Location:index.php');
    exit;
    //echo 'No key is found';
}

?>
	</div><!--end container-->
</body>
</html>