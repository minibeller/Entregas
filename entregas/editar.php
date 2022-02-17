<?php
session_start();
if (empty($_SESSION['email'])) {
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
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$entrega = $_GET['id'];
$sql = "SELECT  user.nome, eve.id,e.id_eventos,eve.title,eve.start,e.nome_fornecedor,e.periodo,e.volume,
e.transportadora,e.tipo_carga,
e.valor_descarga,
e.ajudante,e.observacao,p.numero_pedidos,n.numero_notas
FROM eventos AS e
INNER JOIN pedidos AS p ON e.id_eventos = p.eventos_id_eventos
INNER JOIN notas_fiscais AS n on e.id_eventos = n.eventos_id_eventos
INNER JOIN events AS eve on eve.id = e.events_id
INNER JOIN user AS user on user.id_user = e.user_id_user
WHERE e.id_eventos = $entrega;";



if ($result = mysqli_query($conn, $sql)) {
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
?>

<div class="row">
    <div class="col-1"></div>
    <div class="col-10">
        <form method="post" action="edt_fornecedor.php?id=<?php echo $id ?>">
            <h1 class="list-group-item list-group-item-action list-group-item-success">EDITAR EVENTO</h1>

            <div>
     
                <div class="form-group row">

                    <div class="col-sm-10">
                        <input type="hidden" name="id" class="form-control" id="id" value=" <?php echo $id; ?>">
                    </div>
                </div>
                <div class="form-group row">
                
                    <div class="col-sm-10">
                        <input type="hidden" name="nome" class="form-control" id="nome" value=" <?php echo $nome; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Título</label>
                    <div class="col-sm-10">
                        <input type="text" name="title" class="form-control" id="title" value=" <?php echo $title; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Data Hora</label>
                    <div class="col-sm-10">
                        <input type="DataHora(event, this)" name="start" class="form-control" id="start" value=" <?php echo date("d-m-y H:i:s", strtotime($start)); ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nome Fornecedor</label>
                    <div class="col-sm-10">
                        <input type="text" name="nome_fornecedor" class="form-control" id="nome_fornecedor" value=" <?php echo $nome_fornecedor; ?>">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Periódo</label>
                    <div class="col-sm-10">
                        <select name="periodo" class="form-control" id="periodo">
                            <option value="<?php echo $periodo; ?>"><?php echo $periodo; ?></option>
                            <option value="Manhã">Manhã</option>
                            <option value="Trade">Trade</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Volume</label>
                    <div class="col-sm-10">
                        <input type="text" name="volume" class="form-control" id="volume" value="<?php echo $volume; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Transportadora</label>
                    <div class="col-sm-10">
                        <input type="text" name="transportadora" class="form-control" id="transportadora" value="<?php echo $transportadora; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Tipo de Carga</label>
                    <div class="col-sm-10">
                        <select name="tipo_carga" class="form-control" id="tipo_carga">
                            <option value="<?php echo $tipo_carga; ?>"><?php echo $tipo_carga; ?></option>
                            <option value="Batida">Batida</option>
                            <option value="Paletizada">Paletizada</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Valor Descarga</label>
                    <div class="col-sm-10">
                        <input type="text" name="valor_descarga" class="form-control" id="valor_descarga" value="<?php echo $valor_descarga; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Ajudante</label>
                    <div class="col-sm-10">
                        <select name="ajudante" class="form-control" id="ajudante">
                            <option value="<?php echo $ajudante; ?>"><?php echo $ajudante; ?></option>
                            <option value="Sim">Sim</option>
                            <option value="Não">Não</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Observação</label>
                    <textarea class="form-control" name="observacao" id="observacao" rows="4"><?php echo $observacao; ?></textarea>
                </div>
                <hr />
                <h5>Nota Fiscal / Número Pedido</h5>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Nota Fiscal</label>
                    <div class="col-sm-10">
                        <input type="text" name="numero_notas" class="form-control" value="<?php echo $numero_notas; ?>" id="numero_notas">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Número Pedido</label>
                    <div class="col-sm-10">
                        <input type="text" name="numero_pedidos" class="form-control" id="numero_pedidos" value="<?php echo $numero_pedidos; ?>">
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                <button class="btn btn-primary">Salvar</button>
            </div>

    </div>
</div>
</div>
</form>

</div>
<div class="col-1"></div>
</div>