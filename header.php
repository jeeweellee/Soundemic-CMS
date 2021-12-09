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
        </div>
    </div>
</header> 