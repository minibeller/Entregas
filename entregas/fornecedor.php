<?php
// Inicia sessões
session_start();
if(empty($_SESSION['email'])){
  header('location:login.php');
}

 include 'conexao.php';
 $id = $_GET["id"];

 
 ?>

    <body id="container" class="mt-0"  >
        <?php
         include 'menu.php';
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        else{
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "calendario_entregas";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            

            $sql = "SELECT * FROM eventos WHERE events_id = ".$id.";";
  
            $result = mysqli_query($conn, $sql);
            $resultado = mysqli_num_rows($result);
            
            if( $resultado > 0) {
                echo "
                <div class='row'>
                    <div class='col'>
                    </div>
                    <div class='col'>
                        <div class='card'>
                            <div class='card-header'>
                                <h3 class='card-title'>Entrega Já Cadastrada!</h3>
                            </div>
                            <div class='card-body'>
                                <h5 class='card-text'>Entrega já cadastrada! Volte ao calendário e cadastre novas entregas.</h5>
                                <a class='btn btn-primary  ml-1' style='float:right' href='index.php'>Calendário</a>
                                
                            </div>
                        </div>
                    </div>
                    <div class='col'>
                    </div>
                </div>
                
                ";
            }

            else{
               echo"<div class='row'>
               <div class='col-2' ></div>
               <div class='col-8'>
                   <form method='post' action='insert_fornecedor.php?id=$id'>
                   <h1 class='list-group-item list-group-item-success success mt-5 mb-2' aria-current='true'>
                   Detalhe Evento
               </h1>
                       <div class='form-group row'>
                           <label class='col-sm-2 col-form-label'>Fornecedor</label>
                           <div class='col-sm-4'>
                               <input type='text' name='nome_fornecedor' class='form-control' id='nome_fornecedor' placeholder='Fornecedor'>
                           </div>
                           <label class='col-sm-2 col-form-label'>Periódo</label>
                           <div class='col-sm-4'>
                               <select name='periodo' class='form-control' id='periodo'>
                                  		
                                   <option value='Manhã'>Manhã</option>
                                   <option value='Tarde'>Tarde</option>
                               </select>                           
                       </div>
                      
                </div>
       
       
       
                       <div class='form-group row'>
                           <label class='col-sm-2 col-form-label'>Volume</label>
                           <div class='col-sm-4'>
                               <input type='text' name='volume' class='form-control' id='volume' placeholder='Volume'>
                           </div>
                           <label class='col-sm-2 col-form-label'>Transportadora</label>
                           <div class='col-sm-4'>
                               <input type='text' name='transportadora' class='form-control' id='transportadora' placeholder='Transportadora'>
                           </div>
                       </div>
                      
                       <div class='form-group row'>
                           <label class='col-sm-2 col-form-label'>Tipo de Carga</label>
                           <div class='col-sm-4'>
                               <select name='tipo_carga' class='form-control' id='tipo_carga'>
                                  		
                                   <option value='Batida'>Batida</option>
                                   <option value='Paletizada'>Paletizada</option>
                               </select>
                           </div>
                           <label class='col-sm-2 col-form-label'>Valor Descarga</label>
                           <div class='col-sm-4'>
                               <input type='text' name='valor_descarga' class='form-control' id='valor_descarga' placeholder='Valor Descarga'>
                           </div>
                       </div>
                       <div class='form-group row'>
                           <label class='col-sm-2 col-form-label'>Nota Fiscal</label>
                           <div class='col-sm-4'>
                               <input type='text' name='numero_notas' class='form-control' id='numero_notas' placeholder='Nota Fiscal'>
                           </div>
                           <label class='col-sm-2 col-form-label'>Número Pedido</label>
                           <div class='col-sm-4'>
                               <input type='text' name='numero_pedidos' class='form-control' id='numero_pedidos' placeholder='Número Pedido'>
                           </div>
                       </div> 
                       <div class='form-group row'>
                       <label class='col-sm-2 col-form-label'>Ajudante</label>
                       <div class='col-sm-10'>
                           <select name='ajudante' class='form-control' id='ajudante'>
                                       
                               <option value='Sim'>Sim</option>
                               <option value='Não'>Não</option>
                           </select>
                       </div>
                        </div>  
                       <div class='form-group row'>
                           <label class='col-12 col-form-label'>Observação</label>
                           
                                <div class='col-12' style='width:100%'>
                                    <textarea  class='form-control' name='observacao' id='observacao' rows='4'></textarea>
                                
                           </div>
                           
                       </div>
                                    
                      
                       <div class='form-group row'>
                           <div class='col-sm-12'>
                               <button type='submit' style='width: 100%;' class='btn btn-success'>Cadastrar</button>                                    
                           </div>
                       </div>
                   </form>
               </div>
               <div class='col-2'></div>
               </div>   
               
           </body>";
            }
            

            
         
            

        }
        ?>
   