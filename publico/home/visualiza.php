<?php 

include '../topo/topo.php'; 

$dados = $imo->infoProjeto($_REQUEST['id']);
$dados_fotos = $imo->fotosProjeto($_REQUEST['id']);
?>

    <section class="conteudo">
		
        <article class="info-projeto">
        	
            <a class="voltar" href="#">&larr; Voltar</a>
            
            <span class="info-tipo"><?php echo $dados['nome_tipo'] . " / " . $dados['nome_categoria']; ?></span>
    
            <h2 class="info-titulo"><?php echo $dados['nome']; ?></h2>
            
            <span>
				<?php echo $dados['ano']; ?><em>, por <?php echo $dados['profissional']; ?></em>
            </span>
                    
            <p><?php echo $dados['descricao']; ?></p>
          
        </article>
        
        <aside class="box-fotos">
        	
            <span class="esq"><</span>
            
            <ul class="lista-fotos clearfix" style="width:<?php echo count($dados_fotos) * 580; ?>px">
        	
			<?php
				$cont = 0;
				foreach($dados_fotos as $item){
					
					$cont++;
			?>
            
            <li>
            	<img src="http://www.ad2editora.com.br/imoprojetos/fotos/grandes/<?php echo $item['foto']; ?>" alt="<?php echo $item['foto']; ?>"> 
                <br>
                <?php 
					if($item['credito'] != ''){
						echo '<span>Crédito da foto: <em>' . $item['credito'] . '</em></span>';
					}
				?>
            </li>
            
            <?php
				}
			?>
            
            </ul>
            
            <span class="dir">></span>
            
            <ul class="marcadores">
            
            <?php			
				for($i = 0; $i < $cont; $i++){
			?>
            
            <li id="<?php echo $i; ?>" <?php echo ($i == 0) ? 'class="marcador-ativo"' : ''; ?>>
            
				<span class="oculto"><?php echo $i; ?></span>
            </li>
            
            <?php
				}
			?>
            
            </ul>
            
        </aside>    
	</section>

<?php 
$pag = 'projetos';

include '../sidebar/sidebar.php'; 

include '../rodape/rodape.php'; 
?>
