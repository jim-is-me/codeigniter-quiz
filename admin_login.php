


<html lang="en">
  <head>
    <title>Bootstrap Example</title>
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
      <li><a href="student_login.php">Student login</a></li>
      <!--<li><a href="edit_student.php">Edit Student</a></li>-->
      <li class="active"><a href="#">Admin login</a></li>
      <li><a href="student_signin.php">Sign in</a></li>
    </ul>
  </div>
  </nav>


  <?php


    include 'db_connection.php';

    
    //            ADMIN LOGIN ATHORISATION
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        global $db;
        if (session_status() !== PHP_SESSION_NONE) {
          session_destroy();
        }
        $username = $_POST['email'];
        $password = $_POST['psw'];

        $error = "Username/password incorrect";

        //$sql = "SELECT `admin_username`, `admin_password` FROM `admin_table`";
        $sql = "SELECT `username`, `password`  from admin_users where username='$username'";
        $result =$db->query($sql);
        //print_r($sql);
        //exit;
        $temp = true;
        
        while($admin = $result->fetch_assoc()){

          //echo $admin['admin_password'];
          //$pasw = $admin['admin_password'];
          $pasw = $admin['password']; 
          //print_r($admin);
          //exit;
          //$hash = password_verify($password, $pasw);
          if(password_verify($password,$pasw)){

              session_start();
              $_SESSION["username"] = $username;
              //$_SESSION["error"] = $error;

              $temp = false;
              $strurl = "https://localhost/quiz/questions_preview.php";
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

   <!--    ADMIN LOGIN FORM -->

  <div class="container">
  <div class="jumbotron"> 
      <h2 class="display-4">Admin login</h1><br>
    <form method="post" id="adminForm" name="adminForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" novalidate>
      <label for="email"><b>Email</b></label><br>
      <input type="text" placeholder="Enter Email" name="email" id="email">
      <br><br>
      <label for="psw"><b>Password</b></label><br>
      <input type="password" placeholder="Enter Password" name="psw" id="psw">
      <br><br>
      <button type="submit" name="submit" class="btn btn-default">Submit</button>  
 
    </form>
    <?php

         //        SESSION AUTHORISATION
         if(isset($_SESSION["error"])){
                 $error = $_SESSION["error"];
                 echo "<span style='color: red;'>$error</span>";
                 unset($_SESSION["error"]);
         }
    ?> 
  </div>
  </div>

  <script src="https://localhost/quiz/libraries/jquery.min.js"></script>
  <script src="https://localhost/quiz/libraries/bootstrap.min.js"></script>
  <script src="https://localhost/quiz/libraries/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://localhost/quiz/libraries/jquery.validate.js"></script>
  <script src="https://localhost/quiz/admin-validation.js"></script>
</body>
</html>

