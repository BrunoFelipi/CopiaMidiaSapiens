<?php include('validacao/conexao.php') ?>
<?php include('validacao/import.html') ?>

<html>    
    <head>        
        <style>            
            body, html {
                height: 100%;
                background-repeat: no-repeat;
                background-image: linear-gradient(rgb(104, 145, 162), rgb(12, 97, 33));
            }  
            
            tr.clicked {
                background-color: orange;
            }
                        
        </style>        
    </head>
    
    <body>       
        
        <div class="container-fluid" style="margin-top: 10px">
            <form action="login.php" method="POST">                
                <button type="submit" name="login" class="btn btn-danger">
                    Logout <span class="glyphicon glyphicon-log-out"></span>
                </button>                
            </form>
        </div>
        
        <table class="table table-hover">
            <thead>
                <tr>
                    <td><font color="white"><b>ID</b></font></td>
                    <td><font color="white"><b>Maquina</b></font></td>
                    <td><font color="white"><b>Data / Hora - Cópia</b></font></td>
                </tr> 
            </thead>
            <tbody>
                <?php
                $result = mysqli_query($conecta, 'select * from usuario order by id desc');
                while($consulta = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo "<td><font color=#d9d9d9>".$consulta["id"]."</font></td>";
                    echo "<td><font color=#d9d9d9>".$consulta["maquina"]."</font></td>";
                    echo "<td><font color=#d9d9d9>".$consulta["dia"]."</font></td>";
                    echo "</tr>";
                }
                ?>           
            </tbody>
        </table>
    </body>    
</html>