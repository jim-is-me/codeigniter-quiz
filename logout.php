<?php

session_start();

if(isset($_SESSION['username'])){

    //var_dump($_SESSION);
    session_destroy();
    $strurl = "https://localhost/quiz/admin_login.php";
    header('Location: '.$strurl);
}

if(isset($_SESSION['uname'])){

    //var_dump($_SESSION);
    session_destroy();
    $strurl = "https://localhost/quiz/student_login.php";
    header('Location: '.$strurl);
}


?>