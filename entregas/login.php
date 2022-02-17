<?php
include 'menu.php';
include_once 'conexao.php';
?>

<body class="text-center" style="margin-top: 150px;width:100%;background: #FFFFFF url('img/caminhao.jpg') no-repeat right  fixed;">
    <div class="row" style="width:100%; overflow-x:hidden">
        <div class="col-4" style="width:100%;"></div>
        <div class="col-4" style="width:100%;">
            <div class="col-sm text-center">
                <form method="POST" action="verifica_login.php" class="form-signin">
                    <img class="mb-4" src="img/logo.png" style=" width:300px;">
                    <b><h1 class="h3 mb-3 font-weight-normal" style="color: white;">Agendamento de Entregas</h1></b>
                    <label for="inputEmail" class="sr-only">E-mail:</label>
                    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus>
                    <label for="inputPassword" class="mt-3 sr-only">Senha:</label>
                    <input type="password" name="senha" id="inputPassword" class="form-control" placeholder="Senha" required>
                    <button class="btn mt-3 text-white btn-lg btn-block" style="  background-image: linear-gradient(to right, #414291, rgba(204, 53, 58, 0.82));" type="submit">Login</button>
                    <b><p style="color: white;" class="mt-5 mb-3">&copy; 2020 Tecnologia da Informação e Comunicação</p></b>
                </form>
            </div>
        </div>
        <div class="col-4" style="width:100%;"></div>
    </div>
</body>