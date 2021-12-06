<?php

    /* Jewel Faith Feliciano
       Project - Soundemic CMS Application (users.php)
       Provides a form where the authenticated users can enter a new post.
       November 15, 2021
    */

    $thisPage = 'users';

    // Authenticate user login
    // require ('authenticate.php'); 

    // Connect to the database.
    require ('connect.php');
    
    // Build the parameterized SQL query.
    $query = "SELECT * FROM users ORDER BY joined DESC";
    $statement = $db->prepare($query);
    
    // Execute and fetch the return data.
    $statement->execute();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SOUNDEMIC | Users</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
  </head>

  <body>

    <!-- Navigation Bar -->
    <?php include("nav.php") ?>

    <!-- Header -->
    <?php include("admin_header.php") ?>

    <!-- Breadcrumb -->
    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li><a href="user_index.php">Home</a></li>
          <li class="active">Users</li>
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
                <a href="genre.php" class="list-group-item"><span class="glyphicon glyphicon-cd" aria-hidden="true"></span> Genre</a>
                <a href="users.php" class="list-group-item active main-color-bg"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users</a>
                <a href="admin.php" class="list-group-item"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> Admin</a>
            </div>

          </div>

          <!-- Users Overview -->
          <div class="col-md-9">
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Users <span class="badge"><?= $row = $statement->rowCount() ?></span></h3>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-12">
                      <input class="form-control" type="text" placeholder="Filter Users...">
                  </div>
                </div>
                <br>
                <table class="table tabie-striped table-hover">
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Joined</th>
                    <th></th>
                  </tr>
                  <?php while($row = $statement->fetch()): ?>
                    <tr>
                      <td><?= $row['username'] ?></td>
                      <td><?= $row['email'] ?></td>
                      <td><?= date("F j, Y", strtotime($row['joined'])) ?></td>
                      <input type="hidden" name="userId" value="<?= $row['userId'] ?>" />
                      <td><a class="btn btn-default" href="edit_users.php?userId=<?= $row['userId'] ?>">Edit</a></td>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>    
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
