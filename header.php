<?php

$activePage = basename($_SERVER['PHP_SELF'], ".php");

    switch($activePage){
        case 'user_index':
            $component = 'glyphicon glyphicon-home';
            $title = 'Home';
            $caption = 'Manage Your Site';
            break;
        case 'songs':
            $component = 'glyphicon glyphicon-music';
            $title = 'Songs';
            $caption = 'Manage Your Songs';
            break;
        case 'edit_song':
            $component = 'glyphicon glyphicon-edit';
            $title = 'Edit Page';
            $caption = 'About Song';
            break;
        case 'genre':
            $component = 'glyphicon glyphicon-cd';
            $title = 'Genre';
            $caption = 'About Genre';
            break;
        case 'comments':
            $component = 'glyphicon glyphicon-comment';
            $title = 'Comments';
            $caption = 'Manage Your Comments';
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

            <!-- Dropdown Create Content  -->
            <!-- <div class="col-md-2">
                <div class="dropdown create">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Create Content
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <li><a type="button" data-toggle="modal" data-target="#addSong">Add Song</a></li>
                        <li><a type="button" data-toggle="modal" data-target="#addArtist">Add Artist</a></li>
                        <li><a type="button" data-toggle="modal" data-target="#addComment">Add Comments</a></li>
                    </ul>
                </div>
            </div> -->
        </div>
    </div>
</header> 