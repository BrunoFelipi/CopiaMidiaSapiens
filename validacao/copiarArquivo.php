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
                       
        if(!file_exists($source)){
            $_SESSION['status'] = 'CaminhoNaoExiste';
            $_SESSION['versao'] = $_POST['versao'];
            $_SESSION['release'] = $_POST['release'];
            $_SESSION['cadastrou'] = 'ok'; 
            header("Location: index.php");
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

                    $_SESSION['status'] = 'MidiaCopiada';                    
                }

                $d->close();

            } else {

                if(!file_exists($target)){
                    mkdir($target, 0777, true);                    
                }

                copy($source, $target);
                $_SESSION['status'] = 'MidiaCopiada';
            }
        }
    }
    
    header("Location: index.php");
?>