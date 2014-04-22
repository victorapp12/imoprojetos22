<?php include '../topo/topo.php';?>

    <section class="conteudo" id="projetos">
    	
        <span class="breadcrumb">Você está em: <strong>Projetos</strong></span>
        
        <ul class="lista-produtos clearfix">
        	
            <?php
				//RECEBE AS VARIÁVEIS SE HOUVER
				$busca = isset($_REQUEST['busca']) ? $_REQUEST['busca'] : '';
				$ano = isset($_REQUEST['ano']) ? $_REQUEST['ano'] : '';
				$profissional = isset($_REQUEST['profissional']) ? $_REQUEST['profissional'] : '';
				$tipo = isset($_REQUEST['tipo']) ? $_REQUEST['tipo'] : '';
				$categoria = isset($_REQUEST['categoria']) ? $_REQUEST['categoria'] : '';
				
				
				$i = 0;
				foreach($imo->listaProjetos($ano, $profissional, $tipo, $categoria, $busca) as $item){
					
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
			?>
            
        </ul>
    
    </section>

<?php 
$pag = 'projetos';

include '../sidebar/sidebar.php'; 

include '../rodape/rodape.php'; 
?>
