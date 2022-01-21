
<!-- STUDENT LOGIN PAGE -->

<!doctype html>
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
      <li class="active"><a href="#">Student login</a></li>
      <!--<li><a href="edit_student.php">Edit Student</a></li>-->
      <li><a href="admin_login.php">Admin login</a></li>
      <li><a href="student_signin.php">Sign in</a></li>
    </ul>
  </div>
  </nav>

  <?php


    include 'db_connection.php';

    if (session_status() !== PHP_SESSION_NONE) {
      session_destroy();
    }

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        global $db;
        
        $username = $_POST['email'];
        $password = $_POST['psw'];

        $error = "Username/password incorrect";

        //    SELECTING STUDENT FROM STUDENTS TABLE

        $sql = "SELECT student_username,student_password from student_table where student_username='$username'";
        $result =$db->query($sql);
        $temp = true;
        while($student = $result->fetch_assoc()){

          $pasw = $student['student_password']; 
          if(password_verify($password,$pasw)){

            session_start();
            $_SESSION["uname"] = $username;
              //$_SESSION["error"] = $error;

            $temp = false;
            $strurl = "https://localhost/quiz/student_page.php?id=$username";
            header('Location: '.$strurl);
          }
        }
        if($temp){
          $_SESSION["error"] = $error;
          $temp = true;
        }
        $db -> close();
    
    }  
  ?>

    <!--    STUDENT LOGIN FORM  -->

  <div class="container">
  <div class="jumbotron"> 
      <h2 class="display-4">Student login</h1><br>
    <form method="post" id="studentForm" name="studentForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <label for="email"><b>Email</b></label><br>
      <input type="text" placeholder="Enter Email" name="email">
      <br><br>
      <label for="psw"><b>Password</b></label><br>
      <input type="password" placeholder="Enter Password" name="psw">
      <br><br>
      <button type="submit" name="submit" class="btn btn-default">Submit</button>
    </form>
    <?php
         if(isset($_SESSION["error"])){
                 $error = $_SESSION["error"];
                 echo "<span style='color: red;'>$error</span>";
         }
    ?> 
  </div>
  </div>

  <script src="https://localhost/quiz/libraries/jquery.min.js"></script>
  <script src="https://localhost/quiz/libraries/bootstrap.min.js"></script>
  <script src="https://localhost/quiz/libraries/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://localhost/quiz/libraries/jquery.validate.js"></script>
  <script src="https://localhost/quiz/student-validation.js"></script>
</body>