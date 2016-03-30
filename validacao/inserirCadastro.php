<?php

include('conexao.php');

if (isset($_POST)) {
    
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmarSenha = $_POST['confirmarSenha'];

    $select = "select * from usuario";

    $result = mysqli_query($conecta, $select);

    $count = 0;

    while ($consulta = mysqli_fetch_array($result)) {

        if ($consulta["email"] === $email) {
            $count++;
        }
    }

    if ($count === 0) {
        if ($senha === $confirmarSenha) {
            echo 'Email: ' . $email . "<br>";
            echo 'Senha: ' . $senha . "<br><br>";
            $senha = md5(senha);
            $insert = "insert into usuario values (0,'$email','$senha')";
            mysqli_query($conecta, $insert);
            exibirMensagemAoUsuario("success", "Cadastrado com sucesso!");
            header("Location: ../novoCadastro.php");
        } else {
            exibirMensagemAoUsuario("error", "Credenciais incorretas!");
            header("Location: ../novoCadastro.php");
        }
    } else {
        exibirMensagemAoUsuario("warning", "Usuário já existe!");
        header("Location: ../novoCadastro.php");
    }
}