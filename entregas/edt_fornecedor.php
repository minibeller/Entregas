<?php session_start();
if(empty($_SESSION['email'])){
    header('location:login.php');
}
include 'conexao.php';
include 'menu.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "calendario_entregas";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$entrega = $_GET['id'];
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
$mysqli = mysqli_connect($servername, $username, $password, $dbname);
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit;
  }
  
  // Turn autocommit off
  mysqli_autocommit($mysqli,FALSE);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
    $id_entrega = $_GET['id'];
   
    $id = $_POST['id'];

    $start = $_POST['start'];
    $title = $_POST['title'];
    $nome_fornecedor = $_POST['nome_fornecedor'];
    $periodo = $_POST['periodo'];
    $volume = $_POST['volume'];
    $transportadora = $_POST['transportadora'];
    $tipo_carga = $_POST['tipo_carga'];
    $valor_descarga = $_POST['valor_descarga'];
    $ajudante = $_POST['ajudante'];
    $observacao = $_POST['observacao'];
    $numero_pedidos = $_POST['numero_pedidos'];
    $numero_notas = $_POST['numero_notas'];
    $nome = $_POST['nome'];

    $update = array(
        "id" =>'id',
        "start" =>'start',
        "title" =>'title',
        "nome_fornecedor" =>'nome_fornecedor',
        "periodo" =>'periodo',
        "volume" =>'volume',
        "transportadora" =>'transportadora',
        "tipo_carga" =>'tipo_carga',
        "valor_descarga" =>'valor_descarga',
        "ajudante" =>'ajudante',
        "observacao" =>'observacao',
        "numero_pedidos" =>'numero_pedidos',
        "numero_notas" =>'numero_notas',
        "nome"=> 'nome',
 
    );
  
    

                  mysqli_query($mysqli,"UPDATE `calendario_entregas`.`events` 
                    SET 
                    title='$title',
                    start='$start'
                    WHERE id='$id'");
                    
                    mysqli_query($mysqli,"UPDATE eventos SET 
                    nome_fornecedor='$nome_fornecedor',
                    periodo='$periodo',
                    volume='$volume',
                    transportadora='$transportadora',
                    tipo_carga='$tipo_carga',
                    valor_descarga='$valor_descarga',
                    ajudante='$ajudante',
                    observacao='$observacao'
                    WHERE events_id='$id'");


                    mysqli_query($mysqli,"UPDATE pedidos SET 
                    numero_pedidos='$numero_pedidos'        
                    WHERE eventos_events_id='$id'");

                    mysqli_query($mysqli,"UPDATE notas_fiscais SET 
                    numero_notas='$numero_notas'        
                    WHERE eventos_events_id='$id'");
                    
                    

                  // Commit transaction
                    if (!mysqli_commit($mysqli, TRUE)) {
                        echo "Commit transaction failed";
                        exit();
                    } 

                    else{

                        $sql2 = "SELECT  user.nome, eve.id,e.id_eventos,eve.title,eve.start,e.nome_fornecedor,e.periodo,e.volume,
                        e.transportadora,e.tipo_carga,
                        e.valor_descarga,
                        e.ajudante,e.observacao,p.numero_pedidos,n.numero_notas
                        FROM eventos AS e
                        INNER JOIN pedidos AS p ON e.id_eventos = p.eventos_id_eventos
                        INNER JOIN notas_fiscais AS n on e.id_eventos = n.eventos_id_eventos
                        INNER JOIN user AS user on user.id_user = e.user_id_user
                        INNER JOIN events AS eve on eve.id = e.events_id
                        WHERE eve.id = $entrega;";

                        
                        if ($result = mysqli_query($conn, $sql2)) {  
                            while ($row = $result->fetch_assoc()) {
                                $id = $row['id'];
                                $nome = $row['nome'];
                                $id_eventos = $row['id_eventos'];
                                $start = $row['start'];
                                $title = $row['title'];
                                $nome_fornecedor = $row['nome_fornecedor'];
                                $periodo = $row['periodo'];
                                $volume = $row['volume'];
                                $transportadora = $row['transportadora'];
                                $tipo_carga = $row['tipo_carga'];
                                $valor_descarga = $row['valor_descarga'];
                                $ajudante = $row['ajudante'];
                                $observacao = $row['observacao'];
                                $numero_pedidos = $row['numero_pedidos'];
                                $numero_notas = $row['numero_notas'];
                            }
                        }
                      
                    }

                    ?>
                    <div class='row' style=' text-align: left;'>
                    <div class='col-1' >

                    </div>
                    <div class='col-10' >
                        <hr/>
                        <h1 class='modal-title' id='exampleModalLabel'>Detalhe Entrega</h1>
                        <hr/>
                       <div style='font-size: 20px;' >
                        <p>ID: <?php echo $id; ?><p>
                        <p>Título: <?php echo $title; ?><p>
                        <p>Nome Fornecedor: <?php echo $nome_fornecedor; ?><p>
                        <p>Início: <?php echo date('d-m-Y H:i:s', strtotime($start));    ?><p>
                        <p>Periódo: <?php echo $periodo; ?><p>
                        <p>Volume: <?php echo $volume; ?><p>
                        <p>Transportadora: <?php echo $transportadora; ?><p>
                        <p>Tipo de Carga: <?php echo $tipo_carga; ?><p>
                        <p>Valor Descarga: <?php echo $valor_descarga; ?><p>
                        <p>Ajudante: <?php echo $ajudante; ?><p>
                        <p>Número Pedidos: <?php echo $numero_pedidos; ?><p>
                        <p>Número Notas: <?php echo $numero_notas; ?><p>
                        <p>Observação: <?php echo $observacao; ?><p>
                        <p>Nome Colaborador: <?php echo $nome; ?><p>
                       <button type='button' class='btn btn-primary' data-toggle='modal' data-target='#staticBackdrop' >
                        Editar 
                        </button>
                        <a type='button' class='btn btn-danger' href='apagar_fornecedor2.php?id=<?php echo $id; ?>'>
                        Apagar
                        </a>

                        <!-- Modal -->

                        <form method='post' action=' edt_fornecedor.php?id=.<?php echo $id?>'>

                        <div style='font-size: 15px;' class='modal fade' id='staticBackdrop' data-backdrop='static' data-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
                        <div class='modal-dialog modal-xl'>
                            <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='staticBackdropLabel' >EDITAR EVENTO</h5>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>
                            <div class='modal-body'>

                                <hr/>
                                <div class='form-group row'>

                                    <div class='col-sm-10'>
                                        <input type='hidden' name='id' class='form-control' id='id' value=' <?php echo $id; ?>' >
                                    </div>
                                </div>
                                <div class='form-group row'>
                                    <label class='col-sm-2 col-form-label'>Título</label>
                                    <div class='col-sm-10'>
                                        <input type='text' name='title' class='form-control' id='title' value=' <?php echo $title; ?>'>
                                    </div>
                                </div>
                                <div class='form-group row'>
                                    <label class='col-sm-2 col-form-label'></label>
                                    <div class='col-sm-10'>
                                        <input type='DataHora(event, this)' name='start' class='form-control' id='start' value='  <?php echo date('d-m-y H:i:s', strtotime($start)); ?>'>
                                    </div>
                                </div>
                                <div class='form-group row'>
                                    <label class='col-sm-2 col-form-label'>Nome Fornecedor</label>
                                    <div class='col-sm-10'>
                                        <input type='text' name='nome_fornecedor' class='form-control' id='nome_fornecedor' value=' <?php echo $nome_fornecedor; ?>'>
                                    </div>
                                </div>

                                <div class='form-group row'>
                                    <label class='col-sm-2 col-form-label'>Periódo</label>
                                    <div class='col-sm-10'>
                                        <select name='periodo' class='form-control' id='periodo'>
                                            <option value='<?php echo $periodo; ?>'><?php echo $periodo; ?></option>			
                                            <option value='Manhã'>Manhã</option>
                                            <option value='Trade'>Trade</option>
                                        </select>
                                    </div>
                                </div>
                                <div class='form-group row'>
                                    <label class='col-sm-2 col-form-label'>Volume</label>
                                    <div class='col-sm-10'>
                                        <input type='text' name='volume' class='form-control' id='volume' value='<?php echo $volume; ?>'>
                                    </div>
                                </div>
                                <div class='form-group row'>
                                    <label class='col-sm-2 col-form-label'>Transportadora</label>
                                    <div class='col-sm-10'>
                                        <input type='text' name='transportadora' class='form-control' id='transportadora' value='<?php echo $transportadora; ?>'>
                                    </div>
                                </div>
                                <div class='form-group row'>
                                    <label class='col-sm-2 col-form-label'>Tipo de Carga</label>
                                    <div class='col-sm-10'>
                                        <select name='tipo_carga' class='form-control' id='tipo_carga'>
                                            <option value='<?php echo $tipo_carga; ?>'><?php echo $tipo_carga; ?></option>			
                                            <option value='Batida'>Batida</option>
                                            <option value='Paletizada'>Paletizada</option>
                                        </select>
                                    </div>
                                </div>
                                <div class='form-group row'>
                                    <label class='col-sm-2 col-form-label'>Valor Descarga</label>
                                    <div class='col-sm-10'>
                                        <input type='text' name='valor_descarga' class='form-control' id='valor_descarga' value='<?php echo $valor_descarga; ?>'>
                                    </div>
                                </div>
                                <div class='form-group row'>
                                    <label class='col-sm-2 col-form-label'>Ajudante</label>
                                    <div class='col-sm-10'>
                                        <select name='ajudante' class='form-control' id='ajudante'>
                                            <option value='<?php echo $ajudante; ?>'><?php echo $ajudante; ?></option>			
                                            <option value='Sim'>Sim</option>
                                            <option value='Não'>Não</option>
                                        </select>
                                    </div>
                                </div>
                                <div class='form-group row'>
                                    <label class='col-sm-2 col-form-label'>Observação</label>
                                    <textarea class='form-control' name='observacao' id='observacao' rows='4'><?php echo $observacao; ?></textarea>
                                </div>
                                <hr/>
                                <h5>Nota Fiscal / Número Pedido</h5>
                                <div class='form-group row'>
                                    <label class='col-sm-2 col-form-label'>Nota Fiscal</label>
                                    <div class='col-sm-10'>
                                        <input type='text' name='numero_notas' class='form-control' value='<?php echo $numero_notas; ?>' id='numero_notas' >
                                    </div>
                                </div>                
                                <div class='form-group row'>
                                    <label class='col-sm-2 col-form-label'>Número Pedido</label>
                                    <div class='col-sm-10'>
                                        <input type='text' name='numero_pedidos' class='form-control' id='numero_pedidos' value='<?php echo $numero_pedidos; ?>'>
                                    </div>
                                </div>              


                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-danger' data-dismiss='modal'>Fechar</button>
                                <button class='btn btn-primary' >Salvar</button> 
                            </div>

                            </div>
                        </div>
                        </div>
                        </form>
                       </div>
                    </div>
                    <div class='col-1' >

                    </div>
                </div>

              




