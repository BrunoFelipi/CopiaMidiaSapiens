<?php include('conexao.php') ?>
<?php include('import.html') ?>
<?php include ('./index.php') ?>

<?php
    /*
    date_default_timezone_set('America/Sao_Paulo');

    $maquina = gethostbyaddr($_SERVER['REMOTE_ADDR']);
    $data = date('d-m-Y') . ' ' .date('H:i:s');

    $insert = "insert into info values (0,'$maquina','$data')";
    mysqli_query($conecta, $insert);
    session_unset();
    session_destroy();    

    */
    header("Location: index.php");    
?>