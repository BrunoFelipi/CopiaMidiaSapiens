<?php include('Conexao.php');
    
    session_start();
    
    $usuario = $_SESSION['usuario'];
    $versao = $_SESSION['versao'];
    $release = $_SESSION['release'];

    date_default_timezone_set('America/Sao_Paulo');

    $maquina = gethostbyaddr($_SERVER['REMOTE_ADDR']);
    $data = date('d-m-Y') . ' ' .date('H:i:s');

    $insert = "insert into info values (0, '$usuario', '$maquina', '$data', '$versao . $release')";
    
    mysqli_query($conecta, $insert) or die(mysql_errno($conecta));
    
    unset($_SESSION['usuario']);
    unset($_SESSION['versao']);
    unset($_SESSION['release']);        
    header("Location: ../CopiarMidia.php");    