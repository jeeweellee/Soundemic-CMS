<?php

    /* Jewel Faith Feliciano
       Project - Soundemic CMS Application (register.php)
       Provides a form where the users can register for an account.
       November 15, 2021
    */
    
    session_start();
    require("connect.php");

    $errorMessage = "";
    $registerUser = filter_input(INPUT_POST, 'registerUser', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $registerEmail = filter_input(INPUT_POST, 'registerEmail', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $registerPassword = filter_input(INPUT_POST, 'registerPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $hashPassword = password_hash($registerPassword, PASSWORD_DEFAULT);

    if (isset($_POST['register'])) {

      $registeredUsers = "INSERT INTO users (userId, username, email, hashpassword, userType) VALUES (NULL, '$registerUser', '$registerEmail', '$hashPassword', 'User')";

      if ($_POST['registerPassword'] == $_POST['registerReenter']) {

        $query = "SELECT * FROM users WHERE username = ?";

        // To prepare the statement from the query.
        $statement = $db->prepare($query);

        // Executes the statement.
        $statement->execute([$registerUser]);

        // Counts each row present in the database.
        $row = $statement->rowCount();

        // If there are rows present
        if ($row > 0) {
          $errorMessage = "Username is already taken!";
        }
        else {
          $statement = $db->prepare($registeredUsers);
          $statement->execute();

          // Stores session user and redirects after REGISTRATION.
          $_SESSION['loggedIn_user'] = $registerUser;
          header("Location: user_index.php");
        }
      }
      else {
        $errorMessage = "Passwords does not match! Please try again.";
      }

    }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SOUNDEMIC | Register</title>
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
                    <h1 class="text-center">Register<small> Account Login</small></h1>
                </div>
            </div>
        </div>
    </header> 

    <!-- Registration Form -->
    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-4 col-md-offset-4">
            <ul class="nav nav-tabs" id="login">
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php" class="active main-color-bg">Register</a></li>
            </ul>
            <div class="tab-content">
              <form action="register.php" method="post" class="well">
                <h1 class="heading">Sign Up</h1>
                  <div class="form-group">
                      <label><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Username</label>
                      <input type="text" name="registerUser" id="registerUser" class="form-control" placeholder="Enter Username" required>
                  </div>
                  <div class="form-group">
                      <label><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Email Address</label>
                      <input type="email" name="registerEmail" id="registerEmail"   class="form-control" placeholder="Enter Email" required>
                  </div>
                  <div class="form-group">
                      <label><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Password</label>
                      <input type="password" name="registerPassword" id="registerPassword" class="form-control" placeholder="Password" required>
                  </div>
                  <div class="form-group">
                      <label><span class="glyphicon glyphicon-lock" aria-hidden="true"></span> Re-enter Password</label>
                      <input type="password" name="registerReenter" id="registerReenter" class="form-control" placeholder="Password" required>
                  </div>
                  <div class="row">
                    <div class="col-sm-12 text-center">
                        <input type="submit" name="register" class="btn btn-default btn-md main-color-bg" value="Register">
                        <a class="btn btn-default btn-md" href="index.php" role="button">Back</a> 
                    </div>
                  </div>
              </form>
            </div>

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
