
<!-- STUDENT SIGNUP PAGE -->

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
        <li><a href="admin_login.php">Admin login</a></li>
        <li class="active"><a href="#">Sign in</a></li>
        </ul>
    </div>
    </nav>

<?php


include 'db_connection.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    global $db;
    
    $username = $_POST['email'];
    $password = $_POST['psw'];

    $error = "Username already exists";

    //$error = "Username/password incorrect";
    $password = password_hash($password, PASSWORD_DEFAULT);
    $valid = true;
    $sql = "SELECT `student_username` FROM `student_table`";
    $query= $db->query($sql);
    while($result=$query->fetch_assoc()){
      if(strcmp($username,$result['student_username'])==0){
        $valid = false;
      }
    }

    if($valid){
      $sql = "INSERT INTO `student_table`(`student_username`, `student_password`) VALUES ('$username','$password')";

      if($db->query($sql)){
            $strurl = "https://localhost/quiz/student_login.php";
            header('Location: '.$strurl);
      }
    }
    else{
      $_SESSION["error"] = $error;
      $valid = true;
    }

    $db -> close();

}  
?>
    <!--            STUDENT SIGINUP FORM -->
    <div class="container">
        <div class="jumbotron"> 
        <h2 class="display-4">Student signup page</h1><br>
            <form method="post" id="studentForm" name="studentForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <label for="email"><b>Email</b></label><br>
                <input type="email" placeholder="Enter Email" name="email">
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
</html>