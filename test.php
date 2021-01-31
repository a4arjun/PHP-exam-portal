<?php
//session_start();
require_once 'config.php';
if (isset($_POST['save'])) {

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
		//echo $answer_index.'<hr/></div>';

		if (isset($question) && $question !== '' && isset($option_a) && $option_a !== '' && isset($option_b) && $option_b != '' && isset($option_c) && $option_c !== '' && isset($option_d) && $option_d !== '' && isset($answer_index) && $answer_index !== '') {
			addQuiz($db, $question, $option_a, $option_b, $option_c, $option_d, $answer, $category, $answer_index, $quiz_key);
			
			echo $quiz_key;

		}
		else{
			echo "<script>alert('Please fill all required fields')</script>";
		}
		
	}

	if (isset($exam_name) and $exam_name != '' and isset($exam_description) and $exam_description != '' and isset($quiz_key)) {
		saveExam($db,$exam_name, $exam_description, $quiz_key);
	}



}
else{

defaultPage();

}


function defaultPage(){
	include 'default.php';
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


	$response['message'] = "done";
	

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

		///$_SESSION['quiz_key_share'] = $exam_key;
		header('Location:success.php?key='.$exam_key.'');
    	exit;

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