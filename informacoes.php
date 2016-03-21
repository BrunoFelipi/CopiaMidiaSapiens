<?php include('conexao.php') ?>
<?php include('./index.php') ?>

<table class="table table-hover">
    <thead>
        <tr>
            <td><b>ID</b></td>
            <td><b>Maquina</b></td>
            <td><b>Data / Hora</b></td>
        </tr> 
    </thead>
    <tbody>
        <?php
        $result = mysqli_query($conecta, 'usuario');
        while($consulta = mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td>".$consulta["id"]."</td>";
            echo "<td>".$consulta["maquina"]."</td>";
            echo "<td>".$consulta["dia"]."</td>";
            echo "</tr>";
        }
        ?>           
    </tbody> 
</table>       