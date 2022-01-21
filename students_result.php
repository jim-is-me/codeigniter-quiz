
<!-- STUDENT RESULTS TABLE PAGE -->

<html lang="en">
  <head>
    <title>Quiz</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://localhost/quiz/libraries/bootstrap.min.css">
    <style>
    table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    }

    td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
    }

    tr:nth-child(even) {
    background-color: #dddddd;
    }
    </style>
  </head>
  <body>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
        <a class="navbar-brand" href="#">WebSiteName</a>
        </div>
        <ul class="nav navbar-nav">
        <li><a href="questions_preview.php">Questions preview</a></li>
        <li class="active"><a href="#">Student results</a></li>
        <!--<li><a href="edit_student.php">Edit Student</a></li>-->
        <li><a href="adminuser_page.php">Create questions</a></li>
        <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
  </nav>

  <!-- STUDENS RESULT TABLE -->

  <table border='1'>

        <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Score</th>

  <?php

    include  'db_connection.php';

    session_start();

    if(!isset($_SESSION['username'])){

      $strurl = "https://localhost/quiz/admin_login.php";
      header('Location: '.$strurl);
    
    }

    //      GETTING RESULT FROM THE STUDENT RESULT TABLE

    $all = "SELECT * FROM `student_results`";
    $result = $db->query($all);


    // output data of each row
    while($user = $result->fetch_assoc()){

      ?>
      


          <tr>
              <td><?php echo $user['id'] ?></td>
              <td><?php echo $user['student_id'] ?></td>
              <td><?php echo $user['score'] ?></td>
          </tr>


      <?php } ?>
   </table>





  <script src="https://localhost/quiz/libraries/jquery.min.js"></script>
  <script src="https://localhost/quiz/libraries/bootstrap.min.js"></script>
  <script src="https://localhost/quiz/libraries/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://localhost/quiz/libraries/jquery.validate.js"></script>
  <script src="https://localhost/quiz/form-validation.js"></script>
</body>
</html>