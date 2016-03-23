<?php include('conexao.php') ?>
<?php include('./import.html') ?>

    <script>
                
        $(this).ready(function () {            
            progress();           
        });
        
        function progress(){
            
            Lobibox.progress({
                title: 'Copiar Midia Sapiens',
                label: 'Copiando arquivos...',
                
                onShow: function (lolibox) {
                    var i = 0;
                    var inter = setInterval(function () {
                        if (i > 100) {
                            inter = clearInterval(inter);
                        } else if(i === 100){
                            lolibox.value = 'Sucesso';
                        }
                        i = i + 0.1;
                        lolibox.setProgress(i);                        
                    }, 1);
                }         
            });            
        }
        
    </script>

<?php
    session_start();        

    $_SESSION['cont'] = $_SESSION['cont'] + 1;
    
    $versao = $_POST['versao'];
    $release = $_POST['release'];
    
    $ultimaGerada = '';
    
    $fileDE = "\\\\" . '10.1.28.122' . "\\" . 'midia' . "\\" . 'Sapiens' . "\\" . $versao . "\\" . $release . "\\" . 'Build';
    
    $caminhoPARA = "\\\\" . 'seniorpdc' . "\\" . 'midia' . "\\" . 'Sapiens' . "\\" . $versao . "\\" . $release . "\\" . 'Liberada';
        
    $caminhoDE = $fileDE . "\\" . verificarMaiorNome($fileDE);
    
    echo $caminhoDE;
    
    copiar($caminhoDE, $caminhoPARA);
            
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
    
    
    function copiar($caminhoDE, $caminhoPARA) {
         
        /*
        if(!file_exists($caminhoPARA)){
            mkdir($caminhoPARA, 0777);
        }
        */
        if (!copy($caminhoDE, $caminhoPARA)) {            
            $_SESSION['status'] = "nok";
        } else {
            $_SESSION['status'] = "ok";            
        }
    }
    
?>