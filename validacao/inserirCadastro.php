<?php
    include('Conexao.php');

    $email = $_POST['email'];
    $senha = md5($_POST['senha']);
    $confirmarSenha = md5($_POST['confirmarSenha']);

    $select = "select * from usuario";

    $result = mysqli_query($conecta, $select);

    $count = 0;

    while ($consulta = mysqli_fetch_array($result)) {

        if ($consulta['email'] === $email) {
            $count++;
        }
    }
    
    if ($count === 0) {
        if ($senha === $confirmarSenha) {
            $insert = "insert into usuario values (0,'$email','$senha')";
            mysqli_query($conecta, $insert);
            exibirMensagemAoUsuario('success', 'Usuário cadastrado com sucesso!');            
            header("Location: ../Cadastrar.php");
        } else {
            exibirMensagemAoUsuario('error', 'Senhas não conferem!');            
            header("Location: ../Cadastrar.php");
        }
    } else {
        exibirMensagemAoUsuario('Warning', 'Usuário já cadastrado!');
        header("Location: ../Cadastrar.php");
    }
