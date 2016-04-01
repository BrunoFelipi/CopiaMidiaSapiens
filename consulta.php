<?php include('validacao/Conexao.php');

    session_start();

    if(empty($_SESSION['id']) or empty($_SESSION['email'])){
        session_destroy();
        header("Location: ..\Login.php"); 
    }
    
    date_default_timezone_set('America/Sao_Paulo');
    
    $email = $_SESSION['email'];
    $data = date('d-m-Y') . ' ' .date('H:i:s');

    $insert = "insert into consulta values (0,'$email','$data')";
    mysqli_query($conecta, $insert);
    
?>

<html>    
    <head>      
        
        <?php include('validacao/ImportCss.html') ?>
        
        <link rel="shortcut icon" type="image/x-icon" href="resources/erp-logo.ico"/>
        
        <style>            
            body, html {
                height: 100%;
                background-repeat: no-repeat;
                background-image: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));
            }                        
        </style>        
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
                    <td><font color="white"><b>#</b></font></td>
                    <td><font color="white"><b>Usuário</b></font></td>
                    <td><font color="white"><b>Máquina</b></font></td>
                    <td><font color="white"><b>Data / Hora - Cópia</b></font></td>
                    <td><font color="white"><b>Versão</b></font></td>
                </tr> 
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($conecta, 'select * from info order by id desc');
                while($consulta = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo "<td><font color=#d9d9d9>".$consulta["id"]."</font></td>";
                    echo "<td><font color=#d9d9d9>".$consulta["usuario"]."</font></td>";
                    echo "<td><font color=#d9d9d9>".$consulta["maquina"]."</font></td>";
                    echo "<td><font color=#d9d9d9>".$consulta["data"]."</font></td>";
                    echo "<td><font color=#d9d9d9>".$consulta["versao"]."</font></td>";
                    echo "</tr>";
                }
                ?>           
            </tbody>
        </table>
        
        <?php include('validacao/ImportJs.php') ?>
        
    </body>    
</html>