<?php include('conexao.php') ?>
<?php include('import.html') ?>

<?php

    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmarSenha = $_POST['confirmarSenha'];

    if($senha === $confirmarSenha){        
        $insert = "insert into usuario values (0,'$email','$senha')";
        mysqli_query($conecta, $insert);
        
    }
    
    echo 'Email: ' . $email . '<br>';
    echo 'Senha: ' . $senha . '<br>';
    echo 'Confirmar Senha: ' . $confirmarSenha;

?>