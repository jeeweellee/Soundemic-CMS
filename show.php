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
    $genreId = filter_input(INPUT_GET, 'genreId', FILTER_SANITIZE_NUMBER_INT);

    // Build the parameterized SQL query.
    $query = "SELECT * FROM songs WHERE songId = :songId";
    $statement = $db->prepare($query);

    $query2 = "SELECT * FROM genre WHERE genreId = :genreId";
    $statement2 = $db->prepare($query2);
    
    // Bind values to the parameters.
    $statement->bindValue(':songId', $songId, PDO::PARAM_INT);
    $statement2->bindValue(":genreId", $genreId, PDO::PARAM_INT);

    // Execute and fetch the return data.
    $statement->execute();
    $statement2->execute(); 	

    $row = $statement->fetch(); 
    $row2 = $statement2->fetch();  

    $query2 = "SELECT * FROM comments JOIN users ON comments.userId = users.userId WHERE comments.songId = :songId ORDER BY datetime DESC";
    $statement2 = $db->prepare($query2);
    $statement2->bindValue(':songId', $songId, PDO::PARAM_INT);
    $statement2->execute();

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
        <div id="navbar" class="collapse navbar-collapse"></div>
      </div>
    </nav>

    <!-- Show Song -->
    <div class="jumbotron">
      <div class="container">
        <h1><?= $row['title'] ?></h1>
        <h4><span class="glyphicon glyphicon-play" aria-hidden="true"></span><i> <?= $row['artist'] ?>&nbsp;&nbsp;<span class="glyphicon glyphicon-volume-up"></span> <i><?= $row2['genre'] ?></i></i></h4>
        <h2 class="show-full-post"><?= $row['description'] ?></h2>
        <p class="date"><small><?= date("F j, Y, g:i a", strtotime($row['currentDate'])) ?></small></p>
      </div>
    </div>

    <!-- Comments -->
    <div class="container">   
      <div class="row">
        <div class="panel panel-default widget">

          <div class="panel-heading" style="background: linear-gradient(to bottom, #ffcc00 0%, #ff9933 100%); color: #fff">                   
              <h3 class="panel-title"><span class="glyphicon glyphicon-comment"></span> Comments</h3>                  
          </div>

          <!-- Display Comments -->
          <div class="panel-body">
            <ul class="list-group">
              <?php while($row2 = $statement2->fetch()): ?>
                <li class="list-group-item">
                  <div class="row">
                    <div class="col-xs-2 col-md-1">
                      <img src="http://placehold.it/80" class="img-circle img-responsive" alt="" />
                    </div>
                    <div class="col-xs-10 col-md-11">
                      <table id="display">
                        <tr>
                          <td><b style="font-size: 20px"><?= $row2['comment'] ?></b></td>
                        </tr>
                        <tr>
                          <td style="color: gray"><i><?= $row2['username'] ?></i> - <?= date("M j, Y, g:i a", strtotime($row2['datetime'])) ?></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </li>
              <?php endwhile ?> 
            </ul>
          </div>  

        </div>
      </div>
    </div>

    <!-- Footer -->
    <?php include('footer.php'); ?>
    
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>    
     <script src="js/bootstrap.min.js"></script>
  </body>
</html>