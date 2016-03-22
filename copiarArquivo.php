<?php include('conexao.php') ?>
    
<?php
    session_start();
    
    if($_SESSION['sessao'] != 'conectado'){
        session_unset();
        session_destroy();
        header("Location: index.php");
    }
    
    $versao = $_POST['versao'];
    $release = $_POST['release'];
    
    $caminhoDE = "\\\\" . '10.1.28.122' . "\\" . 'midia' . "\\" . 'Sapiens' . "\\" . $versao . "\\" . $release . "\\" . 'Build';
    echo $caminhoDE;
?>
    
<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>        
<link rel="stylesheet" href="lobibox-master/dist/css/LobiBox.min.css">
<script src="lobibox-master/dist/js/lobibox.min.js"></script>

<script type="text/javascript">    
    
    function teste($status){
                
        if($status === 'ok'){
            Lobibox.notify('success', {
                size: 'mini',
                img: 'sa.png' ,
                msg: 'Arquivos copiados com sucesso.<br>de: <?php $caminhoDE ?>',
                sound: true
            });
        } else {
            Lobibox.notify('error', {
                size: 'mini',
                img: 'sa.png' ,
                msg: 'Erro ao copiar os arquivos'
            });
        }
    }

    window.onload = function (){
        teste('ok');
    }
    
</script>

<?php    
    //header("Location: inserirAcao.php");
?>