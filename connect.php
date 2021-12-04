<?php

    /* Jewel Faith Feliciano
       Project - Soundemic CMS Application (connect.php)
       Connects to the database.
       November 15, 2021
    */

    define('DB_DSN','mysql:host=localhost;dbname=soundemic;charset=utf8');
    define('DB_USER','jewel');
    define('DB_PASS','feliciano!');  
    
    try {
        // To create new PDO connection to MySQL.
        $db = new PDO(DB_DSN, DB_USER, DB_PASS);
        
    } catch (PDOException $e) {
        print "Error: " . $e->getMessage();
        die(); // Force execution to stop on errors.
    }

?>