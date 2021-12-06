<?php

    /* Jewel Faith Feliciano
       Project - Soundemic CMS Application (nav.php)
       Shows the navigation bar of each page.
       November 15, 2021
    */

    $loggedInUser = "";

    if (session_status() !== PHP_SESSION_ACTIVE) {
      session_start();
    }

    if (isset($_SESSION['loggedIn_user'])) {
      $loggedInUser = $_SESSION['loggedIn_user'];
    }

?>

<!-- Navigation Bar -->
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">
            <span class="glyphicon glyphicon-equalizer" aria-hidden="true"></span><b> SOUNDEMIC</b>
          </a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">

          <!-- Menu Tabs -->
          <ul class="nav navbar-nav">
            <li class="<?= ($thisPage == 'user_index') ? 'active' : '' ?>"><a href="user_index.php">Home</a></li>
            <li class="<?= ($thisPage == 'songs') ? 'active' : '' ?>"><a href="songs.php">Songs</a></li>
            <li class="<?= ($thisPage == 'genre') ? 'active' : '' ?>"><a href="genre.php">Genre</a></li>
            <?php if ($loggedInUser == 'admin'): ?>
              <li class="<?= ($thisPage == 'users') ? 'active' : '' ?>"><a href="users.php">Users</a></li>
              <li class="<?= ($thisPage == 'admin') ? 'active' : '' ?>"><a href="admin.php">Admin</a></li>
            <?php endif ?>
          </ul>

          <!-- Welcome Logout -->
          <?php if ($loggedInUser): ?>
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="#">Welcome, <?= $loggedInUser ?></a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
          <?php endif ?>

        </div>
    </div>
</nav>