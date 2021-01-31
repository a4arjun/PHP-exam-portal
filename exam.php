<?php
require_once('config.php');
session_start();
$score = 0;
$not_attended = 0;
$question_number = 1;
$wrong_answers = 0;
$candidate = $_SESSION['candidate'];
$exam_key = $_SESSION['exam_key'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Quiz Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/custom.css">
    <style type="text/css">
        body{
            color: #000;
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

        .radio-toolbar input[type="radio"] {
          display: none;
        }

        .radio-toolbar label {
          display: inline-block;
          background: #eee;
        }

        .radio-toolbar input[type="radio"]:checked+label {
          background-color: #5cb85c;
          color: #fff;
        }

        .text-white{
            color: #000;
        }

    </style>
    <meta id="Viewport" name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
</head>
<body class="bg-light">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<nav class="navbar navbar-expand-sm bg-primary fixed-top navbar-dark">
    <a class="navbar-brand" href="#"><?php echo $candidate; ?></a>
</nav>
<br/><br/><br/>
<div class="container">

<?php

if(!isset($exam_key) or $exam_key == '' or !isset($candidate) or $candidate == '' or isset($_SESSION['attended']) and $_SESSION['attended'] == true){
    header('Location:register.php');
    exit;    
}

else if(isset($exam_key) and $exam_key != '' and isset($candidate) and $candidate != ''){

    $stmt = $db->query('SELECT * FROM questions where quiz_key="'.$_SESSION['exam_key'].'"');
    if(!isset($_POST['btnsubmit'])){echo '<form action="" method="post" id="QuizForm" name="QuizForm">';}
    while($row = $stmt->fetch()){
        $question_number ++;
        $user_answer = 'user_answer_'.$row['id'];
        $options_list = [$row['option_a'], $row['option_b'], $row['option_c'], $row['option_d']];

        if (isset($_POST['btnsubmit'])) {
            echo '<div class="card"><div class="card-body">'.$row['question'].'<br/><br/>';
            if (isset($_POST[$user_answer])) {
                
                if($_POST[$user_answer][0] == $row['ans_index']){
                    $score++;
                    echo '<div class="alert alert-success">'.$row['answer'].' (Right)</div>';
                }else{
                    echo '<div class="alert alert-danger">'.$options_list[$_POST[$user_answer][0]].' (Wrong)</div>';
                    echo '<div class="alert alert-success">'.$row['answer'].'</div>';
                    $wrong_answers++;
                }
            }else{
                echo '<div class="alert alert-primary">'.$row['answer'].' (Not attended)</div>';
                $not_attended ++;
            }

            echo '</div></div><br/>';
        }else{
            echo '
                <div class="card">
                      <div class="card-body">

                        <p class="text-center"><b>Question '.($question_number-1).'</b></p>
                        <hr/>

                        <h5 class="alert alert-success">'.$row['question'].'</h5>
                        <br/>

                        <div class="radio-toolbar">
                          <input name="user_answer_'.$row['id'].'[]" value="0" type="radio" id="radio'.($question_number+100).'"/>
                          <label class="btn btn-lg btn-outline-secondary btn-block " for="radio'.($question_number+100).'">'.$row['option_a'].'</label>

                          <input name="user_answer_'.$row['id'].'[]" value="1" type="radio" id="radio'.($question_number+200).'"/>
                          <label class="btn btn-lg btn-outline-secondary btn-block " for="radio'.($question_number+200).'">'.$row['option_b'].'</label>

                          <input name="user_answer_'.$row['id'].'[]" value="2" type="radio" id="radio'.($question_number+300).'"/>
                          <label class="btn btn-lg btn-outline-secondary btn-block " for="radio'.($question_number+300).'">'.$row['option_c'].'</label>

                          <input name="user_answer_'.$row['id'].'[]" value="3" type="radio" id="radio'.($question_number+400).'"/>
                          <label class="btn btn-lg btn-outline-secondary btn-block " for="radio'.($question_number+400).'">'.$row['option_d'].'</label>
                        </div>
                        <br/>
                    </div>
                </div>
                <br/>

            ';
        }
    }
}

if(!isset($_POST['btnsubmit']))
    echo '<br><input onClick="resetEverything()" id="btnsubmit" type="submit" name="btnsubmit" class="btn btn-lg btn-success btn-block" value="Finish"/></form><br><br>';
else{
    //echo 'Score:'.$score.'<br/>'.'Not attended:' .$not_attended;
    //echo ($not_attended/($question_number-1)*100);
    //echo "<br>".$wrong_answers;
    echo '

        <div class="card">
            <div class="card-body">
                <p class="text-center">Your score:</p>
                <h1 class="text-center"> '.$score.'/'.($question_number-1).'</h1>
                <div class="progress" style="height:30px;">
                  <div class="progress-bar bg-success" role="progressbar" style="width: '.($score/($question_number-1)*100).'%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">'.($score/($question_number-1)*100).'%</div>
                  <div class="progress-bar bg-danger" role="progressbar" style="width: '.($wrong_answers/($question_number-1)*100).'%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">'.($wrong_answers/($question_number-1)*100).'%</div>
                  <div class="progress-bar bg-info" role="progressbar" style="width: '.($not_attended/($question_number-1)*100).'%" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">'.($not_attended/($question_number-1)*100).'%</div>
            </div>
      
            <br/><Br/>

            <div class="alert alert-success bg-success text-white"><h5 class="mr-0">Right answers <span class="badge badge-light">'.$score.'</span></h5></div>
            <div class="alert bg-danger text-white"><h5 class="mr-0">Wrong answers  <span class="text-right badge badge-light">'.$wrong_answers.'</span></h5></div>
            <div class="alert bg-info text-white"><h5 class="mr-0">Not attended <span class="text-right badge badge-light">'.$not_attended.'</span></h5></div>        
        
        <br/><hr/><br/>

        <a href="leaderboard.php" class="btn btn-lg text-white btn-block btn-success">View Leaderboard</a>
        <a href="index.php" class="btn btn-lg text-white btn-block btn-warning">Back to home</a>
        <br/><br/>
        </div>
        </div>
        <br/>
    ';
    
    if ($score > 0) {
        if (isset($candidate) and $candidate != '' and isset($score) and isset($exam_key) and $exam_key != '') {
           saveScore($db, $candidate, $score, $exam_key); 
        }
        
    }
}
?>
</div>
</div>
</body>

<?php

function saveScore($db, $candidate, $score, $exam_key){
    try {
        $stmt = $db->prepare('INSERT INTO leaders (candidate, score, exam_key) VALUES (:candidate, :score, :exam_key)') ;
        $stmt->execute(array(
            ':candidate' => strip_tags($candidate),
            ':score' => strip_tags($score),
            ':exam_key' => strip_tags($exam_key)
        ));
        $response['message'] = "Added successfully";
        

      } catch(PDOException $e) {
          echo $e->getMessage();
          $response['message'] = "Error occured";
      } 
}

?>
<br><br/>
</body>
</html>