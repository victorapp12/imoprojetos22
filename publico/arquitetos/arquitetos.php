<?php include '../topo/topo.php';?>


    <section class="conteudo conteudo-texto">
    	
        <span class="breadcrumb">Você está em: <strong>Arquitetos</strong></span>
		
        <ul class="lista-arq">
        	
            <?php
				foreach($imo->listaProfissionais() as $item){
			?>
            
            <li class="clearfix">
            	<a href="../home/home.php?profissional=<?php echo $item['id']; ?>">
            		<img src="http://www.ad2editora.com.br/imoprojetos/fotos/pequenas/<?php echo $item['logo']; ?>">
                </a>
                
                <h2>
                	<a href="../home/home.php?profissional=<?php echo $item['id']; ?>">
						<?php echo $item['nome']; ?>
                    </a>
                </h2>
                
                <span><?php echo $item['cidade'] . " - " . $item['estado']; ?></span>
            </li>
            
            <?php
				}
			?>       	
            
        </ul>
	</section>

<?php 
$pag = 'arquitetos';

include '../sidebar/sidebar.php'; 

include '../rodape/rodape.php'; 
?>
