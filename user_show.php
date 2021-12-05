<?php

    /* Jewel Faith Feliciano
       Project - Soundemic CMS Application (user_show.php)
       Shows the full content of the specified user's post.
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

    <div class="container">   
        <div class="row">
            <div class="panel panel-default widget">
                <div class="panel-heading" style="background: linear-gradient(to bottom, #ffcc00 0%, #ff9933 100%); color: #fff">                   
                    <h3 class="panel-title"><span class="glyphicon glyphicon-comment"></span> Comments</h3>                  
                </div>
                <div class="panel">
                  <div class="panel-body">
                    <div class="row">
                      <div class="col-md-11">
                        <input class="form-control" type="text" placeholder="Leave a Comment">
                      </div>
                      <div class="col-md-1">
                        <button class="btn btn-default pull-right" style="background-color: #ffcc00; color: #fff" type="submit">Share</button>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-xs-2 col-md-1">
                                    <img src="http://placehold.it/80" class="img-circle img-responsive" alt="" /></div>
                                <div class="col-xs-10 col-md-11">
                                    <div>
                                        <a href="http://www.jquery2dotnet.com/2013/10/google-style-login-page-desing-usign.html">
                                            Google Style Login Page Design Using Bootstrap</a>
                                        <div class="mic-info">
                                            By: <a href="#">Bhaumik Patel</a> on 2 Aug 2013
                                        </div>
                                    </div>
                                    <div class="comment-text">
                                        Awesome design
                                    </div>
                                    <div class="action">
                                        <button type="button" class="btn btn-primary btn-xs" title="Edit">
                                            <span class="glyphicon glyphicon-pencil"></span>
                                        </button>
                                        <button type="button" class="btn btn-success btn-xs" title="Approved">
                                            <span class="glyphicon glyphicon-ok"></span>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-xs" title="Delete">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </li>
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