<?php 

    /* Jewel Faith Feliciano
       Project - Soundemic CMS Application (authenticate.php)
       Prompts for a username and password in order to create/edit/update/delete a post.
       November 15, 2021
    */

    define('ADMIN_LOGIN','jewel'); 
    define('ADMIN_PASSWORD','Password01'); 
    
    if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW']) 
          || ($_SERVER['PHP_AUTH_USER'] != ADMIN_LOGIN) 
          || ($_SERVER['PHP_AUTH_PW'] != ADMIN_PASSWORD)) { 
      header('HTTP/1.1 401 Unauthorized'); 
      header('WWW-Authenticate: Basic realm="Our Blog"'); 
      exit("Access Denied: Username and password required."); 
    }
    
?>