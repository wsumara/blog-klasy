<?php

//Funkcja łącząca z bazą danych

function dbConnector($dbHost, $dbUserName, $dbUserPassword, $dbName)
{
  // tworzenie połączenia
  $connect = mysqli_connect($dbHost, $dbUserName, $dbUserPassword, $dbName);

  // sprawdzanie czy połączenie zostało nawiązane
  if (!$connect) 
  {
      die("blad");
  }

  return $connect;
}

//przypisywanie wartości atrybutom funkcji
$dbHost = "localhost";
$dbUserName = "root";
$dbUserPassword = "root";
$dbName = "Wernyhora";

$dbConnect = dbConnector($dbHost,$dbUserName,$dbUserPassword,$dbName);

//sprawdzenie czy jakiś post był wybrny
//jeśli nie to :
if(!isset($_GET['idPost']))
{
// Pobranie wszystkich postów w blogu
  $sql = "SELECT idPosts, postDate, postAuthor, postTitle, postIntro FROM Posts";
  $dbQuery = mysqli_query($dbConnect,$sql);

  //wyświetlenie strony blog.php
  include('blog.php');
}

//jeśli tak to:
if(isset($_GET['idPost'])){

  $postNumber = $_GET['idPost'];

// Pobranie jednego posta z bloga
  $sql = "SELECT idPosts, postDate, postAuthor, postTitle, postIntro, postReadMore FROM Posts WHERE idPosts=$postNumber";
  
  $dbQuery = mysqli_query($dbConnect,$sql);

  //wyświetlanie strony post.php
  include('post.php');
}





?>