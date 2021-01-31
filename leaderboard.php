<?php 
require_once 'config.php';
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Leaderboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <link rel="stylesheet" type="text/css" href="css/custom.css">
     <meta id="Viewport" name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
</head>
<body>
<div class="container text-dark">
<br/>

<br/>

<?php 
if (isset($_GET['key']) and $_GET['key'] != '') {
	$_SESSION['exam_key'] = $_GET['key'];
}
if (isset($_SESSION['exam_key']) and $_SESSION['exam_key'] != '') {
	$exam_key = $_SESSION['exam_key'];
	echo '
		<div class="card">
			<div class="card-body">
				<h2>'.examName($db, $exam_key).'</h2>
				<hr/>
				<p>'.examDescription($db, $exam_key).'</p>
			</div>
		</div>
		<br/>
		<div class="card">
		<div class="card-body">
	';

	echo '<h4>Leaderboard</h4>';
	fetchLeaders($db, $exam_key);
	echo '
	</div>
	</div>';

}
else{
	echo '<div class="card"><div class="card-body">No results to show</div></div>';
}

function fetchLeaders($db, $exam_key){
	$stmt = $db->query('SELECT * FROM `leaders` WHERE `exam_key` = "'.$exam_key.'" ORDER BY `score` DESC');
	$count = $stmt->rowCount();
	if ($count > 0){
	echo '

	<table class="table table-striped">
		  <thead>
		    <tr>
		      <th scope="col">#</th>
		      <th scope="col">Candidate</th>
		      <th scope="col">Score</th>
		    </tr>
		  </thead>
		  <tbody>

	';
	$i = 0;
	while($row = $stmt->fetch()){
		$i++;
		echo '<tr>';
		echo '<td>'.$i.'</td>';
		echo '<td>'.$row['candidate'].'</td>';
		
		echo '<td>'.$row['score'].'<td/>';
		echo '</tr>';
	}

	echo '
		</tbody>
	</table>';	
	}else{
		echo 'No results to show';
	}
	

}

function examName($db, $exam_key){
	$stmt = $db->query('SELECT * FROM `exams` WHERE `exam_key` = "'.$exam_key.'"');;
	$row = $stmt->fetch();
	$count = $stmt->rowCount();
	if ($count>0) {
		return $row['exam_name'];
	}else
	{
		return "No results found";
	}
	
}

function examDescription($db, $exam_key){
	$stmt = $db->query('SELECT * FROM `exams` WHERE `exam_key` = "'.$exam_key.'"');;
	$row = $stmt->fetch();	
	$count = $stmt->rowCount();
	if ($count>0) {
		return $row['exam_description'];
	}else
	{
		return "";
	}
}

?>


<br/>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>