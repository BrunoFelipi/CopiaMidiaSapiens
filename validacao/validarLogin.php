<?php include('Conexao.php');

    session_start();
    
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['senha'] = md5($_POST['senha']);
    
    $email = addslashes($_SESSION['email']);
    $senha = addslashes($_SESSION['senha']);
            
    $select = "select * from usuario where email='" . $email . "'";//"' and senha='" . $senha . "'";
    
    $result = mysqli_query($conecta, $select);
    
    $usuJaExist = true;
    $senhaInvalida = false;
    
    while($consulta = mysqli_fetch_array($result)){
        if($consulta["senha"] === $senha){
            session_start();
            $_SESSION['id'] = $consulta['id'];
            $_SESSION['email'] = $consulta['email'];
            $_SESSION['senha'] = $consulta['senha'];
            header("Location: ..\CopiarMidia.php");  
            $usuJaExist = false;
            $senhaInvalida = false;
        } else {
            $usuJaExist = false;
            $senhaInvalida = true;
        }        
    }
        
    if($usuJaExist){
        exibirMensagemAoUsuario('error', 'Credenciais inválidas!');   
        header("Location: ..\Index.php");
    } else if($senhaInvalida){
        exibirMensagemAoUsuario('error', 'Credenciais inválidas!');    
        header("Location: ..\Index.php");
    }  