<?php

    /* Jewel Faith Feliciano
       Project - Soundemic CMS Application (login.php)
       Provides a form where the users and admin can login.
       November 15, 2021
    */

    session_start();
    require("connect.php");

    $errorMessage = "";
    $loginId = filter_input(INPUT_POST, 'userId', FILTER_SANITIZE_NUMBER_INT);
    $loginUser = filter_input(INPUT_POST, 'loginUser', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $loginPassword = filter_input(INPUT_POST, 'loginPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (isset($_POST['login'])) {

      $query = "SELECT * FROM users WHERE username = '$loginUser'";

      // To prepare the statement from the query.
      $statement = $db->prepare($query);

      // Executes the statement.
      $statement->execute();

      // Counts each row present in the database.
      $row = $statement->rowCount();

      // If there is a row present, fetch it.
      if ($_POST && $row == 1) {
        $row = $statement->fetch();

        if (password_verify($loginPassword, $row['hashpassword'])) {
          $_SESSION['loggedIn_user'] = $loginUser;
          $_SESSION['userId'] = $row['userId'];
          header("Location: user_index.php");
        }
        else {
          $errorMessage = "Incorrect password! Please try again.";
        }
      }
      else {
        $errorMessage = "User does not exist!";
      }
    }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SOUNDEMIC | Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
  </head>

  <body>

    <!-- Header -->
    <header id="header">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="text-center">Login<small> Account Login</small></h1>
                </div>
            </div>
        </div>
    </header> 

    <!-- Login Form -->
    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <ul class="nav nav-tabs" id="login">
              <li><a href="login.php" class="active main-color-bg">Login</a></li>
              <li><a href="register.php">Register</a></li>
            </ul>            
            <form action="login.php" method="post" class="well">
              <h1 class="heading">Welcome Back</h1>
              <div class="tab-content">
                <div class="form-group tab-pane fade in active">
                    <label><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Username</label>
                    <input type="text" name="loginUser" id="loginUser" class="form-control" placeholder="Enter Username" required>
                </div>
                <div class="form-group">
                    <label><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Password</label>
                    <input type="password" name="loginPassword" id="loginPassword" class="form-control" placeholder="Password" required>
                </div>               
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <input type="submit" name="login" class="btn btn-default btn-md main-color-bg" value="Login">
                        <a class="btn btn-default btn-md" href="index.php" role="button">Back</a> 
                    </div>
                </div>
              </div>
            </form>    

            <!-- Alerts -->
            <?php if ($errorMessage): ?>
              <div class="alert alert-danger" role="alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> <?= $errorMessage ?></div>
            <?php endif ?>      

          </div>         
        </div>
      </div>
    </section>

    <!-- Footer -->
    <?php include("footer.php") ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>    
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
