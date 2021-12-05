<?php

    /* Jewel Faith Feliciano
       Project - Soundemic CMS Application (show.php)
       Shows the full content of the authenticated user's post.
       November 15, 2021
    */

    // Connect to the database
    require('connect.php');
    
    // Sanitize user input and filter out dangerous character.
    $songId = filter_input(INPUT_GET, 'songId', FILTER_SANITIZE_NUMBER_INT);

    // Build the parameterized SQL query.
    $query = "SELECT * FROM songs WHERE songId = :songId";
    $statement = $db->prepare($query);
    
    // Bind values to the parameters.
    $statement->bindValue(':songId', $songId, PDO::PARAM_INT);

    // Execute and fetch the return data.
    $statement->execute();
    $row = $statement->fetch();   

?>

 

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Soundemic | <?= $row['title']?></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>  
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
            <a class="navbar-brand" href="index.php">
            <span class="glyphicon glyphicon-equalizer" aria-hidden="true"></span><b> SOUNDEMIC</b></a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">

            </div>
        </div>
    </nav>

    <div class="jumbotron">
      <div class="container">
        <h1><?= $row['title'] ?></h1>
        <h4><span class="glyphicon glyphicon-play" aria-hidden="true"></span><i> <?= $row['artist'] ?></i></h4>
        <h2 class="show-full-post"><?= $row['description'] ?></h2>
        <p class="date"><small><?= date("F j, Y, g:i a", strtotime($row['currentDate'])) ?></small></p>
      </div>
    </div>

    <!-- Footer -->
    <?php include('footer.php'); ?>
    
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>    
     <script src="js/bootstrap.min.js"></script>
  </body>
</html>