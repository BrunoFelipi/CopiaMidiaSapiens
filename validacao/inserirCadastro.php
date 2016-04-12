<?php
    include('Conexao.php');

    session_start();
    
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
        
        if(!strpos($email, 'senior.com.br')){
            exibirMensagemAoUsuario('error', 'Email inválido!');            
            header("Location: ..\Cadastrar.php");            
        } else {        
            if ($senha === $confirmarSenha) {
                $token = sha1(uniqid($email,TRUE));
                $insert = "insert into usuario values (0,'$email','$senha', '$token')";
                mysqli_query($conecta, $insert);
                exibirMensagemAoUsuario('success', 'Usuário cadastrado com sucesso!');            
                header("Location: ..\Cadastrar.php");
            } else {
                exibirMensagemAoUsuario('error', 'Senhas não conferem!');            
                header("Location: ..\Cadastrar.php");
            }
        }
    } else {        
        exibirMensagemAoUsuario('warning', 'Usuário já cadastrado!');
        header("Location: ..\Cadastrar.php");
    }    