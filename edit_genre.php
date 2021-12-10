<?php

    /* Jewel Faith Feliciano
       Project - Soundemic CMS Application (edit_genre.php)
       Where authenticated admin can edit genre.
       November 15, 2021
    */

    // Prompt for authentication and connect to the database.
    require('connect.php');

    // Build and prepare SQL String with :genreId placeholder parameter.
    $query     = "SELECT * FROM genre WHERE genreId = :genreId LIMIT 1";
    $statement = $db->prepare($query);
    
    // Sanitize $_GET['genreId'] to ensure it's a number.
    $genreId = filter_input(INPUT_GET, 'genreId', FILTER_SANITIZE_NUMBER_INT);

    // Bind the :genreId parameter in the query to the sanitized
    // $id specifying a binding-type of Integer.
    $statement->bindValue('genreId', $genreId, PDO::PARAM_INT);
    $statement->execute();
    
    // Fetch the row selected by primary key genreId.
    $row = $statement->fetch();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SOUNDEMIC | Edit Genre</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  </head>

  <body>

    <!-- Navigation Bar -->
    <?php include("nav.php") ?>

    <!-- Header -->
    <?php include("header.php") ?>

    <!-- Breadcrumb -->
    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <?php if ($loggedInUser == 'admin'): ?>
            <li><a href="admin.php">Home</a></li>
            <li class="active">Edit Genre</li>
          <?php else: ?>
            <li><a href="index.php">Home</a></li>
            <li class="active">Edit Genre</li>
          <?php endif ?>
        </ol>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">

            <!-- List Group Status -->
            <div class="list-group">
              <a href="user_index.php" class="list-group-item"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Home</a>
              <a href="songs.php" class="list-group-item"><span class="glyphicon glyphicon-music" aria-hidden="true"></span> Songs</a>
              <a href="genre.php" class="list-group-item active main-color-bg"><span class="glyphicon glyphicon-cd" aria-hidden="true"></span> Genre</a>
              <?php if ($loggedInUser == 'admin'): ?>
                <a href="users.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users</a>
                <a href="admin.php" class="list-group-item"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> Admin</a>
              <?php endif ?>             
            </div>

          </div>

          <!-- Edit Overview -->
          <div class="col-md-9">
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Edit Genre</h3>
              </div>
              <div class="panel-body">
                <form action="process_genre.php" method="post">

                  <div class="form-group">
                      <label>Genre</label>
                      <input type="text" name="genreName" id="genreName" class="form-control" value="<?= $row['genre']?>" />
                  </div>

                  <div class="modal-footer">
                    <?php if ($loggedInUser == 'admin'): ?>   
                      <input type="submit" name="modify" class="btn btn-primary main-color-bg" value="Modify">
                      <input type="submit" class="btn btn-default trigger-btn" data-dismiss="modal" name="remove" value="Remove" onclick="return confirm('Are you sure you wish to remove this genre?')" />
                    <?php else: ?>
                      <input type="submit" name="modify" class="btn btn-primary main-color-bg" value="Modify">
                      <input type="button" class="btn btn-default" value="Close" onclick="history.go(-1)">
                    <?php endif ?>  
                    
                      <input type="hidden" name="genreId" value="<?= $row['genreId'] ?>" />
                  </div>

                </form>
              </div>
            </div>
            
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
