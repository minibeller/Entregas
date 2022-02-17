<?php
/**
 * @author Cesar Szpak - Celke - cesar@celke.com.br
 * @pagina desenvolvida usando FullCalendar e Bootstrap 4,
 * o código é aberto e o uso é free,
 * porém lembre-se de conceder os créditos ao desenvolvedor.
 */
include 'conexao.php';

$data_atual = date("Y/m/d");




$query_events = "SELECT e.tipo_carga, e.valor_descarga,
 ev.id,e.id_eventos,e.events_id,e.nome_fornecedor,e.periodo,
e.volume,e.transportadora,ev.color,ev.start,ev.id,e.ajudante,n.numero_notas FROM eventos as e 
INNER JOIN events as ev
INNER JOIN notas_fiscais as n
WHERE ev.id = e.events_id && n.eventos_events_id = e.events_id AND DATE_ADD(start , INTERVAL 30 DAY);";





/*select * FROM events
WHERE start
    BETWEEN DATE_ADD(CURRENT_DATE(), INTERVAL -30 DAY) AND CURRENT_DATE()*/

$resultado_events = $conn->prepare($query_events);
$resultado_events->execute();

$eventos = [];

while($row_eventos = $resultado_events->fetch(PDO::FETCH_ASSOC)){
    $id = $row_eventos['id'];
    $id_eventos = $row_eventos['id_eventos'];
   
    $hora_data = $row_eventos['start'];
    $fornecedor = $row_eventos['nome_fornecedor'];
    $periodo = $row_eventos['periodo'];
    $volume = $row_eventos['volume'];
    $transportadora = $row_eventos['transportadora'];
    $tipo_carga = $row_eventos['tipo_carga'];
    $valor_descarga = $row_eventos['valor_descarga'];
    $ajudante = $row_eventos['ajudante'];
    $notas = $row_eventos['numero_notas'];
    $color = $row_eventos['color'];
    
  if(strlen($notas) > 10){
        $notas = substr($notas, 0, 10);
    }

    
    $eventos[] = [
        'id' => $id_eventos, 
        'hora_data' => $hora_data,
        'fornecedor' => $fornecedor, 
        'periodo' => $periodo, 
        'volume' => $volume, 
        'color' => $color,
        'transportadora' => $transportadora,
        'tipo_carga' => $tipo_carga,
        'valor_descarga' => $valor_descarga,
        'ajudante' => $ajudante,
        'numero_notas' => $notas,
      
      
        ];
}

session_start();
if(empty($_SESSION['email'])){
    header('location:login.php');
}

 ?>

<body id="container" class="mt-5" >
<?php
    include 'menu.php';
if (isset($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}


?>
<div class="container">
    <div class="row" style=" text-align: center;">
    
    <div class="col-12">
        <div class="margin mb-5">
            <form action="pesquisar.php" method="POST" style class="form-inline my-2 my-lg-0 float-right">
                <input name="fornecedor" class="form-control mr-sm-2" type="search" placeholder="Pesquisar Fornecedor" >
                <input name="data" class="form-control mr-sm-2" type="date" placeholder="Pesquisar Data" >
                <input name="notas" class="form-control mr-sm-2" type="type" placeholder="Pesquisar Notas" >
                <button class="btn btn-success my-2 my-sm-0" type="submit">Pesquisar</button>
            </form>
        </div>
        <table class="table table-dark table-striped table-hover mt-5" style=" margin:auto;">
            <thead class="thead sticky-top">
                <tr>
                    <th scope="col-2">Data</th>
                    <th scope="col-2">Período</th>
                    <th scope="col-2">Fornecedor</th>
                    <th scope="col-2">Transportadora</th>
                    <th scope="col-2">Tipo de Carga</th>
                    <th scope="col-2">Volume</th>
                    <th scope="col-2">Valor Descarga</th>
                    <th scope="col-2">Ajudante</th>
                    <th scope="col-2">Número Notas</th>
                    <th scope="col-2">Visualizar</th>
                   
                </tr>
            </thead>
            <tbody >
            <?php 
  
            
            foreach ($eventos as $row_events){ 
                $color = $row_events['color'];
              
                if($color == '#e83e8c'){
                    
                  $color= 'class="table-danger text-dark"';      
                }
                else{
                    $color= 'class="table-primary text-dark"'; 
                }

                ?>
                <tr>

                    <td <?php echo $color ?> ><?php echo date("d-m-y H:i:s", strtotime($row_events['hora_data'])); ?></td>
                    <td <?php echo $color ?>><?php echo $row_events['periodo']; ?></td>
                    <td <?php echo $color ?>><?php echo $row_events['fornecedor']; ?></td>
                    <td <?php echo $color ?>><?php echo $row_events['transportadora']; ?></td>
                    <td <?php echo $color ?>><?php echo $row_events['tipo_carga']; ?></td>
                    <td <?php echo $color ?>><?php echo $row_events['volume']; ?></td>
                    <td <?php echo $color ?>><?php echo $row_events['valor_descarga']; ?></td>
                    <td <?php echo $color ?>><?php echo $row_events['ajudante']; ?></td>
                    <td <?php echo $color ?>><?php echo $row_events['numero_notas']; ?></td>
                    <?php
                 
                
                    ?>

                    <td <?php echo $color ?>><a type="button" class="btn btn-primary" href="visualizar_evento.php?id=<?php echo $row_events['id']; ?>">Visualizar</a>
    
                        
                    
                    
                </tr>
                <?php } ?>              
                <tr>
                    

                   
                </tr>
                
            </tbody>
        </table>
    </div>
   

</div>
</div>
</body>