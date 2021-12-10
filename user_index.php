<?php 

    /* Jewel Faith Feliciano
       Project - Soundemic CMS Application (user_index.php)
       The home page where posts of users are displayed.
       November 15, 2021
    */

  $thisPage = 'user_index';
  
	// Connect to the database.
	require('connect.php');
   
  if(session_status() !== PHP_SESSION_ACTIVE) { 
      session_start(); 
  } 

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
    <title>Soundemic | Users Home</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>

  <body>

    <!-- Navigation Bar -->
    <?php include("nav.php") ?>

    <!-- User Home Page Title -->
    <div class="jumbotron" style="text-align: center">
      <div class="container">
        <h1>Welcome to Soundemic!</h1>
        <p>Listening is everything, this is where you can create your own music and discover millions of tracks. <br>This will allow you to get access to limitless, uninterrupted listening together even while apart.</p>  
      </div>
    </div>

    <!-- Home Page Content -->
    <div class="container">      
      <div class="row">
        <?php while ($row = $statement->fetch()): ?>
          <div class="col-md-4">
            <h2><a href="user_show.php?songId=<?= $row['songId'] ?>&genreId=<?= $row['genreId'] ?>&p=<?= (str_replace(' ', '-', strtolower($row['title']))) ?>" style="color: #342b0f"><?= $row['title'] ?></a></h2>
            <p><?= strlen($row['description']) >= 110 ? substr($row['description'], 0, 110) . "..." : $row['description'] ?></p>
            <?php if ($loggedInUser == 'admin'): ?>
              <a class="btn btn-default" href="edit_song.php?songId=<?= $row['songId'] ?>&genreId=<?= $row['genreId'] ?>" role="button">Edit</a>
            <?php endif ?>
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
