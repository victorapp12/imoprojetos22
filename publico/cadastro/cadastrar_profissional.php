<?php 

include '../topo/topo.php'; 

//SETA A VARIÁVEL PARA CARREGAR OS SCRIPTS
$scripts = 1;
?>

    <section class="conteudo conteudo-grande">
		
        <h2 class="form-titulo">Enviar Projeto - Passo 1</h2>
        
        <br>
        <p class="form-info">Se você já enviou algum projeto selecione seu nome na lista abaixo.</p>
        
        
        <section class="box-seleciona-nome clearfix">
                
            <select class="seleciona-nome" name="nome_profissional">
                <option value="">Selecione:</option>
                
                <?php
                    foreach($imo->listaTodosProfissionais() as $profi){
                ?>
                            
                <option value="<?php echo $profi['id']; ?>"><?php echo $profi['nome']; ?></option>
                                        
                <?php
                    }
                ?>
            </select>
        </section>
        
        
        <p class="form-info">Senão, preencha o formulário com seus dados pessoais.</p>
        
        <form action="confirma_profissional.php" method="post" class="form-cad clearfix">
        	
            <div class="box-cad" style="width:100%;">
                <label for="nome">Nome <span class="obrigatorio">*</span></label>
                <br>
                <input type="text" name="nome" validate="required:true">
                <br>
            </div>
            
            <div class="box-cad">
                <label for="endereco">Endereço <span class="obrigatorio">*</span></label>
                <br>
                <input type="text" name="endereco" validate="required:true">
                <br>
            </div>
            
            <div class="box-cad">
                <label for="complemento">Complemento</label>
                <br>
                <input type="text" name="complemento">
                <br>
            </div>
            
            <div class="box-cad">
                <label for="bairro">Bairro <span class="obrigatorio">*</span></label>
                <br>
                <input type="text" name="bairro" validate="required:true">
                <br>
            </div>
            
            <div class="box-cad">
                <label for="cidade">Cidade <span class="obrigatorio">*</span></label>
                <br>
                <input type="text" name="cidade" validate="required:true">
                <br>
            </div>
            
            <div class="box-cad">
                <label for="estado">Estado <span class="obrigatorio">*</span></label>
                <br>
                <select name="estado" validate="required:true">
                	         	<option value="">Selecione:</option>
                                <option value="AC">AC</option>
                                <option value="AL">AL</option>
                                <option value="AM">AM</option>
                                <option value="AP">AP</option>
                                <option value="BA">BA</option>
                                <option value="CE">CE</option>
                                <option value="DF">DF</option>
                                <option value="ES">ES</option>
                                <option value="GO">GO</option>
                                <option value="MA">MA</option>
                                <option value="MG">MG</option>
                                <option value="MS">MS</option>
                                <option value="MT">MT</option>
                                <option value="PA">PA</option>
                                <option value="PB">PB</option>
                                <option value="PE">PE</option>
                                <option value="PI">PI</option>
                                <option value="PR">PR</option>
                                <option value="RJ">RJ</option>
                                <option value="RN">RN</option>
                                <option value="RO">RO</option>
                                <option value="RR">RR</option>
                                <option value="RS">RS</option>
                                <option value="SC">SC</option>
                                <option value="SE">SE</option>
                                <option value="SP">SP</option>
                                <option value="TO">TO</option>
                </select>
                <br>
            </div>
            
            <div class="box-cad">
                <label for="cep">CEP <span class="obrigatorio">*</span></label>
                <br>
                <input type="text" name="cep" class="cep" validate="required:true">
                <br>
            </div>
            
            <div class="box-cad">
                <label for="telefone">Telefone <span class="obrigatorio">*</span></label>
                <br>
                <input type="text" name="telefone" class="telefone" validate="required:true">
                <br>
            </div>
            
            <div class="box-cad">
                <label for="email">Email <span class="obrigatorio">*</span></label>
                <br>
                <input type="text" name="email" validate="required:true, email:true">
                <br>
			</div>
                        
            <div class="box-cad">
                <label for="site">Site</label>
                <br>
                <input type="text" name="site">
                <br>
			</div>
            
            <div class="box-cad">
                <label for="logo">Logo</label>
                <br>
                <input type="file" id="file_upload" name="logo" />
                <input type="hidden" id="nomeFoto" name="nomeFoto" />  
                <img id="foto" style="border: 1px solid; max-width:105px; height:auto; display:none;" />
                <br>
            </div>
            
            <input type="hidden" name="id" value="">
            
            <input type="submit" value="Próximo &rarr;" class="btn">            
        </form>
                		
	</section>

<?php include '../rodape/rodape.php'; ?>