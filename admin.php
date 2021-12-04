<?php

    /* Jewel Faith Feliciano
       Project - Soundemic CMS Application (admin.php)
       Provides a form where the authenticated admin can enter a new post.
       November 15, 2021
    */

    $thisPage = 'admin';

    // Authenticate user login
    // require ('authenticate.php'); 

    // Connect to the database.
    require ('connect.php');
    
    // Build the parameterized SQL query.
    $query = "SELECT * FROM users ORDER BY joined DESC";
    $statement = $db->prepare($query);
    
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
    <title>SOUNDEMIC | Admin</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.16.2/tandard/ckeditor.js"></script>
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
          <li class="active">Home</li>
        </ol>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            
            <!-- List Group Status -->
            <div class="list-group">
                <a href="admin.php" class="list-group-item active main-color-bg"><span class="glyphicon glyphicon-home" aria-hidden="true"></span> Admin</a>
                <a href="songs.php" class="list-group-item"><span class="glyphicon glyphicon-music" aria-hidden="true"></span> Songs</a>
                <a href="genre.php" class="list-group-item"><span class="glyphicon glyphicon-cd" aria-hidden="true"></span> Genre</a>
                <a href="comments.php" class="list-group-item"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Comments</a>
                <a href="users.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users</a>
            </div>

          </div>

          <!-- Admin Overview -->
          <div class="col-md-9">
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Admin Overview</h3>
              </div>
              <div class="panel-body">
                <div class="col-md-4">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?= $row = $statement->rowCount() ?></h2>
                    <h4>Users</h4>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-music" aria-hidden="true"></span> 33</h2>
                    <h4>Songs</h4>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> 12</h2>
                    <h4>Comments</h4>
                  </div>
                </div>
              </div>
            </div>

            <!-- Latest Users -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Latest Users</h3>
              </div>
              <div class="panel-body">
                <table class="table table-striped table-hover">
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Joined</th>
                  </tr>
                  <?php while($row = $statement->fetch()): ?>
                    <tr>
                      <td><?= $row['username'] ?></td>
                      <td><?= $row['email'] ?></td>
                      <td><?= date("F j, Y", strtotime($row['joined'])) ?></td>
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
