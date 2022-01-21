
<!-- STUENT TEST ATTENDING PAGE -->

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
        <!--<li><a href="edit_student.php">Edit Student</a></li>-->
        <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
  </nav>

    <!--        STUDENTS QUESTION ATTENDING FORM -->
    <div class="container">
        <h3>Tick only one option</h3>
        <form name="student_answers" id="student_answers" method="post" action="controller2.php">
          <?php
              require_once 'db_connection.php';

              session_start();

              if(!isset($_SESSION['uname'])){

                //var_dump($_SESSION);
                $strurl = "https://localhost/quiz/student_login.php";
                header('Location: '.$strurl);
              }

              $name = $_GET['id'];

              //      SELECTING QUESTIONS AND COREESPONDING ANSWER FROM THE TABLE
              $query = "SELECT questions_table.qid AS Qno,questions_table.question AS Question,answer_table.answer AS Answer ,answer_table.ans_id AS id FROM `answer_table` INNER JOIN questions_table ON questions_table.qid = answer_table.qid WHERE questions_table.deleted_at IS NULL OR questions_table.deleted_at=0";
              $result = $db->query($query);
              $qno = 1;
              $questioncheck = "";
              while($question = $result->fetch_assoc()){
                  $qid = $question['Qno'];
                  $riddle = $question['Question'];
                  echo "<input type='hidden' id='id' name='id' value=$name>";
                  if($riddle != $questioncheck){
                    echo "<p id=$qid>" . $qno ."." . $question['Question'] ."</p>";
                    $questioncheck = $riddle;
                    $qno++;
                  }  
                  //quizcheck[$ans_id]'
                  $questionTemp = $question['Question'];
                  $ans =  $question['Answer'];
                  $ans_id = $question['id'];
                  echo "<input type='radio' name='quizcheck[$qid]' value=$ans_id> <label for='quizcheck[$qid]'>" . $ans ."</label><br>" ;
              }
          ?>
        <input type="submit" class="btn btn-success" name="submit" id="submit" value="Submit">
        </form>
    </div>



  <script src="https://localhost/quiz/libraries/jquery.min.js"></script>
  <script src="https://localhost/quiz/libraries/bootstrap.min.js"></script>
  <script src="https://localhost/quiz/libraries/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://localhost/quiz/libraries/jquery.validate.js"></script>
  <script src="https://localhost/quiz/form-validation.js"></script>
</body>
</html>

<!--$name = $_GET['id'];

 echo "<input type='radio' name='quizcheck[$ans_id]'  id='quizcheck[$ans_id]' value=$ans_id> <label for='quizcheck[$ans_id]'>" . $ans ."</label><br>" ;

echo "<input type='hidden' id='id' name='id' value=$name>";

        php
            require_once 'db_connection.php';

            $name = $_GET['id'];

            $query = "SELECT * FROM questions_table where deleted_at=0";
            $result = $db->query($query);
            $qno = 1;
            while($question = $result->fetch_assoc()){
                $qid = $question['qid'];
                
                echo "<input type='hidden' id='id' name='id' value=$name>";
                echo "<div class='form-check'><p>" . $qno ."." . $question['question'] ."</p>";

                
                $query = "SELECT ans_id,answer FROM `answer_table` WHERE qid=$qid";
                $res = $db->query($query);
                while($answer = $res->fetch_assoc()){

                    $ans =  $answer['answer'];
                    $ans_id = $answer['ans_id'];
                    echo "<input type='radio' name='quizcheck[$ans_id]'  id='quizcheck[$ans_id]' value=$ans_id> <label for='quizcheck[$ans_id]'>" . $ans ."</label><br>" ;
                }
                $qno++;
                echo "</div>";
            }
        ?>
