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
        <link rel="stylesheet" href="lobibox-master/dist/css/LobiBox.min.css">
                
        <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
        <script src="lobibox-master/dist/js/lobibox.js"></script>
        <script src="lobibox-master/dist/js/messageboxes.min.js"></script>
        <script src="lobibox-master/dist/js/notifications.min.js"></script>
        <script src="lobibox-master/dist/js/lobibox.min.js" type="text/javascript"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        
        <script type="text/javascript">
            
            function teste(){
                Lobibox.notify('success', {
                    size: 'mini',
                    img: 'sa.png' ,
                    msg: 'Arquivos copiados com sucesso'
                });
            }
            
        </script>
        
    </head>
    
    <body style="background-color: white">
            
        <input type="button" onclick="teste()" value="Teste">
        
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
