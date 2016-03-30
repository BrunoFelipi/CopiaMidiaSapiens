<?php include('Conexao.php');

    if(isset($_SESSION['email']) or isset($_SESSION['senha'])){
        session_destroy();
        header("Location: ..\Index.php");
    }

    $email = $_POST['email'];    
    $senha = md5($_POST['senha']);
            
    $select = "select * from usuario where email='" . $email ."'";//"' and senha='" . $senha . "'";
    
    $result = mysqli_query($conecta, $select);
    
    $usuJaExist = true;
    $senhaInvalida = false;
    
    while($consulta = mysqli_fetch_array($result)){
        if($consulta["senha"] === $senha){
            session_start();
            $_SESSION['id'] = $consulta['id'];
            $_SESSION['email'] = $consulta['email'];
            header("Location: ..\CopiarMidia.php");  
            $usuJaExist = false;
            $senhaInvalida = false;
        } else {
            $usuJaExist = false;
            $senhaInvalida = true;
        }        
    }
        
    if($usuJaExist){
        exibirMensagemAoUsuario("error", "Usuário não existe!");   
        header("Location: ..\Index.php");
    } else if($senhaInvalida){
        exibirMensagemAoUsuario("error", "Usuário ou Senha inválido!");    
        header("Location: ..\Index.php");
    }  