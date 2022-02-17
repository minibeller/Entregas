<?php

session_start();

/* @author Cesar Szpak - Celke - cesar@celke.com.br
 * @pagina desenvolvida usando FullCalendar e Bootstrap 4,
 * o código é aberto e o uso é free,
 * porém lembre-se de conceder os créditos ao desenvolvedor.
 */
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DBNAME', 'calendario_entregas');
define('PORT', 3306);

$conn = new PDO('mysql:host=' . HOST . ';port='.PORT.';dbname=' . DBNAME . ';', USER, PASS);

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);



if (!empty($id)) {
    $sql = "DELETE FROM events WHERE id=".$id;
   
    $conn->exec($sql);
    $_SESSION['msg'] = '<div class="alert alert-success" role="alert">O evento foi apagado com sucesso!</div>';
    header("Location: index.php");
    }
    
 else {
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Erro: O evento não foi apagado com sucesso!</div>';
    header("Location: index.php");
}
