<?php

$conecta = mysqli_connect('localhost', 'root', '','sapiens');

if (!$conecta) {
    die('Não foi possível conectar: '.mysql_error());
}
?>