<?php

    /* Jewel Faith Feliciano
       Project - Soundemic CMS Application (edit_users.php)
       Where authenticated admin can edit its users.
       November 15, 2021
    */

    // Prompt for authentication and connect to the database.
    require('connect.php');

    // Build and prepare SQL String with :userId placeholder parameter.
    $query     = "SELECT * FROM users WHERE userId = :userId LIMIT 1";
    $statement = $db->prepare($query);
    
    // Sanitize $_GET['userId'] to ensure it's a number.
    $userId = filter_input(INPUT_GET, 'userId', FILTER_SANITIZE_NUMBER_INT);

    // Bind the :userId parameter in the query to the sanitized
    // $id specifying a binding-type of Integer.
    $statement->bindValue('userId', $userId, PDO::PARAM_INT);
    $statement->execute();
    
    // Fetch the row selected by primary key userId.
    $row = $statement->fetch();

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SOUNDEMIC | Edit Users</title>
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
          <li class="active">Edit Users</li>
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
                <a href="users.php" class="list-group-item"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Users</a>
                <a href="admin.php" class="list-group-item"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> Admin</a>
            </div>

          </div>

          <!-- Edit Overview -->
          <div class="col-md-9">
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Edit User</h3>
              </div>
              <div class="panel-body">
                <form action="process_users.php" method="post">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" id="username" class="form-control" value="<?= $row['username']?>" readonly />
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="<?= $row['email'] ?>" readonly />
                    </div> 
                    <div class="form-group">
                        <label>User Type</label>
                        <input type="text" name="userType" id="userType" class="form-control" value="<?= $row['userType'] ?>"/>
                    </div>

                    <div class="modal-footer">
                        <input type="hidden" name="userId" value="<?= $row['userId'] ?>" />
                        <input type="submit" name="update" class="btn btn-primary main-color-bg" value="Update">
                        <input type="submit" class="btn btn-default trigger-btn" data-dismiss="modal" name="delete" value="Delete" onclick="return confirm('Are you sure you wish to delete this user?')" />
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
