<?php
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
try {
$conn = new PDO('mysql:host=' . HOST . ';port='.PORT.';dbname=' . DBNAME . ';', USER, PASS);

} catch(PDOException $e) {
    echo "Erro: Conexão com banco de dados não foi realizada com sucesso. Erro gerado " . $e->getMessage();
}