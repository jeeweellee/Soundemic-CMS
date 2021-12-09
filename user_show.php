<?php

    /* Jewel Faith Feliciano
       Project - Soundemic CMS Application (user_show.php)
       Shows the full content of the specified user's post and other user's comments.
       November 15, 2021
    */

   // Connect to the database
	require('connect.php');

  // Starts session if active
  if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }

  // Displays the songs and comment
  if (isset($_GET['songId'])) {

    $songId = filter_input(INPUT_GET, 'songId', FILTER_SANITIZE_NUMBER_INT);

    $query = "SELECT * FROM songs WHERE songId = :songId";
    $statement = $db->prepare($query);
    $statement->bindValue(':songId', $songId, PDO::PARAM_INT);
    $statement->execute();
    $row = $statement->fetch();  

    $query2 = "SELECT * FROM comments JOIN users ON comments.userId = users.userId WHERE comments.songId = :songId ORDER BY datetime DESC";
    $statement2 = $db->prepare($query2);
    $statement2->bindValue(':songId', $songId, PDO::PARAM_INT);
    $statement2->execute();

  }
  else {
    $songId = false;
  }
	
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Soundemic | <?= $row['title'] ?></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>  
  </head>
  <body>

    <!-- Navigation Bar -->
    <?php include("nav.php") ?>

    <div class="jumbotron">
      <div class="container">
        <h1><?= $row['title']?></h1>
        <h4><span class="glyphicon glyphicon-play" aria-hidden="true"></span><i> <?= $row['artist'] ?></i></h4>
        <h2 class="show-full-post"><?= $row['description']?></h2>
        <p class="date"><small><?= date("F j, Y, g:i a", strtotime($row['currentDate'])) ?> </small>
        <a href="edit.php?songId=<?= $_GET['songId']?>"></a></p>
      </div>
    </div>

    <!-- Comments -->
    <div class="container">   
      <div class="row">
        <div class="panel panel-default widget">
          <div class="panel-heading" style="background: linear-gradient(to bottom, #ffcc00 0%, #ff9933 100%); color: #fff">                   
              <h3 class="panel-title"><span class="glyphicon glyphicon-comment"></span> Comments</h3>                  
          </div>

          <!-- Leave a Comment -->
          <form action="process_comment.php?songId=<?= $_GET['songId'] ?>" method="post">
          <div class="panel">
            <div class="panel-body">
              <div class="row">
                <div class="col-md-11">
                  <input class="form-control" name="comment" id="comment" type="text" placeholder="Leave a Comment">
                </div>
                <div class="col-md-1">
                  <input class="btn btn-default pull-right" name="share" type="submit" style="color: #fd7b00" value="Comment">
                </div>             
              </div>
              <br>
              <div class="row">
                <div class="col-lg-5 col-lg-offset-5">
                <div class="input-group">
                  <img src="captcha.php" alt="CAPTCHA" class="captcha-image center-block">    
                  <input type="text" class="form-control" id="captcha" name="captcha" placeholder="Enter your code here">
                </div>         
                </div>
              </div>

           </div>
          </div>  
          </form>       

          
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
                      <div class="action">
                        <form action="process_comment.php?songId=<?= $_GET['songId'] ?>" method="post"> 
                          <input type="hidden" name="commentId" value="<?= $row2['commentId'] ?>" />
                          <?php if ($loggedInUser == $row2['username']): ?>
                            <a class="btn btn-warning btn-xs" href="edit_comment.php?songId=<?= $row2['songId'] ?>&commentId=<?= $row2['commentId'] ?>">Edit</a>
                          <?php endif ?>
                          <?php if ($loggedInUser == 'admin'): ?>
                            <input type="submit" name="delete" class="btn btn-danger btn-xs" value="Delete" onclick="return confirm('Are you sure you wish to delete this comment?')" />
                          <?php endif ?>   
                        </form>
                      </div>
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