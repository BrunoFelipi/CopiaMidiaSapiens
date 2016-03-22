<?php include('conexao.php') ?>
<?php include('./import.html') ?>
<?php include ('./index.php') ?>

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
    $index.notify(1,"");
    header("Location: index.php");
?>