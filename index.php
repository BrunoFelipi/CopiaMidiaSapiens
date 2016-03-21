<?php include('conexao.php') ?>
<?php
$sqlProdutos = "select * from usuario";
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
        <link rel="stylesheet" type="text/css" href="css/bootstrap.js">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-modal.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
        
        <link rel="stylesheet" href="lobibox-master/dist/css/LobiBox.min.css">
        <script src="lobibox-master/dist/js/lobibox.min.js"></script>
        
        <script>
                
            window.onload = function (){

                var notify = Lobibox.notify('Success',{
                title: 'Show',
                img: 'erp.png';        
                msg: 'Arquivos copiados com sucesso'            
            });

            window.onbeforeunload = function(){        
                notify.show();        
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
