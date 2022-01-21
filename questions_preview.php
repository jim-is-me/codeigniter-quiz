
<!-- QUESTIONS PREVIEW PAGE -->

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
        <li class="active"><a href="#">Questions preview</a></li>
        <li><a href="students_result.php">Student results</a></li>
        <!--<li><a href="edit_student.php">Edit Student</a></li>-->
        <li><a href="adminuser_page.php"> Create questions</a></li>
        <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
  </nav>

    <div class="container">
        <h3>Questions preview</h3>
        <?php
            require_once 'db_connection.php';

            session_start();

            if(!isset($_SESSION['username'])){

              //var_dump($_SESSION);
              $strurl = "https://localhost/quiz/admin_login.php";
              header('Location: '.$strurl);
            }

            //      SELECTING THE QUESTIONS FROM QUESTIONS TABLE TO PREVIEW

            $query = "SELECT questions_table.qid AS Qno,questions_table.question AS Question,answer_table.answer AS Answer FROM `answer_table` INNER JOIN questions_table ON questions_table.qid = answer_table.qid WHERE questions_table.deleted_at IS NULL OR questions_table.deleted_at=0 ORDER BY questions_table.qid DESC";
            $result = $db->query($query);
            $qno = 1;
            $questioncheck = "";
  
            while($question = $result->fetch_assoc()){
                $qid = $question['Qno'];
                $riddle = $question['Question'];

                //        DISPLAYING QUESITIONS

                if($riddle != $questioncheck){
                  echo "<p id=$qid>" . $qno ."." . $question['Question'] ." <button class='btn btn-danger btn-sm remove'>Delete</button>&ensp;<button><a href = 'edit_question.php?id=$qid'>Edit</a></button></p>";
                  $questioncheck = $riddle;
                  $qno++;
                }  
                
                //        DISPLAYING ANSWERS

                $ans =  $question['Answer'];
                echo "<input type='radio' name='answer' disabled> <label for='answer'>" . $ans ."</label><br>" ;
               
            }
        ?>
    </div>



  <script src="https://localhost/quiz/libraries/jquery.min.js"></script>
  <script src="https://localhost/quiz/libraries/bootstrap.min.js"></script>
  <script src="https://localhost/quiz/libraries/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://localhost/quiz/libraries/jquery.validate.js"></script>
  <script src="https://localhost/quiz/form-validation.js"></script>
  
  <!--      DELETE QUESTION FUNCTION -->
  
  <script>
        $(".remove").click(function(){
        var id = $(this).parents("p").attr("id");;


          if(confirm('Are you sure to remove this record ?'))
          {
              $.ajax({
                url: 'delete_question.php',
                type: 'GET',
                data: {id: id},
                error: function() {
                    alert('Something is wrong');
                },
                success: function(data) {
                      $("#"+id).remove();
                      alert("Record removed successfully"); 
                      location.reload()
                }
              });
          }
      });
  </script>
</body>
</html>

