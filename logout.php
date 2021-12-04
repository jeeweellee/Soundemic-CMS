<?php

    /* Jewel Faith Feliciano
       Project - Soundemic CMS Application (logout.php)
       Handles the logout when clicked then deletes the sessions stored.
       November 15, 2021
    */

    session_start();
    session_destroy();
    header("Location:index.php");
    
?>