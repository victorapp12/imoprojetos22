<?php

include '../../classes/publico.class.php';
$imo = new Publico();

//RECEBE AS VARIÁVEIS
if(isset($_REQUEST['busca'])){
	
	$busca = $_REQUEST['busca'];
	
	$dados = $imo->listaProjetos('', '', '', '', $busca);
}
else{
	$ano = $_REQUEST['ano'];
	$profissional = $_REQUEST['profissional'];
	$tipo = $_REQUEST['tipo'];
	$categoria = $_REQUEST['categoria'];
	
	$dados = $imo->listaProjetos($ano, $profissional, $tipo, $categoria);
}

$i = 0;

foreach($dados as $item){
	
	$i++;
	
	if($i == 2 or !($i%3)){
		$classe = 'class="sem-margem"';
	}
	else{
		$classe = '';
	}
?>

            <li <?php echo $classe; ?>>
            	<figure class="clearfix">
                	<a class="link-imagem" href="visualiza.php?id=<?php echo $item['id']; ?>">
                    
                		<img src="http://www.ad2editora.com.br/imoprojetos/fotos/<?php echo ($i == 1) ? 'grandes' : 'pequenas'; ?>/<?php echo $item['foto']; ?>" alt="<?php echo $item['foto']; ?>">
                    </a>
                    
                    <figcaption>
                    	
                            <h2><?php echo $item['nome']; ?></h2>
                            <span>por <?php echo $item['profissional']; ?></span>
                        
                    </figcaption>
                </figure>
			</li>
<?php
}

//TESTA SE NÃO ACHOU NADA
if($i == 0){
	
	echo '<span class="sem-projeto">Nenhum projeto encontrado.</span>';	
}
?>
