<?php
session_start();
if(empty($_SESSION['email'])){
  header('location:login.php');
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "calendario_entregas";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$user = $_SESSION['email'];

$sql = "select id_user from user where email = '$user'";

if ($result = mysqli_query($conn, $sql)) {
  
  while ($row = $result->fetch_assoc()) {
 
   $nome_fornecedor = $_POST['nome_fornecedor'];
   $periodo = $_POST['periodo'];
   $volume = $_POST['volume'];
   $transportadora = $_POST['transportadora'];
   $tipo_carga = $_POST['tipo_carga'];
   $valor_descarga = $_POST['valor_descarga'];
   $ajudante = $_POST['ajudante'];
   $observacao = $_POST['observacao'];   
   $id_user = $row['id_user'];
   $id_events = $_GET["id"];
   $numero_pedidos = $_POST["numero_pedidos"];
   $numero_notas = $_POST['numero_notas'];
   $sql1 = "INSERT INTO calendario_entregas.eventos (nome_fornecedor,volume, periodo,
    transportadora,tipo_carga,valor_descarga,
   ajudante,observacao,user_id_user,events_id)
   VALUES ('$nome_fornecedor','$volume','$periodo','$transportadora',
   '$tipo_carga','$valor_descarga','$ajudante','$observacao','$id_user','$id_events');"; 
    if (mysqli_query($conn, $sql1)) {
      $sql2 = "select id_eventos, user_id_user,events_id from eventos where user_id_user = '$id_user' and events_id = '$id_events';";
      if ($result2 = mysqli_query($conn, $sql2)) {  
        while ($row2 = $result2->fetch_assoc()) {
          $id_eventos = $row2['id_eventos'];
          $user_id_user = $row2['user_id_user'];
          $events_id = $row2['events_id'];
          
          $sql3 = "INSERT INTO pedidos(numero_pedidos,eventos_id_eventos,eventos_user_id_user,
          eventos_events_id) VAlUES ('$numero_pedidos','$id_eventos','$user_id_user','$events_id');";
          if (mysqli_query($conn, $sql3)) {
            $sql4 = "INSERT INTO notas_fiscais (numero_notas,eventos_id_eventos,eventos_user_id_user,
            eventos_events_id) VAlUES ('$numero_notas','$id_eventos','$user_id_user','$events_id');";
            if (mysqli_query($conn, $sql4)) {
              header('Location: index.php');
            }
            else {
              echo "Error: " . $sql4. "<br>" . $conn->error;
            }  
          }else {
            echo "Error: " . $sql3. "<br>" . $conn->error;
          }  
        }
      }else {
        echo "Error: " . $sql2. "<br>" . $conn->error;
      }   
    }else {
      echo "Error: " . $sql1. "<br>" . $conn->error;
    }   
  }
  
}


if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} /*else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}*/

$conn->close();
?>
