<!DOCTYPE html>
<html lang="pt-br" style="overflow-x:hidden">

<head>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <meta charset='utf-8' />
    <link href='css/core/main.min.css' rel='stylesheet' />
    <link href='css/daygrid/main.min.css' rel='stylesheet' />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/personalizado.css">
    <script src='js/core/main.min.js'></script>
    <script src='js/interaction/main.min.js'></script>
    <script src='js/daygrid/main.min.js'></script>
    <script src='js/core/locales/pt-br.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="js/personalizado.js"></script>


</head>
<?php

    if (empty($_SESSION['email'])) {
    echo "<nav class='mt-3'>
                <div class='row'>
                    <div class='col-2'>
                
                    </div>
                    <div class='col-8'>
                    </div>
                    <div class='col-2'>
                      
                    </div>
                </div>
            </nav>";
} else {
    echo "
    <div class='row mb-5'>
    <nav class='navbar fixed-top navbar-dark bg-dark' style='width:100%'> 
        <div class='col-6'><img src='img/logo.png' style=' width:120px;margin-top: 0px; height: 0 auto;'></div>
      
        <div class='col-6'>
          <a class='btn btn-danger ml-1' style='float:right' href='logout.php'>Logout</a>
          <a class='btn btn-primary  ml-1' style='float:right'  href='exibir_eventos.php'>Lista de Eventos</a>
          <a class='btn btn-primary  ml-1' style='float:right'  href='index.php'>Calendario</a>
        </div>
        </nav>
      </div>
   
   

    

</nav>  ";

    
}

?>

