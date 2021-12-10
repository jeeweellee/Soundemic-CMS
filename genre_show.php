<?php 

    /* Jewel Faith Feliciano
       Project - Soundemic CMS Application (genre.php)
       The genre page to display all the songs with categories.
       November 15, 2021
    */

    // Connect to the database.
    require('connect.php');

    if(session_status() !== PHP_SESSION_ACTIVE) { 
      session_start(); 
    }

    // To display songs according to its genre
    if(isset($_GET['genreId'])) {
        
      $genreId = filter_input(INPUT_GET, 'genreId', FILTER_SANITIZE_NUMBER_INT);

      $query = "SELECT * FROM songs WHERE genreId = :genreId";
      $statement = $db->prepare($query);
      $statement->bindValue(":genreId", $genreId, PDO::PARAM_INT);
      $statement->execute(); 	
      $row = $statement->fetch();

      $query2 = "SELECT * FROM songs JOIN genre ON songs.genreId = genre.genreId WHERE songs.genreId = :genreId ORDER BY currentDate LIMIT 6";

      $statement2 = $db->prepare($query2);
      $statement2->bindValue(":genreId", $genreId, PDO::PARAM_INT);
      $statement2->execute(); 
  }
  else {
      $genreId = false;
  }

  // Displays all genre in a nav
  $genre = "SELECT * FROM genre ORDER BY genreId";
  $statement3 = $db->prepare($genre);
  $statement3->execute();

  // Displays all songs
  $songs = "SELECT * FROM songs JOIN genre ON songs.genreId = genre.genreId";
  $statement4 = $db->prepare($songs);
  $statement4->execute();
  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SOUNDEMIC | Genre</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>

  <body>

    <!-- Navigation Bar -->
    <?php include("nav.php") ?>

    <div class="jumbotron" style="text-align: center">
      <div class="container">
        <h1>Genre</h1>
        <p class="lead">All the best new tracks, in one place. Choose what you want to listen to, or let Soundemic surprise you.<br> You can also browse songs through the genre specified to look for your specified taste, or create a song and just sit back.<br> Soundtrack your life with Soundemic. Subscribe or listen for free <span class="glyphicon glyphicon-headphones"></span></p>
      </div>
    </div>

    <!-- Display Genre -->
    <div class="container">
      <div class="masthead">
        <nav style="display: inline-block">
          <ul class="nav nav-justified">
            <?php while($row = $statement3->fetch()): ?>
              <li class="active"><a class="list-group-item" href="genre_show.php?genreId=<?= $row['genreId'] ?>&p=<?= (str_replace(' ', '-', strtolower($row['genre']))) ?>" style="color: #fd7b00"><?= $row['genre'] ?></a></li>
            <?php endwhile ?>
          </ul>
        </nav>
      </div>
      <br><br>

      <!-- Display Songs Per Genre -->
      <div class="row">
        <?php while($row2 = $statement2->fetch()): ?>
          <div class="col-lg-4" >
            <h2><a href="user_show.php?songId=<?= $row2['songId'] ?>&genreId=<?= $row2['genreId'] ?>&p=<?= (str_replace(' ', '-', strtolower($row2['title']))) ?>" style="color: #342b0f"><?= $row2['title'] ?></a></h2>
            <p><?= $row2['description'] ?></p><br>        
          </div>
        <?php endwhile ?>
      </div>

      <!-- Display All Songs -->
      <?php if ($_GET['genreId'] == 0): ?>
        <div class="row">
            <?php while($row4 = $statement4->fetch()): ?>
              <div class="col-lg-4" >
                <h2><a href="user_show.php?songId=<?= $row4['songId'] ?>&genreId=<?= $row4['genreId'] ?>&p=<?= (str_replace(' ', '-', strtolower($row4['title']))) ?>" style="color: #342b0f"><?= $row4['title'] ?></a></h2>
                <p><?= $row4['description'] ?></p><br>        
              </div>
            <?php endwhile ?>
          </div>
        </div>
      <?php endif ?>  

    </div>

    <!-- Footer -->
    <?php include("footer.php") ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>    
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
