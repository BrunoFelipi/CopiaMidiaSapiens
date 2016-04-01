<?php
    include('Conexao.php');

    session_start();

    $destinatario = $_POST['email'];    
    //$destinatario = 'bruno.souza@senior.com.br';    
    
    $usuExist = true;
    
    $select = "select * from usuario where email='" . $destinatario ."'";//"' and senha='" . $senha . "'";
    $result = mysqli_query($conecta, $select);
    
    while($consulta = mysqli_fetch_array($result)){
        if($consulta["email"] === $destinatario){            
            $usuExist = true;
        } else {
            $usuExist = false;
        }        
    }
    
    if(!$usuExist){
        exibirMensagemAoUsuario('error', 'Usuário não existe!');
        header("Location: ..\EsqueceuSenha.php");
    } else {
        enviarEmail($destinatario);
    }
         
    function enviarEmail($emailDestino){
        
        $to  = $emailDestino;
        
        $subject = 'Birthday Reminders for August';

        $message = '
        <html>
        <head>
          <title>Mensagem automática, favor não responder!</title>
        </head>
        <body>
          <p>Here are the birthdays upcoming in August!</p>
          <table>
            <tr>
              <th>Person</th><th>Day</th><th>Month</th><th>Year</th>
            </tr>
            <tr>
              <td>Joe</td><td>3rd</td><td>August</td><td>1970</td>
            </tr>
            <tr>
              <td>Sally</td><td>17th</td><td>August</td><td>1973</td>
            </tr>
          </table>
        </body>
        </html>
        ';

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        $headers .= "To: ". $to ." \r\n";
        $headers .= 'From: Copia Midia Sapiens' . "\r\n"; 

        if(mail($to, $subject, $message, $headers)){
            exibirMensagemAoUsuario('success', 'Email enviado com sucesso!');
            header("Location: ..\Index.php");
        } else {
            exibirMensagemAoUsuario('error', 'Falha ao enviar o email!');
            header("Location: ..\EsqueceuSenha.php");
        }
    }