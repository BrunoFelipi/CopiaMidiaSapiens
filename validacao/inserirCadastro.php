<?php include('conexao.php') ?>
<?php include('import.html') ?>

<?php

    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $confirmarSenha = $_POST['confirmarSenha'];

    $select = "select * from usuario";
    
    $result = mysqli_query($conecta, $select);
    
    $count = 0;
    
    while($consulta = mysqli_fetch_array($result)){
        
        if($consulta["email"] === $email){            
            $count++;
        }
    }
           
    if($count === 0){
        if($senha === $confirmarSenha){        
            echo 'Email: ' . $email . "<br>";
            echo 'Senha: ' . $senha . "<br><br>";
            $insert = "insert into usuario values (0,'$email','$senha')";
            
            mysqli_query($conecta, $insert);
            $_SESSION['status'] = 'Cadastrou';            
            header("Location: ../novoCadastro.php");                
        } else {
            $_SESSION['status'] = 'SenhaDiferente';
            header("Location: ../novoCadastro.php");
        }        
    } else {
        $_SESSION['status'] = 'jaExiste';
        header("Location: ../novoCadastro.php");
    }   

?>