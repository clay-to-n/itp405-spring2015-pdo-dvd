<?php

if (!isset($_GET['title'])) {
  header('Location: search.php');
}

$title = $_GET['title'];

$host = 'itp460.usc.edu';
$dbname = 'dvd';
$user = 'student';
$password = 'ttrojan';

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

$sql = "
  SELECT title, genre_name
  FROM dvds
  INNER JOIN genres
  ON dvds.genre_id = genres.id
  WHERE title LIKE ?
";

$statement = $pdo->prepare($sql);
$like = '%' . $title . '%';
$statement->bindParam(1, $like);

$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_OBJ);
?>

You searched for: <?php echo $title ?>
<br/><br/>

<?php foreach($results as $result) : ?>
  <div> 
    <?php echo $result->title ?>
    (<a href="genres.php?genre=<?php echo $result->genre_name ?>">
      <?php echo $result->genre_name ?>
    </a>)
  </div>
<?php endforeach ?>