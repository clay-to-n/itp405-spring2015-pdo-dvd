<?php

if (!isset($_GET['title']) || $_GET['title'] == "") {
  header('Location: search.php');
}

$title = $_GET['title'];

$host = 'itp460.usc.edu';
$dbname = 'dvd';
$user = 'student';
$password = 'ttrojan';

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

$sql = "
  SELECT title, format_name, genre_name, rating_name
  FROM dvds
  INNER JOIN genres
  ON dvds.genre_id = genres.id
  INNER JOIN formats
  ON dvds.format_id = formats.id
  INNER JOIN ratings
  ON dvds.rating_id = ratings.id
  WHERE title LIKE ?
";

$statement = $pdo->prepare($sql);
$like = '%' . $title . '%';
$statement->bindParam(1, $like);

$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_OBJ);

?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="results.css">
    <title>DVD Search</title>
  </head>
  <div class="container">
    <div class="page-header">
      <h3>
      <a role="button" class="btn btn-link btn-lg" aria-label="Left Align" href="search.php">
        <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span>
      </a>
      You searched for: <em><?php echo $title ?></em></h3>
    </div>

    <?php
      // If no results, we'll let the user know
      if (count($results) == 0) {
          echo('No results! Try <a href="search.php">searching for something else.</a>');
      }
    ?>
    <ul class="list-group">
      <?php foreach($results as $result) : ?>
      <li class="list-group-item col-sm-12"> 
        <div class="title col-sm-10">
          <strong><?php echo $result->title ?></strong>
        </div>
        <div class="title col-sm-2">
          <a href="ratings.php?rating=<?php echo $result->rating_name ?>">
            <?php echo $result->rating_name ?>
          </a>
        </div>
        <div class="col-sm-4">
          Genre: <?php echo $result->genre_name ?>
        </div>
        <div class="col-sm-8">
          Format: <?php echo $result->format_name ?>
        </div>
      </li>
      <?php endforeach ?>
    </ul>
  </div>
  
</html>