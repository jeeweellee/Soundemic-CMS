<?php 

    /* Jewel Faith Feliciano
       Project - Soundemic CMS Application (index.php)
       The home page where posts are displayed.
       November 15, 2021
    */

    $thisPage = 'index';

    // Connect to the database.
    require('connect.php');

    $query = "SELECT * FROM songs ORDER BY currentDate DESC LIMIT 6";

    // To prepare the statement from the query.
    $statement = $db->prepare($query);

    // Executes the statement.
    $statement->execute(); 

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Soundemic | Home</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>

  <body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="#">
                <span class="glyphicon glyphicon-equalizer" aria-hidden="true"></span><b> SOUNDEMIC</b>
              </a> 
            </div>
        </div>
    </nav>

    <!-- Home Page Title -->
    <div class="jumbotron" style="text-align: center">
      <div class="container">
        <h1>Listening is everything</h1>
        <p>With Soundemic, you can create your own music and discover millions of tracks. <br>This will allow you to get access to limitless, uninterrupted listening together even while apart. <br>If you’ve got the vibe, REGISTER NOW!</p>
        <p><a class="btn btn-primary btn-lg main-color-bg" href="register.php" role="button">Register</a> <a class="btn btn-default btn-lg" href="login.php" role="button">Login</a></p>        
      </div>
    </div>


    <!-- Home Page Content -->
    <div class="container">      
      <div class="row">
        <?php while ($row = $statement->fetch()): ?>
          <div class="col-md-4">
          <h2><a href="show.php?songId=<?= $row['songId'] ?>&genreId=<?= $row['genreId'] ?>&p=<?= (str_replace(' ', '-', strtolower($row['title']))) ?>" style="color: #342b0f"><?= $row['title'] ?></a></h2>
            <p><?= strlen($row['description']) >= 110 ? substr($row['description'], 0, 110) . "..." : $row['description'] ?></p>
          </div>
        <?php endwhile ?>
      </div>  
    </div>

    <!-- Footer -->
    <?php include("footer.php") ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
