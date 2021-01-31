<!DOCTYPE html>
<html>
<head>
	<title>Quiz - Create</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
	<style type="text/css">
		html,
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
	</style>
	<meta id="Viewport" name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
</head>
<body>
<div class="container">

<br/>
<form enctype=”multipart/form-data” action="" method="post">
<div class="jumbotron">
  <h1 class="display-4">Hello, user!</h1>
  <p class="lead">You can add questions by using the form given below. You can add upto 50 questions for now. Please fill all the required fields. Don't forget to select the currect answer before submitting. You can't edit the questions after submitting the form</p>
  <hr class="my-4">
  <label>Title</label>
  <input autocomplete="off" type="text" name="exam-name" class="form-control" placeholder="Exam title" required><br/>
  <label>Description</label>
  <textarea class="form-control" name="exam-description" placeholder="Exam description" required></textarea>
</div>

<div class="alert alert-primary">
	<h4 class="my-0">Questions</h4>
</div>

<div class="wrapper-div">	
<div class="alert alert-primary">
<div class="row">
	<div class="col">
		<label>Question 1</label>
		<input autocomplete="off" placeholder="Question" class="form-control" type="text" name="question[]" required />
	</div>
</div><br/>
<div class="row align-items-center">	
	<br/>
	<div class="col-sm">
		<div class="input-group">
		  <div class="input-group-prepend">
		    <div class="input-group-text">
		      <input checked type="radio" name="q1_ans" value="0">
		    </div>
		  </div>
		  <input autocomplete="off" type="text" name="q1_options[]" class="form-control" placeholder="Option 1" required>
		</div>
	</div>
	<div class="col-sm">
		<div class="input-group">
		  <div class="input-group-prepend">
		    <div class="input-group-text">
		      <input type="radio" name="q1_ans" value="1">
		    </div>
		  </div>
		<input class="form-control" type="text" name="q1_options[]" placeholder="Option 2" required>	
		</div>
	</div>
	<div class="col-sm">
		<div class="input-group">
		  <div class="input-group-prepend">
		    <div class="input-group-text">
		      <input type="radio" name="q1_ans" value="2">
		    </div>
		  </div>
		<input autocomplete="off" class="form-control" type="text" name="q1_options[]" placeholder="Option 3" required>
		</div>	
	</div>
	<div class="col-sm">
		<div class="input-group">
		  <div class="input-group-prepend">
		    <div class="input-group-text">
		      <input type="radio" name="q1_ans" value="3">
		    </div>
		  </div>
		<input autocomplete="off" class="form-control" type="text" name="q1_options[]" placeholder="Option 4" required>
		</div>
	</div>
</div><br/><br/>
</div>


</div>

<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-sm">
			    <button class="btn btn-lg btn-block btn-success add_form_field">Add New &nbsp; 
		    	<span>+ </span>
		    </button>   
		    <input type="submit" value="Confirm & Save" name="save" class="btn btn-lg btn-block btn-primary">
			</div>
		</div>
	</div>
</div>
<br/><br/>
</div>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
    var max_fields = 50;
    var wrapper = $(".wrapper-div");
    var add_button = $(".add_form_field");

    var x = 1;
    $(add_button).click(function(e) {
        e.preventDefault();
        if (x < max_fields) {
            x++;
            $(wrapper).append('<div class="alert alert-primary"><div class="row"><div class="col"><label>Question '+x+'</label><input autocomplete="off" placeholder="Question" class="form-control" type="text" name="question[]" required/></div></div><br/><div class="row align-items-center"><br/><div class="col-sm"><div class="input-group"><div class="input-group-prepend"><div class="input-group-text"><input type="radio" checked name="q'+x+'_ans" value="0"></div></div><input autocomplete="off" type="text" name="q'+x+'_options[]" class="form-control" placeholder="Option 1" required></div></div><div class="col-sm"><div class="input-group"><div class="input-group-prepend"><div class="input-group-text"><input type="radio" name="q'+x+'_ans" value="1"></div></div><input autocomplete="off" class="form-control" type="text" name="q'+x+'_options[]" placeholder="Option 2" required></div></div><div class="col-sm"><div class="input-group"><div class="input-group-prepend"><div class="input-group-text"><input type="radio" name="q'+x+'_ans" value="2"></div></div><input autocomplete="off" class="form-control" type="text" name="q'+x+'_options[]" placeholder="Option 3" required></div></div><div class="col-sm"><div class="input-group"><div class="input-group-prepend"><div class="input-group-text"><input type="radio" name="q'+x+'_ans" value="3"></div></div><input autocomplete="off" class="form-control" type="text" name="q'+x+'_options[]" placeholder="Option 4" required></div></div></div><br/><button class="btn btn-sm btn-danger delete">delete</button><br/><br/></div>'); //add input box

            console.log(x);
        } else {
            alert('You Reached the limits')
        }
    });

    $(wrapper).on("click", ".delete", function(e) {
        e.preventDefault();
        $(this).parent('div').remove();
        x--;
    })
});
</script>
</body>
</html>