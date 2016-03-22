<?php include('conexao.php') ?>
<?php include('./import.html') ?>
<?php
$sqlProdutos = "select * from usuario";

session_start();

$_SESSION['sessao'] = "conectado";


?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sapiens</title>
        
        <script>
        
        function notify($status){
                
            if($status === 'ok'){
                Lobibox.notify('success', {
                    size: 'mini',
                    img: 'sa.png' ,
                    msg: 'Mídia copiada com sucesso',
                    sound: true
                });
            } else {
                Lobibox.notify('error', {
                    size: 'mini',
                    img: 'sa.png' ,
                    msg: 'Erro ao copiar mídia'
                });
            }
        }

        window.onload = function(opc, status){
            
            if(opc === 1){
                notify(status);
            }
            
        }
        
        </script>
        
    </head>
    
    <body style="background-color: white">
            
        <div class="container" style="margin-top: 50px">
            <form action="copiarArquivo.php" method="POST">
                                
                <label>Versão</label>                
                <select class="form-control" name="versao">
                    <?php            
                        $files = array_slice(scandir('\\\\seniorpdc\\midia\\Sapiens'), 2);            

                        for($i = 0; $i < count($files); $i++){                            
                            echo '<option>' . $files[$i] . '</option>';
                        }            
                    ?>                  
                </select>
                <br> 
                <label>Release</label>
                <input class="form-control" type="number" min="1" max="200" value="1" name="release">
                <br>
                <input class="btn btn-danger" type="submit" name="sub" value="Copiar">
                
            </form>
        </div>
    </body>    
</html>
