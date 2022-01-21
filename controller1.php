
<!-- EDIT QUESTION CONTROLLER -->

<?php

require_once 'db_connection.php';

function formhandling(){

    global $db;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {  

        $id = mysqli_real_escape_string($db,$_POST['id']);

        $answers = $_POST["answer"];

        $question =mysqli_real_escape_string($db,$_POST['question']);

        $answer1 = $answers[0];
        $answer2 = $answers[1];
        $answer3 = $answers[2] ?? null;
        $answer4 = $answers[3] ?? null;

        //print_r($answers);
        //exit;

        

        $check = mysqli_real_escape_string($db,$_POST['correctanswer']);

        $query = "UPDATE `questions_table` SET `question`='$question' WHERE qid='$id'"; 

        $db->query($query);

        //          DELETING ANSWER FROM THE ANSWER TABLE

        $query = "DELETE FROM `answer_table` WHERE qid='$id'"; 

        $result= $db->query($query);


        //          UPDATING ANSWER TO THE ANSWER TABLE  

        $query = "INSERT INTO answer_table (answer,qid) VALUES ('$answer1','$id')";

        $db->query($query);

        $query = "INSERT INTO answer_table (answer,qid) VALUES ('$answer2','$id')";

        $db->query($query);

        if(!empty($answer3)){

            $query = "INSERT INTO answer_table (answer,qid) VALUES ('$answer3','$id')";

            $db->query($query);

        }
        if(!empty($answer4)){

            $query = "INSERT INTO answer_table (answer,qid) VALUES ('$answer4','$id')";

            $db->query($query);
        }

        $check = $_POST['correctanswer'];
        $crtanswer =$answers[$check];


        //        UDATING THE CORRECT ANSWER TO THE ANSWER TABLE
        
        $query = "SELECT ans_id FROM `answer_table` WHERE answer='$crtanswer'";

        $result= $db->query($query);
        
        $ans_id = $result->fetch_assoc();

        $query = "UPDATE `questions_table` SET `ans_id`='$ans_id[ans_id]' WHERE question='$question'";
        
        $result= $db->query($query);

        $strurl = "https://localhost/quiz/adminuser_page.php";
        header('Location: '.$strurl);
        
        $db -> close();


    }
}
formhandling();


?>

