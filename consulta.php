<?php include('validacao/Conexao.php');

    session_start();

    if(empty($_SESSION['id']) or empty($_SESSION['email'])){
        session_destroy();
        header("Location: ..\Login.php"); 
    }
    
    date_default_timezone_set('America/Sao_Paulo');
    
    $email = $_SESSION['email'];
    $data = date('d-m-Y') . ' ' .date('H:i:s');
?>

<html>    
    <head>      
        
        <title>Consulta</title>
        
        <?php include('validacao/ImportCss.html') ?>
        
        <link rel="shortcut icon" type="image/x-icon" href="resources/erp-logo.ico"/>
             
    </head>
    
    <body>       
        
        <div class="container-fluid" style="margin-top: 10px">
            <form action="CopiarMidia.php" method="POST">                
                <button type="submit" name="login" class="btn btn-danger">
                    <span class="glyphicon glyphicon-menu-left"></span> Voltar
                </button>                
            </form>
        </div>
        
        <table class="table table-hover">
            <thead>
                <tr>
                    <td><b>#</b></td>
                    <td><b>Usuário</b></td>
                    <td><b>Máquina</b></td>
                    <td><b>Data / Hora - Cópia</b></td>
                    <td><b>Versão</b></td>
                    <td><b>Status</b></td>
                </tr> 
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($conecta, 'select * from info order by id desc');
                while($consulta = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo "<td>".$consulta["id"]."</td>";
                    echo "<td>".$consulta["usuario"]."</td>";
                    echo "<td>".$consulta["maquina"]."</td>";
                    echo "<td>".$consulta["data"]."</td>";
                    echo "<td>".$consulta["versao"]."</td>";
                    echo "<td>".$consulta["status"]."</td>";
                    echo "</tr>";
                }
                ?>           
            </tbody>
        </table>
        
        <?php include('validacao/ImportJs.php') ?>
        
    </body>    
</html>