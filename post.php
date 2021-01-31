<!DOCTYPE html>
<html>
<head>
	<title>Confirm & Save exam</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<style type="text/css">
			html, body {
				scrollbar-width: none; 
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
			.btn-link {
				text-align: center;
			}
			#accordion {text-align: left};
		</style>
		<meta id="Viewport" name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
</head>
<body>
	<div class="container">
	<br/>



	<div class="accordion" id="accord">
<?php

require_once 'config.php';

$questions = $_POST['question'];

$exam_name = $_POST['exam-name'];
$exam_description = $_POST['exam-description'];

$quiz_key = rand_char(5);

$category = "user added";


for ($que_num=0; $que_num < count($_POST['question']); $que_num++) { 

	$ans = 'q'. ($que_num + 1).'_ans';

	$options = 'q'. ($que_num + 1) .'_options';

	$all_options = $_POST[$options];

	//prints 4 options
	for ($option_num=0; $option_num < count($_POST[$options]); $option_num++) { 
		//echo $all_options[$option_num];
	}

	$question = strip_tags($_POST['question'][$que_num]);

	$option_a = strip_tags($all_options[0]);
	$option_b = strip_tags($all_options[1]);
	$option_c = strip_tags($all_options[2]);
	$option_d = strip_tags($all_options[3]);

	$answer = strip_tags($all_options[$_POST[$ans]]);

	//prints correct ans index
	$answer_index = $_POST[$ans];
	//echo $_POST['question'][$que_num];


	$question_number = $que_num + 1;

	echo '
	  	<div class="card">
	    <div class="card-header" id="heading'.$question_number.'">
	      <h2 class="mb-0">
	        <button class="btn btn-link text-left" type="button" data-toggle="collapse" data-target="#collapseOne'.$question_number.'" aria-expanded="false" aria-controls="collapseOne'.$question_number.'">
	          '.$question_number.')'.$question.'
	        </button>
	      </h2>
	    </div>

	    <div id="collapseOne'.$question_number.'" class="collapse hide" aria-labelledby="heading'.$question_number.'" data-parent="#accord">
	      <div class="card-body">
			<div class="row">
				<div class="col-sm"><h6 class="alert alert-info">a) '.$option_a.'</h6></div>
				<div class="col-sm"><h6 class="alert alert-info">b) '.$option_b.'</h6></div>
			</div>
			<div class="row">
				<div class="col-sm"><h6 class="alert alert-info">c) '.$option_c.'</h6></div>
				<div class="col-sm"><h6 class="alert alert-info">d) '.$option_d.'</h6></div>
			</div>
			<div class="row">
				<div class="col-sm"><h6 class="alert alert-success">Answer:<b> '.$answer.'</b></h6></div>
			</div>
	      </div>
	    </div>
	  </div>
	';

	//echo $answer_index.'<hr/></div>';

	if (isset($question) && $question !== '' && isset($option_a) && $option_a !== '' && isset($option_b) && $option_b != '' && isset($option_c) && $option_c !== '' && isset($option_d) && $option_d !== '' && isset($answer_index) && $answer_index !== '') {
		addQuiz($db, $question, $option_a, $option_b, $option_c, $option_d, $answer, $category, $answer_index, $quiz_key);
		saveExam($db,$exam_name, $exam_description, $quiz_key);
        header('Location: view-pages.php?action=added');
        exit;
		echo $quiz_key;
	}
	else{
		echo "Please fill all required fields";
	}
	
}


function addQuiz($db, $question, $option_a, $option_b, $option_c, $option_d, $answer, $category, $ans_index, $quiz_key){
      try {
    	$stmt = $db->prepare('INSERT INTO questions (question, answer, option_a, option_b, option_c, option_d, category, ans_index, quiz_key) VALUES (:question, :answer, :option_a, :option_b, :option_c, :option_d, :category, :ans_index, :quiz_key)') ;
    	$stmt->execute(array(
      		':question' => $question,
      		':answer' => $answer,
      		':option_a' => $option_a,
      		':option_b' => $option_b,
      		':option_c' => $option_c,
      		':option_d' => $option_d,
      		':category' => $category,
      		':ans_index' => $ans_index,
      		':quiz_key' => $quiz_key
    ));
	$response['message'] = "Added successfully";
	echo json_encode($response);

  } catch(PDOException $e) {
      echo $e->getMessage();
      $response['message'] = "Error occured";
      echo json_encode($response);
  }
}

function saveExam($db, $exam_title, $exam_description, $exam_key){
    try {
    	$stmt = $db->prepare('INSERT INTO exams (exam_name, exam_description, exam_key) VALUES (:exam_name, :exam_description, :exam_key)') ;
    	$stmt->execute(array(
      		':exam_name' => $exam_title,
      		':exam_description' => $exam_description,
      		':exam_key' => $exam_key
	    ));
		$response['message'] = "Added successfully";
		echo json_encode($response);

	  } catch(PDOException $e) {
	      echo $e->getMessage();
	      $response['message'] = "Error occured";
	      echo json_encode($response);
	  }
}

function rand_char($length) {
  $random = '';
  for ($i = 0; $i < $length; $i++) {
    $random .= chr(mt_rand(33, 126));
  }
  return md5($random).time();
}

?>

  <!--accord-->
</div>
</div>
<br/><br/>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>