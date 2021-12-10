<?php

    /* Jewel Faith Feliciano
       Project - Soundemic CMS Application (process_genre.php)
       Where authenticated users and admin can create, update and delete genre.
       November 15, 2021
    */

    // Connect to the database.
    require('connect.php');
        
    if(session_status() !== PHP_SESSION_ACTIVE) { 
        session_start(); 
    } 

    if ($_POST) {
        if (isset($_POST['add'])) {
            add();
        }

        if (isset($_POST['modify'])) {
            modify();
        }

        if (isset($_POST['remove'])) {
            remove();
        }      
    }

    function add() {

        $genreName = filter_input(INPUT_POST, 'genreName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $genreId = filter_input(INPUT_GET, 'genreId', FILTER_SANITIZE_NUMBER_INT);

        if ($_POST && strlen($_POST['genreName']) > 1) {

            require('connect.php');

            $query = "INSERT INTO genre (genreId, genre) VALUES (:genreId, :genreName)";
            $statement = $db->prepare($query);
        
            $statement->bindValue(":genreId", $genreId);
            $statement->bindValue(":genreName", $genreName);
        
            $statement->execute();
            header("Location: genre.php");
            exit();
        }  
    }

    function modify() {

        if ($_POST && !empty($_POST['genreName']) && !empty($_POST['genreId'])) {

            $genreName = filter_input(INPUT_POST, 'genreName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $genreId = filter_input(INPUT_POST, 'genreId', FILTER_SANITIZE_NUMBER_INT);

            require('connect.php');

            $query = "UPDATE genre SET genre = :genreName WHERE genreId = :genreId";
            $statement = $db->prepare($query);
      
            $statement->bindValue(':genreName', $genreName);
            $statement->bindValue(':genreId', $genreId, PDO::PARAM_INT);
            $statement->execute();
      
            header("Location: genre.php");
            exit();
        }
        else if (isset($_GET['genreId'])) {
    
            $genreId = filter_input(INPUT_GET, 'genreId', FILTER_SANITIZE_NUMBER_INT);

            $query = "SELECT * FROM genre WHERE genreId = :genreId";
            $statement = $db->prepare($query);

            $statement->bindValue(':genreId', $genreId, PDO::PARAM_INT);
            $statement->execute();    
            }
        else {
            $genreId = false;
        }
    }

    function remove() {

        $genreId = filter_input(INPUT_POST, 'genreId', FILTER_SANITIZE_NUMBER_INT);

        if ($_POST && isset($_POST['remove'])) {

            require('connect.php');

            $query = "DELETE FROM genre WHERE genreId = :genreId";
            $statement = $db->prepare($query);
            $statement->bindValue('genreId', $genreId, PDO::PARAM_INT);
            $statement->execute();
        
            header("Location: genre.php");
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
                        <h2>An error occured while processing your genre.</h2>
                        <div class="error-details">
                            Sorry, your genre must be at least one character.
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