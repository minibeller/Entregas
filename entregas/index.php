    <?php


    // Inicia sessões
    session_start();
    if (empty($_SESSION['email'])) {
        header('location:login.php');
    }

    include 'conexao.php';


    ?>

    <body id="container" style="margin-top: 50px;">
        <?php
        include 'menu.php';
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }



        ?>
        <div  style="background-color: white; color: white !important;" id='calendar'></div>


        <div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detalhes do Evento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="visevent">
                            <dl class="row">
                                <dt class="col-sm-3">Início:</dt>
                                <dd class="col-sm-9" id="start"></dd>
                                <dt class="col-sm-3">ID:</dt>
                                <dd class="col-sm-9" id="id"></dd>
                            </dl>
                            <a href="" id="apagar_evento" class="btn btn-danger">Apagar</a>


                            <a class="btn btn-primary float-right" id='fornecedor' (click)="fornecedor()">Adicionar Informações</a>




                        </div>

                        <div class="formedit">
                            <span id="msg-edit"></span>
                            <form id="editevent" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" id="id">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Título</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="title" class="form-control" id="title" placeholder="Título do evento">

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Início do evento</label>
                                    <div class="col-sm-10">
                                        <input type="text" name="start" class="form-control" id="start" onkeypress="DataHora(event, this)">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-10">
                                        <button type="button" class="btn btn-primary btn-canc-edit">Cancelar</button>
                                        <button type="submit" name="CadEvent" id="CadEvent" value="CadEvent" class="btn btn-warning">Salvar</button>

                                    </div>
                                </div>
                                <select name="color" class="form-control">
                                    <option value="">Selecione</option>
                                    <option style="color:#e83e8c;" value="#e83e8c">merchandising</option>
                                    <option style="color:#0071c5;" value="#0071c5">Compras </option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="cadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Cadastrar Evento</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <span id="msg-cad"></span>
                        <form method="post" action="cadastrar_evento.php">
                            <label class="col-sm-3 col-form-label">Título</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Título do evento">
                            <label class="col-sm-3 col-form-label">Início do evento</label>
                            <input type="datetime-local" name="start" class="form-control" id="start" onkeypress="DataHora(event, this)">
                            <label class="col-sm-3 col-form-label">Setor</label>
                            <select name="color" class="form-control">
                                <option value="">Selecione</option>
                                <option style="color:#e83e8c;" value="#e83e8c">merchandising</option>
                                <option style="color:#0071c5;" value="#0071c5">Compras </option>
                            </select>
                            <input type="submit" style="width: 100%;" class="mt-4 btn btn-success">


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>