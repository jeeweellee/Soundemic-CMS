<?php

    /* Jewel Faith Feliciano
       Project - Soundemic CMS Application (process_song.php)
       Where authenticated users and admin can create, update and delete songs.
       November 15, 2021
    */

    require('connect.php');
        
    if(session_status() !== PHP_SESSION_ACTIVE) { 
        session_start(); 
    } 

    if ($_POST) {
        if (isset($_POST['share'])) {
            share();
        }

        if (isset($_POST['save'])) {
            save();
        }

        if (isset($_POST['delete'])) {
            delete();
        }      
    }

    function share() {

        $userId = $_SESSION['userId'];
        $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $songId = filter_input(INPUT_GET, 'songId', FILTER_SANITIZE_NUMBER_INT);

        if ($_POST && isset($_SESSION['userId']) && isset($_GET['songId']) && !empty($_POST['comment'])) {

            require('connect.php');

            $query = "INSERT INTO comments (userId, comment, songId) VALUES (:userId, :comment, :songId)";
            $statement = $db->prepare($query);
        
            $statement->bindValue(":userId", $userId);
            $statement->bindValue(":comment", $comment);
            $statement->bindValue(":songId", $songId);
        
            $statement->execute();
            header("Location: user_show.php?songId=" . $_GET['songId']);
            exit();
        }
    }

    function save() {

        if ($_POST && !empty($_POST['comment']) && !empty($_POST['commentId'])) {

            $comment = filter_input(INPUT_POST, 'comment', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $commentId = filter_input(INPUT_POST, 'commentId', FILTER_SANITIZE_NUMBER_INT);

            require('connect.php');

            $query = "UPDATE comments SET comment = :comment WHERE commentId = :commentId";
            $statement = $db->prepare($query);
      
            $statement->bindValue(':comment', $comment);
            $statement->bindValue(':commentId', $commentId, PDO::PARAM_INT);
            $statement->execute();
      
            header("Location: user_show.php?songId=" . $_GET['songId']);
            exit();
        }
        else if (isset($_GET['commentId'])) {
    
            $commentId = filter_input(INPUT_GET, 'commentId', FILTER_SANITIZE_NUMBER_INT);

            $query = "SELECT * FROM comments WHERE commentId = :commentId";
            $statement = $db->prepare($query);

            $statement->bindValue(':commentId', $commentId, PDO::PARAM_INT);
            $statement->execute();    
            }
        else {
            $commentId = false;
        }
    }

    function delete() {

        $commentId = filter_input(INPUT_POST, 'commentId', FILTER_SANITIZE_NUMBER_INT);

        if ($_POST && isset($_POST['delete'])) {

            require('connect.php');

            $query = "DELETE FROM comments WHERE commentId = :commentId";
            $statement = $db->prepare($query);
            $statement->bindValue('commentId', $commentId, PDO::PARAM_INT);
            $statement->execute();
        
            header("Location: user_show.php?songId=" . $_GET['songId']);
            exit();
          }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Soundemic | Error Page </title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="error-template">
                        <h1>Oops!</h1>
                        <h2>An error occured while processing your comment.</h2>
                        <div class="error-details">
                            Sorry, your comment must be at least one character.
                        </div>
                        <div class="error-actions">
                            <a href="user_index.php" class="btn btn-default main-color-bg btn-lg"><span class="glyphicon glyphicon-home"></span> Take Me Home </a>
                            <button type="button" class="btn btn-default btn-lg" onclick="history.go(-1)">Return</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>