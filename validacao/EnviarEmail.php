<?php
    include('Conexao.php');

    session_start();

    $destinatario = $_POST['email'];
    
    $usuExist = false;
    
    $select = "select * from usuario where email='" . $destinatario ."'";//"' and senha='" . $senha . "'";
    $result = mysqli_query($conecta, $select);
    
    while($consulta = mysqli_fetch_array($result)){
        if($consulta["email"] === $destinatario){            
            $usuExist = true; 
            $token = $consulta['token'];
        } else {
            $usuExist = false;
        }        
    }
    
    if($usuExist === false){        
        exibirMensagemAoUsuario('error', 'Usuário não existe!');
        header("Location: ..\EsqueceuSenha.php");
    } else {                
        enviarEmail($destinatario, $token);
    }
    
    function enviarEmail($emailDestino, $token){
        
        $to  = $emailDestino;
        
        $subject = 'Esqueceu sua senha?';

        $message = '
        <html>
        <head>
          <title>Esqueceu sua senha?</title>
        </head>
        <body>
          <p>Mensagem automática, favor não responder!</p>
          
          <p><a href="http://pcbnu006300/CopiaMidiaSapiens/AlterarSenha.php?token=' . $token .'">Clique aqui</a> para alterar sua senha! </p>

        </body>
        </html>
        ';

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

        $headers .= "To: ". $to ." \r\n";
        $headers .= 'From: Copia Mídia Sapiens' . "\r\n"; 

        if(mail($to, $subject, $message, $headers)){
            exibirMensagemAoUsuario('success', 'Email enviado com sucesso!');
            header("Location: ..\Index.php");
        } else {
            exibirMensagemAoUsuario('error', 'Falha ao enviar o email!');
            header("Location: ..\EsqueceuSenha.php");
        }
    }