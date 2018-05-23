<?php

function dbConnector($dbHost, $dbUserName, $dbUserPassword, $dbName)
{
  // Create connection
  $connect = mysqli_connect($dbHost, $dbUserName, $dbUserPassword, $dbName);

  // Check connection
  if (!$connect) 
  {
      die("blad");
  }

  return $connect;
}

$dbHost = "localhost";
$dbUserName = "root";
$dbUserPassword = "root";
$dbName = "Wernyhora";

$dbConnect = dbConnector($dbHost,$dbUserName,$dbUserPassword,$dbName);
$sql = "SELECT idPosts, postDate, postAuthor, postTitle, postIntro FROM Posts";
$dbQuery = mysqli_query($dbConnect,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>


<article>
  <header>
    <p>Dodaj post</p>
  </header>

<form method="GET">
  
  Tytuł: <br>
  <input type="text" name="postTitle" size=100> <br>
  
  Intro: <br>
  <input type="text" name="postIntro" size=100> <br>
  
  Tekst postu: <br>
  <input type="text" name="postReadMore" size=100> <br>
  
  Autor: <br>
  <input type="text" name="postAuthor" size=100> <br>
  
  Data: <br>
  <input type='date' name="postDate"> <br>
  
  <input type="submit" value="DODAJ NOWY POST">
  </form>
  <br><br>
</article>

<?php 

if(isset($_GET['postIntro'])){

  $postTitle = $_GET['postTitle'];
  $postIntro = $_GET['postIntro'];
  $postReadMore = $_GET['postReadMore'];
  $postAuthor = $_GET['postAuthor'];
  $postDate = $_GET['postDate'];

// Dodawanie posta
  $sqlDodawanie = "INSERT INTO Posts values (null,'$postDate','$postIntro','$postReadMore','$postAuthor','$postTitle')";
  $dbQuery2 = mysqli_query($dbConnect, $sqlDodawanie);
  header("Location: admin.php"); 
}
?>

<!--usuwanie posta-->
<?php while($row = mysqli_fetch_assoc($dbQuery)){ ?>

<article>
  <header>
    <span><?php echo $row['postDate'] ?></span>
    <h2><?php echo $row['postTitle'] ?></h2>
  </header>

    <p><?php echo $row['postIntro'] ?></p>

  <footer>
    <a href="admin.php?idPost=<?php echo $row['idPosts']; ?>">Usuń</a>
  </footer>
  <hr>
</article> 

<?php } 

if(isset($_GET['idPost'])){

  $postNumber = $_GET['idPost'];

// Usuwanie posta z bloga
  
  $sql = "DELETE FROM Posts WHERE idPosts=$postNumber";
  $dbQuery=mysqli_query($dbConnect, $sql);
  header("Location: admin.php"); 
}
?>
  
</body>
</html>