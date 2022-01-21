<!--    STUDENT RESULT CONTROLLER --> 

<?php

require_once 'db_connection.php';

session_start();

function formhandling(){

    global $db;

    if ($_SERVER["REQUEST_METHOD"] == "POST") { 


        $username = $_POST['id'];
        $answers = $_POST['quizcheck'];

        //print_r($answers);
        //exit;
        
        //     SELECTING QUESTION FROM QUESTION TABLE
        $q = "select * from questions_table where deleted_at =0";
        $query= $db->query($q);
        $count = 0;
        $total = 0;


        $check = true;
        while($result = $query->fetch_assoc()){

                $ans_id = $result['qid'];
                $ans = $answers[$ans_id] ?? null;
                if($result['ans_id'] == $ans)
                    {
                        $count++;
                    }
                    $total++;
            
        }

        $percent = ceil(($count/$total) * 100);



        echo "<h3>Total score is " .$count. " out of ".$total. " and the percentage of marks acquired is ".$percent."% </h3>";

        //      DISPLAYING THE QUESTIONS AND CORRECT ANSWERS

        $q = "SELECT `student_id`, `score` FROM `student_results`";
        $query= $db->query($q);
        $valid = true;
        while($result=$query->fetch_assoc()){
        
            if($result['student_id']==$username){
                $q = "UPDATE `student_results` SET `score`='$count' WHERE student_id = '$username'";
                $db->query($q);
                $valid = false;
            }
        }
        if($valid){
            $query = "INSERT INTO `student_results`(`student_id`, `score`) VALUES ('$username','$count')";
            $db->query($query);
        }
        echo "<h3>Answers</h3>";
        $q ="SELECT questions_table.ans_id AS Ans,questions_table.question AS Question,answer_table.answer AS Answer,answer_table.ans_id AS Ansid FROM `answer_table` INNER JOIN questions_table ON questions_table.qid = answer_table.qid WHERE questions_table.deleted_at IS NULL";
        $query= $db->query($q);
        $qno = 1;
        $questioncheck = "";
        while($result=$query->fetch_assoc()){

            $riddle = $result['Question'];
        
            //echo "<p>" . $qno ."." . $result['Question'] ."</p>";
            if($riddle != $questioncheck){
                echo "<p>" . $qno ."." . $result['Question'] ."</p>";
                $questioncheck = $riddle;
                $qno++;
              }
            if($result['Ans']==$result['Ansid']){   
                echo "<p   style='background: chartreuse; margin-left: 50;'>" . $result['Answer'] ."</p>";
            }
            else{
                echo "<p style='margin-left: 50;'>" . $result['Answer'] ."</p>";
            }
        }
        echo " <br>   <a href='https://localhost/quiz/student_login.php'>
        <button>
            Logout
        </button>
            </a>";
        session_destroy();
    }
    
}

formhandling();

?>