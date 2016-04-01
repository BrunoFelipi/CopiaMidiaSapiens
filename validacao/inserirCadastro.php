<?php

include('Conexao.php');

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

    echo 'Count: ' . $count . '<br>';
    
    if ($count === 0) {
        if ($senha === $confirmarSenha) {
            echo 'Email: ' . $email . "<br>";
            echo 'Senha: ' . $senha . "<br><br>";
            $senha = md5($senha);
            $insert = "insert into usuario values (0,'$email','$senha')";
            mysqli_query($conecta, $insert);
            exibirMensagemAoUsuario("Success", "Usuário cadastrado com sucesso!");
            //header("Location: ../Cadastrar.php");
        } else {
            exibirMensagemAoUsuario("Error", "Senhas não conferem!");
            //header("Location: ../Cadastrar.php");
        }
    } else {
        exibirMensagemAoUsuario("Warning", "Usuário já cadastrado!");
        //header("Location: ../Cadastrar.php");
    }
}