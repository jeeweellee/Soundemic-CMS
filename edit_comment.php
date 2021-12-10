<?php

    /* Jewel Faith Feliciano
       Project - Soundemic CMS Application (edit_song.php)
       Where authenticated users and admin can edit songs.
       November 15, 2021
    */

    // Prompt for authentication and connect to the database.
    require('connect.php');  

    if(session_status() !== PHP_SESSION_ACTIVE) 
    { 
        session_start(); 
    } 

    // Build and prepare SQL String with :songId placeholder parameter.
    $query     = "SELECT * FROM comments WHERE commentId = :commentId LIMIT 1"; 
    $statement = $db->prepare($query);

    $query2     = "SELECT * FROM songs WHERE songId = :songId LIMIT 1"; 
    $statement2 = $db->prepare($query2);

    // Sanitize $_GET['commentId'] to ensure it's a number.
    $commentId = filter_input(INPUT_GET, 'commentId', FILTER_SANITIZE_NUMBER_INT);
    $songId = filter_input(INPUT_GET, 'songId', FILTER_SANITIZE_NUMBER_INT);

    // Bind the :commentId parameter in the query to the sanitized
    $statement->bindValue(':commentId', $commentId, PDO::PARAM_INT);
    $statement2->bindValue(':songId', $songId, PDO::PARAM_INT);

    $statement->execute();
    $statement2->execute();
    
    // Fetch the row selected by primary key songId and genreId.
    $row = $statement->fetch();
    $row2 = $statement2->fetch();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SOUNDEMIC | Edit Comment</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>

  <body>

    <!-- Navigation Bar -->
    <?php include("nav.php") ?>

    <form action="process_comment.php?songId=<?= $_GET['songId'] ?>&genreId=<?= $_GET['genreId'] ?>&commentId=<?= $_GET['commentId'] ?>" method="post"> 
      <div class="jumbotron" style="text-align: center">
        <div class="container">
          <h1><?= $row['comment']?></h1>
          <p class="lead"><?= date("M j, Y, g:i a", strtotime($row['datetime'])) ?></p>
          <div class="form-group">
          <input type="text" name="comment" id="comment" class="form-control" style="text-align: center" value="<?= $row['comment']?>" />
          </div>
          <input type="submit" name="save" class="btn btn-lg btn-default main-color-bg" value="Save">
          <button type="button" class="btn btn-default btn-lg" onclick="history.go(-1)">Back</button>

          <input type="hidden" name="commentId" value="<?= $row['commentId'] ?>" />
          <input type="hidden" name="songId" value="<?= $row['songId'] ?>" />
        </div>
      </div>
    </form>

    <!-- Footer -->
    <?php include("footer.php") ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>    
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
