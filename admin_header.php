<?php

    /* Jewel Faith Feliciano
       Project - Soundemic CMS Application (admin.php)
       Provides a form where the authenticated admin can enter a new post.
       November 15, 2021
    */

    $activePage = basename($_SERVER['PHP_SELF'], ".php");

    switch($activePage){
        case 'admin':
            $component = 'glyphicon glyphicon-wrench';
            $title = 'Admin';
            $caption = 'Manage Your Site';
            break;
        case 'songs':
            $component = 'glyphicon glyphicon-music';
            $title = 'Songs';
            $caption = 'Manage Your Songs';
            break;
        case 'genre':
            $component = 'glyphicon glyphicon-cd';
            $title = 'Genre';
            $caption = 'Manage Your Genre';
            break;
        case 'comments':
            $component = 'glyphicon glyphicon-comment';
            $title = 'Comments';
            $caption = 'Manage Your Comments';
            break;
        case 'users':
            $component = 'glyphicon glyphicon-user';
            $title = 'Users';
            $caption = 'Manage Your Users';
            break;
        case 'edit_users':
            $component = 'glyphicon glyphicon-edit';
            $title = 'Edit User';
            $caption = 'About User';
            break;
    }

?>

<!-- Header -->
<header id="header">
    <div class="container">
        <div class="row">
        <div class="col-md-10">
            <h1><span class="<?= $component ?>" aria-hidden="true"></span> <?= $title ?><small> <?= $caption ?></small></h1>
        </div>
        </div>
    </div>
</header> 