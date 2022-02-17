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

?>

<body id="container" class="mt-0">
    <?php

    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
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
    <div class="row" style="margin-top: 90px; font-size: 15px;">
        <div class="col-1"></div>
        <div class="col-10">
            <div class="list-group">
                <h1 class="list-group-item list-group-item-success success" aria-current="true">
                    Detalhe Entrega
                </h1>
                <div class="row">
                    <div class="col-6 houver" style='padding-right:0px !important'>
                        <p class="list-group-item list-group-item-action list-group-item-light"> ID: <?php echo $id; ?></p>

                    </div>
                    <div class="col-6" style='padding-left:0px !important'>
                        <p class="list-group-item list-group-item-action list-group-item-light">Título: <?php echo $title; ?></p>

                    </div>
                </div>
                <div class="row">
                    <div class="col-6" style='padding-right:0px !important'>
                        <p class="list-group-item list-group-item-action list-group-item-light">Nome Fornecedor: <?php echo $nome_fornecedor; ?></p>

                    </div>
                    <div class="col-6" style='padding-left:0px !important'>
                        <p class="list-group-item list-group-item-action list-group-item-light">Início: <?php echo date("d-m-Y H:i:s", strtotime($start)); ?></p>

                    </div>
                </div>
                <div class="row">
                    <div class="col-6" style='padding-right:0px !important'>
                        <p class="list-group-item list-group-item-action list-group-item-light ">Início: <?php echo date("d-m-Y H:i:s", strtotime($start));    ?></p>

                    </div>
                    <div class="col-6" style='padding-left:0px !important'>
                        <p class="list-group-item list-group-item-action list-group-item-light ">Periódo: <?php echo $periodo; ?></p>

                    </div>
                </div>
                <div class="row">
                    <div class="col-6" style='padding-right:0px !important'>
                        <p class="list-group-item list-group-item-action list-group-item-light ">Volume: <?php echo $volume; ?></p>

                    </div>
                    <div class="col-6" style='padding-left:0px !important'>
                        <p class="list-group-item list-group-item-action list-group-item-light ">Transportadora: <?php echo $transportadora; ?></p>

                    </div>
                </div>
                <div class="row">
                    <div class="col-6" style='padding-right:0px !important'>
                        <p class="list-group-item list-group-item-action list-group-item-light ">Tipo de Carga: <?php echo $tipo_carga; ?></p>

                    </div>
                    <div class="col-6" style='padding-left:0px !important'>
                        <p class="list-group-item list-group-item-action list-group-item-light ">Valor Descarga: <?php echo $valor_descarga; ?></p>

                    </div>
                </div>
                <div class="row">
                    <div class="col-6" style='padding-right:0px !important'>
                        <p class="list-group-item list-group-item-action list-group-item-light ">Ajudante: <?php echo $ajudante; ?></p>

                    </div>
                    <div class="col-6" style='padding-left:0px !important'>
                        <p class="list-group-item list-group-item-action list-group-item-light ">Número Pedidos: <?php echo $numero_pedidos; ?></p>

                    </div>
                </div>
                <div class="row">
              
                    <div class="col-6" style='padding-right:0px !important'>
                        <p class="list-group-item list-group-item-action list-group-item-light ">Nome Colaborador: <?php echo $nome; ?></p>


                    </div>
                </div>
                <div class="row">
                <div class="col-12" >
                        <textarea rows="4" class="list-group-item list-group-item-action list-group-item-light ">Número Notas: <?php echo $numero_notas; ?></textarea>
                    </div>
                    
                    
                </div>
                <div class="row">
                
                    <div class="col-12" >
                        <textarea rows="5" class="list-group-item list-group-item-action list-group-item-light ">Observação: <?php echo $observacao; ?></textarea>

                    </div>
                    
                </div>










                <div class="row" style="margin-top: 20px;">
                    <div class="col-6">
                        <a type="button" style="width: 100%;" href='editar.php?id=<?php echo $entrega ?>' class="btn btn-primary">
                            Editar
                        </a>
                    </div>
                    <div class="col-6">
                        <a type="button" style="width: 100%;" class="btn btn-danger" href="apagar_fornecedor2.php?id=<?php echo $id; ?>">
                            Apagar
                        </a>
                    </div>
                </div>



            </div>

        </div>
        <div class="col-1"></div>
    </div>