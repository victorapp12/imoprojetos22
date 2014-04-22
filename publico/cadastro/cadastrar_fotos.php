<?php 
include '../topo/topo.php'; 

//recebe as variaveis
$id = $_REQUEST['id'];

$dados = $imo->infoProjeto($id);

//SETA A VARIÁVEL PARA CARREGAR OS SCRIPTS
$scripts = 1;
?>		

    <section class="conteudo conteudo-grande">
		
        <h2 class="form-titulo">Enviar Projeto - Passo 3</h2>
        
        <p class="form-info">Selecione as fotos de seu projeto, depois clique em enviar. Você deve selecionar no mínimo 6 e no máximo 12 fotos. Ao final, clique em concluir.</p>
        
        <?php
			//TESTA SE O PROJETO JÁ TEM TODAS AS FOTOS POSSÍVEIS. sE NÃO EXIBEO FORM DE UPLOAD
			if(count($imo->fotosProjeto($id)) < 12){ 
		?>
        
        <form action="confirma_foto.php" method="post" class="form-fotos clearfix">

	        <div class="box-cad" style="float:none; width: 100%;">
                <label for="imagem">Cadastrar Imagem <span style="font-size: 14px; color: #f00;">(Tamanho ideal: 720 x 720px)</span></label>
                <br>
                <input type="file" id="file_upload" name="imagem" /><br />
                <img id="foto"/>
                <br />
			</div>
            
            <div class="box-cad">
                <label for="credito">Crédito da foto</label>
                <br>
                <input type="text" name="credito">
                <br>
            </div>
            
            <br clear="all">
            
	        <input type="hidden" id="nomeFoto" name="nomeFoto" />  
            <input type="hidden" name="id" value="<?php echo $id; ?>" />
                
			<input type="submit" value="Enviar" class="btn btn-fotos"/>              
        </form>
		
        <?php
			}
		?>
        
        <section class="fotos-cad clearfix">
        	<h3>Fotos Cadastradas</h3>
            
            <ul>
			<?php
				$i = 0;
            	foreach($imo->fotosProjeto($id) as $item){
					
					$i++;
            ?>
            
            <li <?php echo ($i%3) ? '' : 'style="margin-right:0"'; ?>>
            
               	<img src="../../fotos/pequenas/<?php echo $item['foto']; ?>" />
                <br />
                <a class="excluir" href="remover_foto.php?id=<?php echo $id; ?>&foto=<?php echo $item['foto']; ?>">X</a>
                <span>Crédito: <em><?php echo $item['credito']; ?></em></span>
            </li>                                
            
            <?php
                }
					
				if(count($imo->fotosProjeto($id)) == 0){ 
					echo "<li><span id=obrigatorio>Este projeto ainda não possui fotos.</span></li>"; 
				}
            ?>
            
            </ul>
        </section>
        
        <?php
        	//TESTA SE O PROJETO JÁ TEM AO MENOS 6 FOTOS. SE SIM EXIBE O BOTÃO PARA CONCLUIR
			if(count($imo->fotosProjeto($id)) >= 6){
		?>
         
        <a class="btn btn-concluir" href="mensagem.php">Concluir</a>
        
        <?php
			}
		?>
        
	</section>

<?php include '../rodape/rodape.php'; ?>