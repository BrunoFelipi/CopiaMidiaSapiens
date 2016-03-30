<?php include('conexao.php');

    $versao = $_POST['versao'];
    $release = $_POST['release'];
    
    $ultimaGerada = '';
    
    $fileDE = "\\\\" . '10.1.28.122' . "\\" . 'midia' . "\\" . 'Sapiens' . "\\" . $versao . "\\" . $release . "\\" . 'Build';
    
    //$caminhoPARA = "\\\\" . 'seniorpdc' . "\\" . 'midia' . "\\" . 'Sapiens' . "\\" . $versao . "\\" . $release . "\\" . 'Liberada';
      
    //$caminhoPARA = "\\\\" . 'seniorpdc' . "\\" . 'Usuarios' . "\\" . 'BrunoSouza' . "\\" . '200';
    
    $caminhoPARA = "C:\\200";
    
    $caminhoDE = $fileDE . "\\" . verificarMaiorNome($fileDE);
      
    echo 'DE: ' . $caminhoDE;
    echo '<br>PARA: ' . $caminhoPARA;
    
    cpy($caminhoDE, $caminhoPARA);
    //full_copy($caminhoDE, $caminhoPARA);
            
    function verificarMaiorNome($caminho) {
    
        $files = array_slice(scandir($caminho), 2);            
        $ultimaGerada = '';
        
        for($i = 0; $i < count($files); $i++){                            
            
            if($files[$i] > $ultimaGerada){
                $ultimaGerada = $files[$i];
            }
        }

        return $ultimaGerada;
    }
    
    function cpy($source, $dest){
                      
        //chmod('\\\\seniorpdc\\', 0777);
        if (!file_exists($dest) && !is_dir($dest)) {            
            mkdir($dest, 777, true);         
        } 
        
        if(true){
            if(is_dir($source)) {        
                $dir_handle=opendir($source);
                while($file=readdir($dir_handle)){
                    if($file!="." && $file!=".."){
                        if(is_dir($source."/".$file)){
                            if(!is_dir($dest."/".$file)){
                                mkdir($dest."/".$file, 0700, true);
                            }
                            cpy($source."/".$file, $dest."/".$file);
                        } else {
                            copy($source."/".$file, $dest."/".$file);
                        }
                    }
                }
                closedir($dir_handle);
            } else {
                copy($source, $dest);
            }
            
            exibirMensagemAoUsuario('success', 'Mídia copiada com sucesso!');
            header("Location: ../CopiarMidia.php");
        }
    }
    
    function full_copy($source,$target){
        
        if(!file_exists($source)){            
            //exibirMensagemAoUsuario('error', 'Caminho da mídia não existe!');
            $_SESSION['versao'] = $_POST['versao'];
            $_SESSION['release'] = $_POST['release'];            
            header("Location: ../CopiarMidia.php");
        } else {

            if(is_dir($source)){

                @mkdir($target);
                $d = dir($source);

                while(TRUE == ($entry = $d->read())){

                    if($entry == '.' || $entry == '..') {
                        continue;
                    }

                    $Entry = $source . '/' . $entry; 

                    if(is_dir($Entry)){
                        full_copy($Entry, $target . '/' . $entry);
                        continue;
                    }

                    copy($Entry, $target . '/' . $entry);

                    //exibirMensagemAoUsuario('success', 'Mídia copiada com sucesso!');                    
                }

                $d->close();

            } else {
                copy($source, $target);                
            }

            //exibirMensagemAoUsuario('success', 'Mídia copiada com sucesso!');            
        }
    }
    
    //header("Location: ../CopiarMidia.php");