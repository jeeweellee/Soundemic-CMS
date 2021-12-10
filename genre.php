<?php 

    /* Jewel Faith Feliciano
       Project - Soundemic CMS Application (genre.php)
       The genre page to display all the songs with categories.
       November 15, 2021
    */

    $thisPage = 'genre';

    // Connect to the database.
    require('connect.php');

    if(session_status() !== PHP_SESSION_ACTIVE) { 
      session_start(); 
    } 

    $query = "SELECT * FROM genre ORDER BY genreId";
    $statement = $db->prepare($query);
    $statement->execute();
  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SOUNDEMIC | Add Genre</title>
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
            <li><a href="user_index.php">Home</a></li>
            <li class="active">Add Genre</li>
          <?php else: ?>
            <li><a href="index.php">Home</a></li>
            <li class="active">Add Genre</li>
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

          <!-- Genre Overview -->
          <div class="col-md-9">
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Genre <span class="badge"><?= $row = $statement->rowCount() ?></span></h3>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-10">
                      <input class="form-control" type="text" placeholder="Filter Genre...">
                  </div>
                  <div class="col-md-2">
                    <a class="btn btn-default" style="color: #fd7b00" data-toggle="modal" data-target="#addGenre" role="button">Add Genre</a>
                  </div>
                </div>
                <br>
                <table class="table tabie-striped table-hover">
                  <tr>
                    <th>#</th>
                    <th>Genre</th>
                    <th></th>
                  </tr>
                  <?php while($row = $statement->fetch()): ?>
                    <tr>
                      <td><?= $row['genreId'] ?></td>
                      <td><?= $row['genre'] ?></td>
                      
                      <input type="hidden" name="genreId" value="<?= $row['genreId'] ?>" />
                      <td><a class="btn btn-default" href="edit_genre.php?genreId=<?= $row['genreId'] ?>">Edit</a></td>
                    </tr>
                  <?php endwhile ?>
                </table>
              </div>
            </div>

          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <?php include("footer.php") ?>

    <!-- Add Genre Modal -->
    <div class="modal fade" id="addGenre" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form action="process_genre.php" method="post">

                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Add Genre</h4>
                </div>

                <div class="modal-body">
                  <div class="form-group">
                    <label>Genre</label>
                    <input type="text" name="genreName" id="genreName" class="form-control" placeholder="Add A Genre">
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <input type="submit" name="add" class="btn btn-primary main-color-bg" value="Add">
                </div>
              
              </form>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>    
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
