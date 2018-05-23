<?php

class blog{

private $dbConn, $sqlDodaj;

//konstruktor
function __construct($serverName, $userName, $password, $dbName){
//łączenie
$this -> dbConn = mysqli_connect($serverName, $userName, $password, $dbName);

//sprawdzanie połączenia
if(!$this -> dbConn){
die("connection failed: ". mysqli_connect_error());
}
echo "Connected successfully";
}

  function dodaj($postDate,$postIntro,$postReadMore,$postAuthor,$postTitle){
    $sqlDodaj = "INSERT INTO Posts values(null,'$postDate','$postIntro','$postReadMore','$postAuthor','$postTitle')";
    mysqli_query($this -> dbConn, $sqlDodaj);
    mysqli_close($this -> dbConn);
  }

  function usun($idPosts){
    $sql = "DELETE FROM Posts WHERE idPosts=$idPosts";
    mysqli_query($this -> dbConn, $sql);
    mysqli_query($this -> dbConn);
  }

  //function edytuj($postDate,$postIntro,$postReadMore,$postAuthor,$postTitle){}
}

$blogTomka = new blog('localhost','root','root','Wernyhora');

$action = $_GET['action'];
switch ($action) {
  case 'usun':
    $blogTomka -> usun(2);
    break;
}

//$blogTomka -> dodaj('2017-01-23','TO','JEDNAK',1,'DZIALA');
?>

<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <a href="index.php?action=dodaj&id=2">dodaj</a>
  <a href="index.php?action=usun&id=2">usuń</a>
</body>
</html>