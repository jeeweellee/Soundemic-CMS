<?php 

    /* Jewel Faith Feliciano
       Project - Soundemic CMS Application (songs.php)
       The songs page for Users.
       November 15, 2021
    */

    $thisPage = 'songs';

    // Sets number of rows to be displayed per page.
    $rows_per_page = 5;

    // Connect to the database.
    require('connect.php');

    if(session_status() !== PHP_SESSION_ACTIVE) { 
      session_start(); 
    } 

    $query = "SELECT * FROM songs";
    $statement = $db->prepare($query);
    $statement->execute(); 

    $query2 = "SELECT * FROM genre";
    $statement2 = $db->prepare($query2);
    $statement2->execute();

    // Determine which page number visitor is currently on
    if (!isset($_GET['page'])) {
      $page = 1;
    }
    else {
        $page = $_GET['page'];
    }

    // Counts the rows present in the database.
    $number_of_rows = $statement->rowCount();

    // Determines the number of total pages available.
    $number_of_pages = ceil($number_of_rows / $rows_per_page);

    // Determines the LIMIT starting number for display
    $first_page = ($page - 1) * $rows_per_page;

    // Retrieve selected results from database and display them on page
    $query = "SELECT * FROM songs ORDER BY currentDate DESC LIMIT " . $first_page . ',' . $rows_per_page;
    $statement = $db->prepare($query);
    $statement->execute();
  
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SOUNDEMIC | Songs</title>
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
            <li class="active">Songs</li>
          <?php else: ?>
            <li><a href="index.php">Home</a></li>
            <li class="active">Songs</li>
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

          <!-- Songs Overview -->
          <div class="col-md-9">
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Songs <span class="badge"><?= $number_of_rows ?></span></h3>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-10">
                      <input class="form-control" type="text" placeholder="Filter Songs...">
                  </div>
                  <div class="col-md-2">
                    <a class="btn btn-default" style="color: #fd7b00" data-toggle="modal" data-target="#addSong" role="button">Add Song</a>
                  </div>
                </div>
                <br>
                <table class="table tabie-striped table-hover">
                  <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th></th>
                  </tr>
                  <?php while($row = $statement->fetch()): ?>
                    <tr>
                      <td><?= $row['title'] ?></td>
                      <td><?= strlen($row['description']) >= 50 ? substr($row['description'], 0, 50) . "..." : $row['description'] ?></td>
                      <td><?= date("M j, Y, g:i a", strtotime($row['currentDate'])) ?></td>
                      
                      <input type="hidden" name="songId" value="<?= $row['songId'] ?>" />
                      <input type="hidden" name="genreId" value="<?= $row['genreId'] ?>" />
                      <td><a class="btn btn-default" href="edit_song.php?songId=<?= $row['songId'] ?>&genreId=<?= $row['genreId'] ?>">Edit</a></td>
                    </tr>
                  <?php endwhile ?>
                </table>
              </div>
            </div>

            <!-- Pagination -->
            <nav aria-label="Page navigation" class="text-center">
              <ul class="pagination">
                <?php if ($page > 1): ?>
                  <li>
                    <a href="songs.php?page=<?= ($page - 1) ?>" aria-label="Previous" style="color: #ff9933;">Previous</a>
                  </li>
                <?php endif ?>
                <?php for ($i = 1; $i <= $number_of_pages; $i++): ?>
                  <?php if ($page == $i) { $status = "active"; } else { $status = ""; } ?>
                    <li class="<?= $status ?>">
                      <a href="songs.php?page=<?= $i ?>" style="background-color: #ff9933; color: #fff;"><?= $i ?></a>
                    </li>
                <?php endfor ?>
                <?php if ($number_of_pages > $page): ?>
                  <li>
                    <a href="songs.php?page=<?= ($page + 1) ?>" aria-label="Next" style="color: #ff9933;">Next</a>
                  </li>
                <?php endif ?>
              </ul>
            </nav>

          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <?php include("footer.php") ?>

    <!-- Add Song Modal -->
    <div class="modal fade" id="addSong" tabindex="-1" role="dialog"  aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
              <form action="process_song.php" method="post">

                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Add Song</h4>
                </div>

                <div class="modal-body">
                  <div class="form-group">
                    <label>Title</label>
                    <input type="text" name="title" id="title" class="form-control" placeholder="Add A Title">
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea name="description" id="description" class="form-control" rows="4" style="resize: none;" placeholder="Add A Description"></textarea>
                </div>
                <div class="form-group">
                    <label>Artist</label>
                    <input type="text" name="artist" id="artist" class="form-control" placeholder="Add An Artist...">
                </div>
                <div class="form-group">
                    <label>Genre</label>
                    <select name="genre" id="genre" class="form-control">
                      <?php while($row = $statement2->fetch()): ?>
                        <option value="<?= $row['genreId'] ?>"><?= $row['genre'] ?></option>
                      <?php endwhile ?>
                    </select>
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <input type="submit" name="create" class="btn btn-primary main-color-bg" value="Create">
                </div>
              
              </form>
            </div>
        </div>
    </div>

    <script>CKEDITOR.replace( 'description' );</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>    
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
