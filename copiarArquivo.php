<?php include('conexao.php') ?>
    
<?php
    session_start();
    
    $versao = $_POST['versao'];
    $release = $_POST['release'];
    
    $caminho = "\\\\" . '10.1.28.122' . "\\" . 'midia' . "\\" . 'Sapiens' . "\\" . $versao . "\\" . $release . "\\" . 'Build';
    echo $caminho;
?>
    
<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>        
<link rel="stylesheet" href="lobibox-master/dist/css/LobiBox.min.css">
<script src="lobibox-master/dist/js/lobibox.min.js"></script>

<script type="text/javascript">    
    
    var notify = Lobibox.notify('Success',{
        title: 'Show',
        img: 'erp.png';        
        msg: 'Arquivos copiados com sucesso'            
    });
    
    window.onbeforeunload = function(){        
        notify.show();        
    } 
    
</script>

<?php    
    header("Location: inserirAcao.php");
?>