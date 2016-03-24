<?php include('conexao.php') ?>
<?php include('./import.html') ?>
<?php

    session_start();        

    $_SESSION['cont'] = $_SESSION['cont'] + 1;
    
    $versao = $_POST['versao'];
    $release = $_POST['release'];
    
    $ultimaGerada = '';
    
    $fileDE = "\\\\" . '10.1.28.122' . "\\" . 'midia' . "\\" . 'Sapiens' . "\\" . $versao . "\\" . $release . "\\" . 'Build';
    
    $caminhoPARA = "\\\\" . 'seniorpdc' . "\\" . 'midia' . "\\" . 'Sapiens' . "\\" . $versao . "\\" . $release . "\\" . 'Liberada';
        
    $caminhoDE = $fileDE . "\\" . verificarMaiorNome($fileDE);
    
    echo 'DE: ' . $caminhoDE;
    echo '<br>PARA: ' . $caminhoPARA;
        
    full_copy($caminhoDE, $caminhoPARA);
            
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
    
    function full_copy($source,$target){
                        
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
                
                $_SESSION['status'] = 'ok';                    
            }

            $d->close();
            
        } else {
            
            
            if(!file_exists($target)){
                mkdir($target, 0777, true);                    
            }
            
            copy($source, $target);
            $_SESSION['status'] = 'ok';
        }
    }
    
    function copiar($caminhoDE, $caminhoPARA) {
         
        /*
        if(!file_exists($caminhoPARA)){
            mkdir($caminhoPARA, 0777);
        }
        */
        if (copy($caminhoDE, $caminhoPARA)) {            
            $_SESSION['status'] = "nok";
        } else {
            $_SESSION['status'] = "ok";            
        }
    }
    
    //header("Location: index.php");
?>