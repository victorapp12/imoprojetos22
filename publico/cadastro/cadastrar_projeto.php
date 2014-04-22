<?php 

include '../topo/topo.php'; 

//SETA A VARIÁVEL PARA CARREGAR OS SCRIPTS
$scripts = 1;
?>

    <section class="conteudo conteudo-grande">
		
        <h2 class="form-titulo">Enviar Projeto - Passo 2</h2>
        
        <p class="form-info">Preencha o formulário abaixo com os dados de seu projeto.</p>
        
        <form action="confirma_projeto.php" method="post" class="form-cad clearfix">
        	
            <div class="box-cad" style="width:100%;">
                <label for="nome">Nome do Projeto <span class="obrigatorio">*</span></label>
                <br>
                <input type="text" name="nome" validate="required:true">
                <br>
            </div>
            
            <div class="box-cad">
                <label for="ano">Ano <span class="obrigatorio">*</span></label>
                <br>
                <input type="text" name="ano" validate="required:true">
                <br>
            </div>
            
            <div class="box-cad">
                <label for="tipo">Tipo <span class="obrigatorio">*</span></label>
                <br>
                <select name="tipo" id="tipo" validate="required:true">
                	<option value="">Selecione:</option>
                	<option value="1">Projetos Residenciais</option>
                	<option value="2">Projetos Comerciais</option>
                	<option value="3">Projetos Públicos</option>                                
                </select>
                <br>
            </div>
            
            <div class="box-cad">
                <label for="categoria">Categoria <span class="obrigatorio">*</span></label>
                <br>
                <select name="categoria" id="categoria" validate="required:true">
                	<option value="">Selecione:</option>
                </select>
                <br>
            </div>
            
            <div class="box-cad" style="width:100%;">
                <label for="descricao">Descrição <span class="obrigatorio">*</span></label>
                <span id="contador">
                	<strong>500</strong>
                    caracteres restantes
                </span>
                <br>
                <textarea name="descricao" id="descricao" validate="required:true"></textarea>
                <br>
            </div>
            
            <input type="hidden" name="profissional" value="<?php echo $_REQUEST['id']; ?>">
            
            <input type="submit" value="Próximo &rarr;" class="btn">            
        </form>
                		
	</section>

<?php include '../rodape/rodape.php'; ?>