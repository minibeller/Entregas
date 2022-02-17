<?php
include 'conexao.php';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "calendario_entregas";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$fornecedor = $_POST['fornecedor'];
$data = $_POST['data'];
$notas = $_POST['notas'];


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



if (!empty($fornecedor)) {
    $sql = "SELECT * FROM eventos WHERE nome_fornecedor LIKE '%$fornecedor%'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $id_events = $row["events_id"];
           
            $query_events = "SELECT e.tipo_carga, e.valor_descarga,
                ev.id,e.id_eventos,ev.color,e.events_id,e.nome_fornecedor,e.periodo,
                e.volume,e.transportadora,ev.start,ev.id,e.ajudante,n.numero_notas FROM eventos as e 
                INNER JOIN events as ev
                INNER JOIN notas_fiscais as n
                WHERE ev.id = $id_events && e.events_id = $id_events
                && n.eventos_events_id = $id_events
                AND DATE_ADD(start , INTERVAL 30 DAY);";
               
                
                $result2 = $conn->query($query_events);

                if ($result2->num_rows > 0) {
                    while($row = $result2->fetch_assoc()) {
                        $id = $row['id'];
                        $notas = $row['numero_notas'];
                        $id_eventos = $row['id_eventos'];
                        $hora_data = $row['start'];
                        $color = $row['color'];
                        $fornecedor = $row['nome_fornecedor'];
                        $periodo = $row['periodo'];
                        $volume = $row['volume'];
                        $transportadora = $row['transportadora'];
                        $tipo_carga = $row['tipo_carga'];
                        $valor_descarga = $row['valor_descarga'];
                        $ajudante = $row['ajudante'];


        
                        $eventos[] = [
                            'id' => $id,   
                            'numero_notas' => $notas, 
                            'hora_data' => $hora_data,
                            'fornecedor' => $fornecedor, 
                            'periodo' => $periodo, 
                            'color' => $color,
                            'volume' => $volume, 
                            'transportadora' => $transportadora,
                            'tipo_carga' => $tipo_carga,
                            'valor_descarga' => $valor_descarga,
                            'ajudante' => $ajudante
                            
        
                        ];
                      
                    }
                }
             

           
        }
        echo "<div class='row' style=' text-align: center;'>
        <div class='col-1' >
        
        </div>
        <div class='col-10'>
            <div class='margin mb-5'>
                <form action='pesquisar.php' method='POST' style class='form-inline my-2 my-lg-0 float-right'>
                    <input name='fornecedor' class='form-control mr-sm-2' type='search' placeholder='Pesquisar Fornecedor' >
                    <input name='data' class='form-control mr-sm-2' type='date' placeholder='Pesquisar Data' >
                    <input name='notas' class='form-control mr-sm-2' type='type' placeholder='Pesquisar Notas' >
                    <button class='btn btn-success my-2 my-sm-0' type='submit'>Pesquisar</button>
                </form>
            </div>
            <table class='table table-dark table-striped table-hover' style=' margin:auto;'>
                <thead class='thead'>
                    <tr>
                        <th scope='col-2'>Data</th>
                        <th scope='col-2'>Período</th>
                        <th scope='col-2'>Fornecedor</th>
                        <th scope='col-2'>Transportadora</th>
                        <th scope='col-2'>Tipo de Carga</th>
                        <th scope='col-2'>Volume</th>
                        <th scope='col-2'>Valor Descarga</th>
                        <th scope='col-2'>Ajudante</th>
                        <th scope='col-2'>Número Notas</th>
                        <th scope='col-2'>Visualizar</th>
                       
                    </tr>
                </thead>
                <tbody >";
                
                foreach ($eventos as $row_events){ 
                    $color = $row_events['color'];
                  
                    if($color == '#e83e8c'){
                        
                      $color= 'class="table-danger text-dark"';      
                    }
                    else{
                        $color= 'class="table-primary text-dark"'; 
                    }
    
                }
                foreach ($eventos as $row_events){ ?>
                    <tr>
                
                        <td <?php echo $color; ?>><?php echo date("d-m-y H:i:s", strtotime($row_events['hora_data'])); ?></td>
                        <td <?php echo $color; ?> ><?php echo $row_events['periodo']; ?></td>
                        <td <?php echo $color; ?>><?php echo $row_events['fornecedor']; ?></td>
                        <td <?php echo $color; ?>><?php echo $row_events['transportadora']; ?></td>
                        <td <?php echo $color; ?>><?php echo $row_events['tipo_carga']; ?></td>
                        <td <?php echo $color; ?>><?php echo $row_events['volume']; ?></td>
                        <td <?php echo $color; ?>><?php echo $row_events['valor_descarga']; ?></td>
                        <td <?php echo $color; ?>><?php echo $row_events['ajudante']; ?></td>
                        <td <?php echo $color; ?>><?php echo $row_events['numero_notas']; ?></td>
                        
                        <td <?php echo $color; ?>><a type="button" class="btn btn-primary" href="visualizar_evento.php?id=<?php echo $id_eventos ?>">Visualizar</a>
        
                            
                        
                            
                        </tr>
                        <?php } ?>              
                    <tr>
                        

                                
                            </tr>
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="col-1">

                    </div>
                            

                </div>
                </body> <?php     
            
    }
    
}
else if(!empty($data)) {
    $sql2 = "SELECT * FROM events WHERE start LIKE '%$data%'";
  
    $result = mysqli_query($conn, $sql2);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
                $id_events = $row["id"];

                $query_events = "SELECT e.tipo_carga, e.valor_descarga,
                ev.id,e.id_eventos,ev.color,e.events_id,e.nome_fornecedor,e.periodo,
                e.volume,e.transportadora,ev.start,ev.id,e.ajudante,n.numero_notas FROM eventos as e 
                INNER JOIN events as ev
                INNER JOIN notas_fiscais as n
                WHERE ev.id = $id_events && e.events_id = $id_events
                && n.eventos_events_id = $id_events
                AND DATE_ADD(start , INTERVAL 30 DAY);";
               
                
                $result2 = $conn->query($query_events);

                if ($result2->num_rows > 0) {
                    while($row = $result2->fetch_assoc()) {
                        $id = $row['id'];
                        $notas = $row['numero_notas'];
                        $id_eventos = $row['id_eventos'];
                        $hora_data = $row['start'];
                        $color = $row['color'];
                        $fornecedor = $row['nome_fornecedor'];
                        $periodo = $row['periodo'];
                        $volume = $row['volume'];
                        $transportadora = $row['transportadora'];
                        $tipo_carga = $row['tipo_carga'];
                        $valor_descarga = $row['valor_descarga'];
                        $ajudante = $row['ajudante'];


        
                        $eventos[] = [
                            'id' => $id,   
                            'numero_notas' => $notas, 
                            'hora_data' => $hora_data,
                            'fornecedor' => $fornecedor, 
                            'periodo' => $periodo, 
                            'color' => $color,
                            'volume' => $volume, 
                            'transportadora' => $transportadora,
                            'tipo_carga' => $tipo_carga,
                            'valor_descarga' => $valor_descarga,
                            'ajudante' => $ajudante
                            
        
                        ];
                      
                    }
                }
             

           
        }
        echo "<div class='row' style=' text-align: center;'>
        <div class='col-1' >
        
        </div>
        <div class='col-10'>
            <div class='margin mb-5'>
                <form action='pesquisar.php' method='POST' style class='form-inline my-2 my-lg-0 float-right'>
                    <input name='fornecedor' class='form-control mr-sm-2' type='search' placeholder='Pesquisar Fornecedor' >
                    <input name='data' class='form-control mr-sm-2' type='date' placeholder='Pesquisar Data' >
                    <input name='notas' class='form-control mr-sm-2' type='type' placeholder='Pesquisar Notas' >
                    <button class='btn btn-success my-2 my-sm-0' type='submit'>Pesquisar</button>
                </form>
            </div>
            <table class='table table-dark table-striped table-hover' style=' margin:auto;'>
                <thead class='thead'>
                    <tr>
                        <th scope='col-2'>Data</th>
                        <th scope='col-2'>Período</th>
                        <th scope='col-2'>Fornecedor</th>
                        <th scope='col-2'>Transportadora</th>
                        <th scope='col-2'>Tipo de Carga</th>
                        <th scope='col-2'>Volume</th>
                        <th scope='col-2'>Valor Descarga</th>
                        <th scope='col-2'>Ajudante</th>
                        <th scope='col-2'>Número Notas</th>
                        <th scope='col-2'>Visualizar</th>
                       
                    </tr>
                </thead>
                <tbody >";
                 
  
            
                foreach ($eventos as $row_events){ 
                    $color = $row_events['color'];
                  
                    if($color == '#e83e8c'){
                        
                      $color= 'class="table-danger text-dark"';      
                    }
                    else{
                        $color= 'class="table-primary text-dark"'; 
                    }
                }
                foreach ($eventos as $row_events){ ?>
                 
                    <tr>
                    <td <?php echo $color; ?>><?php echo date("d-m-y H:i:s", strtotime($row_events['hora_data'])); ?></td>
                        <td <?php echo $color; ?>><?php echo $row_events['periodo']; ?></td>
                        <td <?php echo $color; ?>><?php echo $row_events['fornecedor']; ?></td>
                        <td <?php echo $color; ?>><?php echo $row_events['transportadora']; ?></td>
                        <td <?php echo $color; ?>><?php echo $row_events['tipo_carga']; ?></td>
                        <td <?php echo $color; ?>><?php echo $row_events['volume']; ?></td>
                        <td <?php echo $color; ?>><?php echo $row_events['valor_descarga']; ?></td>
                        <td <?php echo $color; ?>><?php echo $row_events['ajudante']; ?></td>
                        <td <?php echo $color; ?>><?php echo $row_events['numero_notas']; ?></td>
                        
                        <td <?php echo $color; ?>><a type="button" class="btn btn-primary" href="visualizar_evento.php?id=<?php echo $id_eventos ?>">Visualizar</a>
        
                            
                        
                            
                        </tr>
                        <?php } ?>              
                    <tr>
                        

                                
                            </tr>
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="col-1">

                    </div>
                            

                </div>
                </body> <?php     
            
    }
}
else{
    $sql3 = "SELECT * FROM notas_fiscais WHERE numero_notas LIKE '%$notas%';";
  
    $result = mysqli_query($conn, $sql3);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          

            $id_events = $row["eventos_events_id"];
           
            $query_events = "SELECT e.tipo_carga, e.valor_descarga,
            ev.id,e.id_eventos,ev.color,e.events_id,e.nome_fornecedor,e.periodo,
            e.volume,e.transportadora,ev.start,ev.id,e.ajudante,n.numero_notas FROM eventos as e 
            INNER JOIN events as ev
            INNER JOIN notas_fiscais as n
            WHERE ev.id = $id_events && e.events_id = $id_events
            && n.eventos_events_id = $id_events
            AND DATE_ADD(start , INTERVAL 30 DAY);";
           
            
            $result2 = $conn->query($query_events);

            if ($result2->num_rows > 0) {
                while($row = $result2->fetch_assoc()) {
                    $id = $row['id'];
                    $notas = $row['numero_notas'];
                    $id_eventos = $row['id_eventos'];
                    $hora_data = $row['start'];
                    $color = $row['color'];
                    $fornecedor = $row['nome_fornecedor'];
                    $periodo = $row['periodo'];
                    $volume = $row['volume'];
                    $transportadora = $row['transportadora'];
                    $tipo_carga = $row['tipo_carga'];
                    $valor_descarga = $row['valor_descarga'];
                    $ajudante = $row['ajudante'];


    
                    $eventos[] = [
                        'id' => $id,   
                        'numero_notas' => $notas, 
                        'hora_data' => $hora_data,
                        'fornecedor' => $fornecedor, 
                        'periodo' => $periodo, 
                        'color' => $color,
                        'volume' => $volume, 
                        'transportadora' => $transportadora,
                        'tipo_carga' => $tipo_carga,
                        'valor_descarga' => $valor_descarga,
                        'ajudante' => $ajudante
                            
        
                        ];
                      
                    }
                }
             

           
        }
        echo "<div class='row' style=' text-align: center;'>
        <div class='col-1' >
        
        </div>
        <div class='col-10'>
            <div class='margin mb-5'>
                <form action='pesquisar.php' method='POST' style class='form-inline my-2 my-lg-0 float-right'>
                    <input name='fornecedor' class='form-control mr-sm-2' type='search' placeholder='Pesquisar Fornecedor' >
                    <input name='data' class='form-control mr-sm-2' type='date' placeholder='Pesquisar Data' >
                    <input name='notas' class='form-control mr-sm-2' type='type' placeholder='Pesquisar Notas' >
                    <button class='btn btn-success my-2 my-sm-0' type='submit'>Pesquisar</button>
                </form>
            </div>
            <table class='table table-dark table-striped table-hover' style=' margin:auto;'>
                <thead class='thead'>
                    <tr>
                        <th scope='col-2'>Data</th>
                        <th scope='col-2'>Período</th>
                        <th scope='col-2'>Fornecedor</th>
                        <th scope='col-2'>Transportadora</th>
                        <th scope='col-2'>Tipo de Carga</th>
                        <th scope='col-2'>Volume</th>
                        <th scope='col-2'>Valor Descarga</th>
                        <th scope='col-2'>Ajudante</th>
                        <th scope='col-2'>Número Notas</th>
                        <th scope='col-2'>Visualizar</th>
                       
                    </tr>
                </thead>
                <tbody >";
               
  
            
                foreach ($eventos as $row_events){ 
                    $color = $row_events['color'];
                  
                    if($color == '#e83e8c'){
                        
                      $color= 'class="table-danger text-dark"';      
                    }
                    else{
                        $color= 'class="table-primary text-dark"'; 
                    }
    
                }
                foreach ($eventos as $row_events){ ?>                 
                    <tr>
                    <td <?php echo $color; ?>><?php echo date("d-m-y H:i:s", strtotime($row_events['hora_data'])); ?></td>
                        <td <?php echo $color; ?>><?php echo $row_events['periodo']; ?></td>
                        <td <?php echo $color; ?>><?php echo $row_events['fornecedor']; ?></td>
                        <td <?php echo $color; ?>><?php echo $row_events['transportadora']; ?></td>
                        <td <?php echo $color; ?>><?php echo $row_events['tipo_carga']; ?></td>
                        <td <?php echo $color; ?>><?php echo $row_events['volume']; ?></td>
                        <td <?php echo $color; ?>><?php echo $row_events['valor_descarga']; ?></td>
                        <td <?php echo $color; ?>><?php echo $row_events['ajudante']; ?></td>
                        <td <?php echo $color; ?>><?php echo $row_events['numero_notas']; ?></td>
                        
                        <td <?php echo $color; ?>><a type="button" class="btn btn-primary" href="visualizar_evento.php?id=<?php echo $id_eventos ?>">Visualizar</a>
        
                            
                        
                            
                        </tr>
                        <?php } ?>              
                    <tr>
                        

                                
                            </tr>
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="col-1">

                    </div>
                            

                </div>
                </body> <?php     
            
    }

}

?>