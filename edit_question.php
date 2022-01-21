<html lang="en">
  <head>
    <title>Quiz</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://localhost/quiz/libraries/bootstrap.min.css">

  </head>
  <body>

    <?php
    
    include 'db_connection.php';

    session_start();

    $id = $_GET['id'];
    $sql = "SELECT questions_table.question AS Question,answer_table.answer AS Answer FROM `answer_table` INNER JOIN questions_table ON questions_table.qid = answer_table.qid WHERE questions_table.deleted_at=0 AND questions_table.qid='$id'"; 

    $ques = "";
    $answer = array("","","","");
    $i=0;

    $result = $db->query($sql);
    
        while($row = $result->fetch_assoc()){

            $ques = $row['Question'];
            $answer[$i] = $row['Answer'];
            $i++;
        }    
    

    
    ?>

    <!-- EDIT QUESTIONS FORM -->

    <div class="container">
          <form name="edit_question" id="edit_question" method="post" action="controller1.php" style="margin-top: 50px;">
            
                    <div class="input_fields_wrap">
                        <textarea name="question" id="question"><?php echo $ques;?></textarea><br><br>
                        <button class="add_field_button">Add More Fields</button><br><br>
                        <?php 
                          for($j=0;$j<$i;$j++){
                            echo "
                              <div>
                                <input type='radio' name=correctanswer value=$j>
                                <input type='text' name='answer[]' id='answer[]' placeholder='FILL THE ANSWER FIELD' value=$answer[$j]>";
                                echo $j>1 ? "<a href='#' class='remove_field'>Remove</a>" : "";
                              echo "</div><br>";
                          }
                        ?>


                        
                        <div><input type="hidden" id="id" name="id" value="<?php echo $id;?>"></div>
                    </div>
                    <br><br>
            <input type="submit" class="btn btn-success" name="addsubmit" id="addsubmit" value="Submit">
          </form>
          <a href='https://localhost/quiz/questions_preview.php'>
            <button>
                Cancel
            </button>
          </a>
    </div>

    <script src="https://localhost/quiz/libraries/jquery.min.js"></script>
    <script src="https://localhost/quiz/libraries/bootstrap.min.js"></script>
    <script src="https://localhost/quiz/libraries/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://localhost/quiz/libraries/jquery.validate.js"></script>
    <script src="https://localhost/quiz/editform-validation.js"></script>
    </body>
</html>

<script>

//      ADD EXTRA FIELDS FUNCTION

$(document).ready(function() {
	var max_fields      = 4; //maximum input boxes allowed
	var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
	var add_button      = $(".add_field_button"); //Add button ID

  //var inputFormDiv = document.getElementById('inputForm');
  var count = document.getElementsByName('answer[]').length;
  //debugger;

	var x = count; //initlal text box count
	$(add_button).click(function(e){ //on add input button click
		e.preventDefault();
		if(x < max_fields){ //max input box allowed
			$(wrapper).append('<div><input name="correctanswer" type="radio" value='+x+'><input type="text" id="answer[]" name="answer[]" placeholder="FILL THE ANSWER FIELD"/><a href="#" class="remove_field">Remove</a></div><br>'); //add input box
			//$("input[id*=answer]").rules("add", "required");
      x++; //text box increment
		}
    else{
      $('.add_field_button').hide();
    }
	});

  //      REMOVE EXTRA FIELDS FUNCTION
	
	$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault(); 
    var tr = $(this);
    $(this).parent('div').remove(); 
    x--;
    if(x < max_fields){
      $('.add_field_button').show();
    }
	})
});

</script>

