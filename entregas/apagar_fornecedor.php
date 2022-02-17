<?php
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DBNAME', 'calendario_entregas');
define('PORT', 3306);

$conn = new PDO('mysql:host=' . HOST . ';port='.PORT.';dbname=' . DBNAME . ';', USER, PASS);

if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
}
else{
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    $res = mysqli_query($conn, "DELETE FROM events WHERE id=".$id);
    if ($res) :
      echo "Salvo com Sucesso";
    else:
      echo "Falhou";
    endif;

}
?>