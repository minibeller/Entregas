<?php
include 'conexao.php';


  $title = $_POST['title'];
  $start = $_POST['start'];
  $color = $_POST['color'];


  
  $sql = "INSERT INTO events (title, start, color)
  VALUES (' $title', '$start ', '$color')";

  if ($conn->query($sql) === TRUE) {
    
  } 
  header('Location:index.php');
?>