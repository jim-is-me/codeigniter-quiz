
<!-- QUESTION CREATION FORM CONTROLLER -->

<?php

require_once 'db_connection.php';

function formhandling(){

    global $db;

    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['question']) && !empty($_POST['correctanswer'])) {  

        $question =mysqli_real_escape_string($db,$_POST['question']);
        $answer1 = mysqli_real_escape_string($db,$_POST['answer1']);
        $answer2 = mysqli_real_escape_string($db,$_POST['answer2']);
        //$answer3 = mysqli_real_escape_string($db,$_POST['answer3']);
        //$answer4 = mysqli_real_escape_string($db,$_POST['answer4']);


        

        $check = mysqli_real_escape_string($db,$_POST['correctanswer']);

        // QUESTION INSERTION 
        $query = "INSERT INTO questions_table (question,ans_id,deleted_at) VALUES ('$question','1','0000:00:00')"; 

        $db->query($query);

        // GETTING QUESTION ID from data base
        $query = "SELECT qid FROM `questions_table` WHERE question='$question'";

        $result= $db->query($query);

        $qid = $result->fetch_assoc();

        // INSERTING ANSWER1

        $query = "INSERT INTO answer_table (answer,qid) VALUES ('$answer1','$qid[qid]')";

        $db->query($query);

        // INSERTING ANSWER2

        $query = "INSERT INTO answer_table (answer,qid) VALUES ('$answer2','$qid[qid]')";

        $db->query($query);

        if(isset($_POST['answer3'])){
            $answer3 = mysqli_real_escape_string($db,$_POST['answer3']);

            // INSERTING ANSWER3

            $query = "INSERT INTO answer_table (answer,qid) VALUES ('$answer3','$qid[qid]')";

            $db->query($query);
        }
        if(isset($_POST['answer4'])){
            $answer4 = mysqli_real_escape_string($db,$_POST['answer4']);

            // INSERTING ANSWER4

            $query = "INSERT INTO answer_table (answer,qid) VALUES ('$answer4','$qid[qid]')";

            $db->query($query);
        }

        $crtanswer =$_POST["answer".$check];
        
        $query = "SELECT ans_id FROM `answer_table` WHERE answer='$crtanswer'";

        $result= $db->query($query);
        
        $ans_id = $result->fetch_assoc();

        // UPDATING THE CORRECT ANSWER ID TO THE QUESTION TABLE

        $query = "UPDATE `questions_table` SET `ans_id`='$ans_id[ans_id]' WHERE question='$question'";
        
        $result= $db->query($query);

        $strurl = "https://localhost/quiz/adminuser_page.php";
        header('Location: '.$strurl);
        
        $db -> close();


    }
}
formhandling();


?>

