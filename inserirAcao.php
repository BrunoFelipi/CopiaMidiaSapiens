<?php include('conexao.php') ?>
<?php include('./import.html') ?>

<?php
    session_start();
           
    if($_SESSION['sessao'] != 'conectado'){       
        session_unset();
        session_destroy();
        header("Location: index.php");
    }

    /*
    date_default_timezone_set('America/Sao_Paulo');
    
    $maquina = gethostbyaddr($_SERVER['REMOTE_ADDR']);
    $data = date('d-m-Y') . ' ' .date('H:i:s');
    
    $insert = "insert into usuario values (0,'$maquina','$data')";
    mysqli_query($conecta, $insert);
    session_unset();
    session_destroy();
    */

?>
<html>    
        <script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
        <script src="lobibox-master/dist/js/lobibox.js"></script>
        <script src="lobibox-master/dist/js/messageboxes.min.js"></script>
        <script src="lobibox-master/dist/js/notifications.min.js"></script>
        <script src="lobibox-master/dist/js/lobibox.min.js" type="text/javascript"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
                
</html>
<?php
    //header("Location: index.php");
?>