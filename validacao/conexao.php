<?php

$conecta = mysqli_connect('localhost', 'root', '','sapiens');

if (!$conecta) {
    die('Não foi possível conectar: '.mysql_error());
}

function exibirMensagemAoUsuario($type = "info", $text = "sem_texto"){
    //session_start();
    $_SESSION['status'] = array('type' => $type, 'text' => $text);
}