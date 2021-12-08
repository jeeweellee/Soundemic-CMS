<?php

    /* Jewel Faith Feliciano
       Project - Soundemic CMS Application (process_song.php)
       Where authenticated users and admin can create, update and delete songs.
       November 15, 2021
    */

    // Connect to the database.
    require('connect.php');

    if(session_status() !== PHP_SESSION_ACTIVE) { 
        session_start(); 
    } 
    
    if ($_POST) {
        if (isset($_POST['create'])) {
            create();
        }

        if (isset($_POST['update'])) {
            update();
        }

        if (isset($_POST['delete'])) {
            delete();
        }      
    }

    function create() {

    // Sanitize user input to escape HTML entities and filter out dangerous characters.
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description = filter_input(INPUT_POST, 'description');
    $artist = filter_input(INPUT_POST, 'artist', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $songId = filter_input(INPUT_GET, 'songId', FILTER_SANITIZE_NUMBER_INT);
    $genreId = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_NUMBER_INT);

        // CREATE blog post if title, description, artist, and genre are set.
        if ($_POST && strlen($_POST['title']) > 1 && strlen($_POST['description']) > 1 
        && strlen($_POST['artist']) > 1 && isset($_POST['genre'])) {      

            // Connect to the database.
            require('connect.php');

            // Builds the SQL query and binds it above the sanitized values.
            $query = "INSERT INTO songs (title, description, artist, genreId) VALUES (:title, :description, :artist, :genreId)";
            $statement = $db->prepare($query);

            // Bind values to the parameters.
            $statement->bindValue(":title", $title);
            $statement->bindValue(":description", $description);
            $statement->bindValue(":artist", $artist);
            $statement->bindValue(":genreId", $genreId);
            
            // Executes the CREATE.
            $statement->execute();

            // Redirect after CREATE.
            header("Location: songs.php");
            exit();
        }
    }

    function update() {

        // UPDATE blog if title, description and if are present in POST.
        if ($_POST && strlen($_POST['title']) && strlen($_POST['description']) && strlen($_POST['artist']) && isset($_POST['genre']) && strlen($_POST['songId'])) {
                
            // Sanitize user input to escape HTML entities and filter out dangerous characters.
            $title  = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $description = filter_input(INPUT_POST, 'description');
            $artist = filter_input(INPUT_POST, 'artist', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $genreId = filter_input(INPUT_POST, 'genre', FILTER_SANITIZE_NUMBER_INT);
            $songId = filter_input(INPUT_POST, 'songId', FILTER_SANITIZE_NUMBER_INT);

            // Connect to the database.
            require('connect.php');

            // Builds the SQL query and binds it above the sanitized values.
            $query = "UPDATE songs SET title = :title, description = :description, artist = :artist, genreId = :genreId WHERE songId = :songId";
            $statement = $db->prepare($query);

            // Bind values to the parameters.
            $statement->bindValue(':title', $title);       
            $statement->bindValue(':description', $description);
            $statement->bindValue(':artist', $artist);
            $statement->bindValue(':genreId', $genreId, PDO::PARAM_INT);
            $statement->bindValue(':songId', $songId, PDO::PARAM_INT);
               
            // Executes the UPDATE.
            $statement->execute();

            // Redirect after UPDATE.
            header("Location: songs.php");
            exit();
        } 
        // Retrieves post to be edited, if songId GET parameter is in URL.
        else if (isset($_GET['songId'])) { 
        
            // Sanitize the songId. Like above but this time from INPUT_GET.
            $songId = filter_input(INPUT_GET, 'songId', FILTER_SANITIZE_NUMBER_INT);
            
            // Build the parametrized SQL query using the filtered songId.
            $query     = "SELECT * FROM songs WHERE songId = :songId";
            $statement = $db->prepare($query);

            // Bind value to the parameter
            $statement->bindValue(':songId', $songId, PDO::PARAM_INT);
            
            // Execute the SELECT and fetch the single row returned.
            $statement->execute();
        } 
        // False if we are not UPDATING or SELECTING.
        else {
            $songId = false; 
        }
    }

    function delete() {

        // Sanitize the id. 
        $songId = filter_input(INPUT_POST, 'songId', FILTER_SANITIZE_NUMBER_INT);
        
        // DELETE post if delete button is pressed.
        if($_POST && isset($_POST['delete'])) {
            
            // Connect to the database.
            require('connect.php');

            // Builds the SQL query and binds it above the sanitized values.
            $query     = "DELETE FROM songs WHERE songId = :songId";
            $statement = $db->prepare($query);

            // Bind value to the parameter.
            $statement->bindValue(':songId', $songId, PDO::PARAM_INT);

            // Executes the DELETE.
            $statement->execute();

            // Redirect after DELETE.
            header("Location: songs.php");
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
                        <h2>An error occured while processing your song.</h2>
                        <div class="error-details">
                            Sorry, the title, description, and artist must be at least one character.
                        </div>
                        <div class="error-actions">
                            <a href="user_index.php" class="btn btn-default main-color-bg btn-lg"><span class="glyphicon glyphicon-home"></span> Take Me Home </a>
                            <!-- <a href="http://www.jquery2dotnet.com" class="btn btn-default btn-lg"><span class="glyphicon glyphicon-envelope"></span> Contact Support </a> -->
                            <button type="button" class="btn btn-default btn-lg" onclick="history.go(-1)">Return</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

