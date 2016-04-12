<?php
    include('Conexao.php');

    session_start();

    $email = $_POST['email'];
    $novaSenha = $_POST['senha'];
    $confirmaSenha = $_POST['confirmarSenha'];
    
    $select = "select * from usuario where email='" . $email . "'";

    $result = mysqli_query($conecta, $select);

    $count = 0;

    $achou = 'false';
    $tok = '';    
    
    while ($consulta = mysqli_fetch_array($result)) {
            
        if ($consulta['email'] === $email) {
            $achou = 'true';    
            $tok = $consulta['token'];
        }
        
        if($novaSenha === $confirmaSenha){
            if($achou){
                $update = "update usuario set senha='" . md5($novaSenha) . "' where email='". $email . "'";
                $result = mysqli_query($conecta, $update);            
                exibirMensagemAoUsuario('success', 'Senha alterada com sucesso!');
                header("Location: ..\Index.php");            
            } else {
                exibirMensagemAoUsuario('error', 'Usuário não encontrado!');
                header("Location: ..\Index.php");
            }
        } else {            
            exibirMensagemAoUsuario('error', 'Senhas não conferem!');                
            header("Location: http://pcbnu006300/CopiaMidiaSapiens/AlterarSenha.php?token=" . $tok);            
        }
    }