<?php include 'config.php';

//header("Content-type: application/json; charset=utf-8");
$stmt = $db->query("SELECT * FROM questions ORDER BY id DESC LIMIT 10");
while($row = $stmt->fetch()){

	echo "{\n";
	echo "\t'q': '".$row['question']."',\n";
	echo "\t'options': [";
	echo "\n\t\t'".$row['option_a']."',";
	echo "\n\t\t'".$row['option_b']."',";
	echo "\n\t\t'".$row['option_c']."',";
	echo "\n\t\t'".$row['option_d']."'";
	echo "\n\t],";
	echo "\n\t'correctIndex': ".$row['ans_index'].",";
	echo "\n\t'correctResponse': 'Good job. You\'ve done it',";
	echo "\n\t'incorrectResponse': 'Sorry. That was a wrong answer'";
	echo "\n},";
	echo "\n\n";

}

?>