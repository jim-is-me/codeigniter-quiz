<?php

include 'db_connection.php';

session_start();

$i = $_GET['id'];
$date_time = date("Y-m-d H:i:s");
$sql = "UPDATE `questions_table` SET `deleted_at`='$date_time' WHERE qid = '$i'";

if($db->query($sql)){
  $strurl = "https://localhost/quiz/questions_preview.php";
  header('Location: '.$strurl);
}

$db -> close();

?>