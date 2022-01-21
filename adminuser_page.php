
<!--        QUESTIONS CREATIONS PAGE -->

<html lang="en">
  <head>
    <title>Quiz</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://localhost/quiz/libraries/bootstrap.min.css">

  </head>
  <body>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
        <a class="navbar-brand" href="#">WebSiteName</a>
        </div>
        <ul class="nav navbar-nav">
        <li><a href="questions_preview.php">Questions preview</a></li>
        <li><a href="students_result.php">Student results</a></li>
        <!--<li><a href="edit_student.php">Edit Student</a></li>-->
        <li class="active"><a href="#">Create questions</a></li>
        <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
  </nav>
    
    <?php

      // SESSION AUTHORISATION
      session_start();

      if(!isset($_SESSION['username'])){

        //var_dump($_SESSION);
        $strurl = "https://localhost/quiz/admin_login.php";
        header('Location: '.$strurl);
      }

    ?>

    <!--        QUESION CREATION FORM -->

    <div class="container">
          <form name="add_question" id="add_question" method="post" action="controller.php" novalidate>
            
                    <div class="input_fields_wrap">
                        <textarea placeholder="Enter the question" name="question" id="question"></textarea><br><br>
                        <button class="add_field_button">Add More Fields</button><br><br>
                        <div>
                          <input type="radio" name="correctanswer" id="correctanswer" value="1">
                          <input type="text" name="answer1" id="answer1">
                        </div><br>
                        <div>
                          <input type="radio" name="correctanswer" id="correctanswer" value="2">
                          <input type="text" name="answer2" id="answer2">
                        </div><br>
                    </div>
                    <br><br>
            <input type="submit" class="btn btn-success" name="submit" id="submitquestion" value="Submit">
          </form>
    </div>



  <script src="https://localhost/quiz/libraries/jquery.min.js"></script>
  <script src="https://localhost/quiz/libraries/bootstrap.min.js"></script>
  <script src="https://localhost/quiz/libraries/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://localhost/quiz/libraries/jquery.validate.js"></script>
  <script src="https://localhost/quiz/form-validation.js"></script>
</body>
</html>

<script>

//       ADD FIELDS FUNCTION

$(document).ready(function() {
	var max_fields      = 4; //maximum input boxes allowed
	var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
	var add_button      = $(".add_field_button"); //Add button ID
	
	var x = 2; //initlal text box count
	$(add_button).click(function(e){ //on add input button click
		e.preventDefault();
		if(x < max_fields){ //max input box allowed
			x++; //text box increment
      $(wrapper).append('<div><input name="correctanswer" type="radio" value='+x+'><input id=answer'+x+' type="text" name="answer'+x+'"><a href="#" class="remove_field">Remove</a></div><br>'); //add input box
		}
	});
	
//    DELETE FIELDS FUNCTION
  
	$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').remove(); x--;
	})
});

</script>