<?php 
    include('validacao/Conexao.php');
    include('validacao/Lobibox.php');
    
    if(!isset($_SESSION['email']) or !isset($_SESSION['senha'])){
        header("Location: Index.php");        
    }

?>

<html>
    <head>
        
        <?php include('validacao/ImportCss.html') ?>
        
        <title>Copiar Mídia</title>
        
        <link rel="shortcut icon" type="image/x-icon" href="resources/erp-logo.ico"/>
        
        <meta charset="UTF-8">
        <title>Sapiens</title>  
        
    </head>
    
    <body style="background-color: white" onload="inicializa()">
        
        <div class="container-fluid" style="margin-top: 10px">
                        
            <form method="POST" action="">                
                
                <h4><label for="class_type" style="float: right"><span class="label label-default">Usuário logado: <?php echo $_SESSION['email']; ?></span></label></h4>
                
                <button type="button" class="btn btn-danger" onclick="window.open('validacao/Logout.php','_self')">
                    Logout <span class="glyphicon glyphicon-log-out"></span>
                </button>                
                
                <button type="button" class="btn btn-danger" onclick="window.open('Consulta.php','_self')">
                    Consulta <span class="glyphicon glyphicon-search"></span>
                </button>                
                                
            </form>            
        </div>
            
        <div class="container" style="margin-top: 50px">
            <form action="validacao/CopiarArquivo.php" method="POST">
                
                <label>Versão</label>                
                <select class="form-control" name="versao" id="versao">
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
                
        <?php include('validacao/ImportJs.php') ?>
        
    </body>    
</html>