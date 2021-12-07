<?php

    /* Jewel Faith Feliciano
       Project - Soundemic CMS Application (edit_song.php)
       Where authenticated users and admin can edit songs.
       November 15, 2021
    */

    // Prompt for authentication and connect to the database.
    require('connect.php');   

    // Build and prepare SQL String with :songId placeholder parameter.
    $query     = "SELECT * FROM songs WHERE songId = :songId LIMIT 1"; 
    $statement = $db->prepare($query);

    // Build and prepare SQL String with :genreId placeholder parameter.
    $query2 = "SELECT * FROM genre WHERE genreId = :genreId LIMIT 1";  
    $statement2 = $db->prepare($query2);

    // Sanitize $_GET['songId'] and $_GET['genreId']  to ensure it's a number.
    $songId = filter_input(INPUT_GET, 'songId', FILTER_SANITIZE_NUMBER_INT);
    $genreId = filter_input(INPUT_GET, 'genreId', FILTER_SANITIZE_NUMBER_INT);

    // Bind the :songId parameter in the query to the sanitized
    // $songId & genreId specifying a binding-type of Integer.
    $statement->bindValue('songId', $songId, PDO::PARAM_INT);
    $statement2->bindValue('genreId', $genreId, PDO::PARAM_INT);

    $statement->execute();
    $statement2->execute();
    
    // Fetch the row selected by primary key songId and genreId.
    $row = $statement->fetch();
    $row2 = $statement2->fetch();

    $query3 = "SELECT * FROM genre";
    $statement3 = $db->prepare($query3);
    $statement3->execute();
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SOUNDEMIC | Edit Page</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
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
            <li class="active">Edit Song</li>
          <?php else: ?>
            <li><a href="index.php">Home</a></li>
            <li class="active">Edit Song</li>
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
              <a href="songs.php" class="list-group-item active main-color-bg"><span class="glyphicon glyphicon-music" aria-hidden="true"></span> Songs</a>
              <a href="genre.php" class="list-group-item"><span class="glyphicon glyphicon-cd" aria-hidden="true"></span> Genre</a>
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
                <h3 class="panel-title">Edit Song</h3>
              </div>
              <div class="panel-body">
                <form action="process_song.php" method="post">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="<?= $row['title']?>" />
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea name="description" id="description" class="form-control" rows="4" style="resize: none;"><?= $row['description'] ?></textarea>
                    </div> 
                    <div class="form-group">
                        <label>Artist</label>
                        <input type="text" name="artist" id="artist" class="form-control" value="<?= $row['artist'] ?>"/>
                    </div>
                    <div class="form-group">
                      <label>Genre</label>
                        <select name="genre" id="genre" class="form-control">
                          <?php while($row3 = $statement3->fetch()): ?>
                            <?php if($row3['genreId'] == $row2['genreId']): ?>
                              <option value="<?= $row3['genreId'] ?>" selected>
                            <?php else: ?>
                              <option value="<?= $row3['genreId'] ?>">
                            <?php endif?>
                              <?= $row3['genre'] ?></option>
                          <?php endwhile ?>
                        </select>
                    </div>

                    <div class="modal-footer">
                      <?php if ($loggedInUser == 'admin'): ?>   
                        <input type="hidden" name="songId" value="<?= $row['songId'] ?>" />
                        <input type="hidden" name="genreId" value="<?= $row['genreId'] ?>" />
                        <input type="submit" name="update" class="btn btn-primary main-color-bg" value="Update">
                        <input type="submit" class="btn btn-default trigger-btn" data-dismiss="modal" name="delete" value="Delete" onclick="return confirm('Are you sure you wish to delete this song?')" />
                      <?php else: ?>
                        <input type="submit" name="update" class="btn btn-primary main-color-bg" value="Update">
                        <input type="button" class="btn btn-default" value="Close" onclick="history.go(-1)">
                      <?php endif ?>  
                      
                        <input type="hidden" name="songId" value="<?= $row['songId'] ?>" />
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

    <script>CKEDITOR.replace( 'description' );</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>    
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
