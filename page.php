<?php 

    /* Jewel Faith Feliciano
       Project - Soundemic CMS Application (songs.php)
       The songs page for Users.
       November 15, 2021
    */

    // Connect to the database.
    require('connect.php');

    $results_per_page = 5;
    
    // Find out the number of results stored in database
    $query = "SELECT * FROM songs ORDER BY currentDate DESC";
    $statement = $db->prepare($query);
    $statement->execute(); 
    $number_of_results = $statement->rowCount();

    // while ($row = $statement->fetch()) {
    //     echo $row['id'] . ' ' . $row['title'] . '<br>';
    // }

    // Determine number of total pages available
    $number_of_pages = ceil($number_of_results / $results_per_page);

    // Determine which page number visitor is currently on
    if (!isset($_GET['page'])) {
        $page = 1;
    }
    else {
        $page = $_GET['page'];
    }

    // Determine the sql LIMIT starting number for the results on the displaying page
    $this_page_first_result = ($page - 1) * $results_per_page;

    // Retrieve selected results from database and display them on page
    $query = "SELECT * FROM songs LIMIT " . $this_page_first_result . ',' . $results_per_page;
    $statement = $db->prepare($query);
    $statement->execute(); 

    // while ($row = $statement->fetch()) {
    //     echo $row['id'] . ' ' . $row['title'] . '<br>';
    // }


    // Display the links to the pages

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SOUNDEMIC | Songs</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
  </head>

  <body>

            <!-- Songs Overview -->
            <div class="col-md-9">
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Songs</h3>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-10">
                      <input class="form-control" type="text" placeholder="Filter Songs...">
                  </div>
                  <div class="col-md-2">
                    <a class="btn btn-default" style="color: #fd7b00" data-toggle="modal" data-target="#addSong" role="button">Add Song</a>
                  </div>
                </div>
                <br>
                <table class="table tabie-striped table-hover">
                  <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th></th>
                  </tr>
                  <?php while($row = $statement->fetch()): ?>
                    <tr>
                      <td><?= $row['title'] ?></td>
                      <td><?= strlen($row['description']) >= 135 ? substr($row['description'], 0, 135) . "..." : $row['description'] ?></td>
                      <td><?= date("F j, Y, g:i a", strtotime($row['currentDate'])) ?></td>
                      <input type="hidden" name="id" value="<?= $row['id'] ?>" />
                      <td><a class="btn btn-default" href="edit_song.php?id=<?= $row['id']?>">Edit</a></td>
                    </tr>
                  <?php endwhile ?>
                </table>
              </div>
            </div>

    <nav aria-label="Page navigation" class="text-center">
        <ul class="pagination pagination-lg justify-content-center">
            <?php 
                for ($page_no = 1; $page_no <= $number_of_pages; $page_no++) {
                    if ($page == $page_no) {
                        $status = "active";
                    }
                    else {
                    $status = "";
                    }
                    echo '<li class="' . $status . '"><a href="songs.php?page=' . $page_no . '">' . $page_no . '</a></li>';
                }           
            ?>
        </ul>
    </nav>
  </body>
</html>