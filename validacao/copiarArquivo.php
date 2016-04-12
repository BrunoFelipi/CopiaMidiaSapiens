<?php include('Conexao.php');

    session_start();

    if(!isset($_SESSION['email']) or !isset($_SESSION['senha'])){
        header("Location: Index.php");        
    }
    
    $status = 'falha';
    $release = $_POST['release'];
    $versao = $_POST['versao'];  
    $email = $_SESSION['email'];  
    
    echo 'Status: ' . $status;
    echo '<br>Release: ' . $release;
    echo '<br>Versao: ' . $versao;
    echo '<br>Email: ' . $email;
        
    $ultimaGerada = '';
    $fileDE = "\\\\" . '10.1.28.122' . "\\" . 'midia' . "\\" . 'Sapiens' . "\\" . $versao . "\\" . $release . "\\" . 'Build';
    
    $caminhoDE = $fileDE . "\\" . verificarMaiorNome($fileDE,$email,$versao,$release);
    $caminhoPARA = '\\\\seniorpdc\\midia\\Sapiens\\' . $versao . '\\' . $release . '\\Liberada';
       
    recurse_copy($caminhoDE, $caminhoPARA, $email, $versao, $release, $status);
    
    function delete($path){
        
        if (is_dir($path) === true){
            $files = array_diff(scandir($path), array('.', '..'));

            foreach ($files as $file){
                Delete(realpath($path) . '/' . $file);
            }

            return rmdir($path);
        } else if (is_file($path) === true) {
            return unlink($path);
        }

        return false;
    }
    
    function verificarMaiorNome($caminho,$email,$versao,$release) {
    
        if(!is_dir($caminho) && !file_exists($caminho)){
            $status = 'falha';    
            exibirMensagemAoUsuario('error', 'Caminho de origem não existe!');
            header("Location: ../CopiarMidia.php");
        }
        
        $files = array_slice(scandir($caminho), 2);            
        $ultimaGerada = '';
        
        for($i = 0; $i < count($files); $i++){                            
            
            if($files[$i] > $ultimaGerada){
                $ultimaGerada = $files[$i];
            }
        }

        return $ultimaGerada;        
    }
    
    function recurse_copy($src,$dst,$email,$versao,$release) { 
        
        if(!is_dir($src) && !file_exists($src)){
            inserirInfo($email, $versao, $release, 'falha');
            exibirMensagemAoUsuario('error', 'Caminho de origem não existe!');
            header("Location: ../CopiarMidia.php");
        } else {
                    
            $caminho = "\\\\seniorpdc\\midia\\Sapiens\\" . $versao . "\\" . $release;
    
            if(is_dir($caminho)){
                delete($caminho);    
            }
                    
            $dir = opendir($src);             

            if(!file_exists($dst) && !is_dir($dst)) {
                mkdir($dst, 0777, true);
            }
            
            while(false !== ( $file = readdir($dir)) ) { 
                if (( $file != '.' ) && ( $file != '..' )) { 
                    if ( is_dir($src . '/' . $file) ) { 
                        recurse_copy($src . '/' . $file,$dst . '/' . $file,$email,$versao,$release); 
                    } else {                         
                        copy($src . '/' . $file,$dst . '/' . $file); 
                    } 
                } 
            } 
            
            closedir($dir);            
            inserirInfo($email, $versao, $release, 'sucesso');
            exibirMensagemAoUsuario('success', 'Mídia copiada com sucesso!');
            header("Location: ../CopiarMidia.php");
        }
    }
       
    function inserirInfo($email, $versao, $release, $status){
        
        date_default_timezone_set('America/Sao_Paulo');
        $maquina = gethostbyaddr($_SERVER['REMOTE_ADDR']);        
        $data = date('d-m-Y') . ' ' .date('H:i:s');

        $conecta = mysqli_connect('localhost', 'root', '','sapiens');
        $insert = "insert into info values (0, '$email', '$maquina', '$data', '$versao.$release', '$status')";
        mysqli_query($conecta, $insert);        
    }