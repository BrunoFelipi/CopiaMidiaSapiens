<?php include('conexao.php') ?>
<?php include('import.html') ?>

<?php

    session_start();

    if(empty($_SESSION['id']) or empty($_SESSION['email'])){
        session_destroy();
        header("Location: ..\login.php"); 
    }

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $select = "select * from usuario where email='" . $email ."'";
    
    $result = mysqli_query($conecta, $select);
    
    while($consulta = mysqli_fetch_array($result)){

        if($consulta["senha"] === $senha){
            session_start();
            $_SESSION['id'] = $consulta['id'];
            $_SESSION['email'] = $consulta['email'];
            header("Location: ..\consulta.php"); 
        }
        
    }
    
    $_SESSION['status'] = 'UsuarioNaoCadastrado';
    header("Location: ..\login.php");
    
    

?>