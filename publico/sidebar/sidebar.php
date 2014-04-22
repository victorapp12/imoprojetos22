    <section class="sidebar clearfix">
    
    	<nav class="menu">
        	<ul>
            	<li>
                	<a <?php echo ($pag == 'projetos') ? 'class="ativo"' : ''; ?> href="../home/home.php">Projetos</a>
                </li>
                            
            	<li>
                	<a <?php echo ($pag == 'sobre') ? 'class="ativo"' : ''; ?> href="../sobre/sobre.php">Sobre</a>
                </li>
                            
            	<li>
                	<a <?php echo ($pag == 'como_funciona') ? 'class="ativo"' : ''; ?> href="../sobre/como_funciona.php">Como funciona?</a>
                </li>
                            
            	<li>
                	<a <?php echo ($pag == 'arquitetos') ? 'class="ativo"' : ''; ?> href="../arquitetos/arquitetos.php">Arquitetos</a>
                </li>
                            
            	<li>
                	<a <?php echo ($pag == 'cadastro') ? 'class="ativo"' : ''; ?> href="http://www.ad2editora.com.br/imoprojetos/publico/cadastro/cadastrar_profissional.php" target="_blank">Envie seu projeto</a>
                </li>
                            
            </ul>
        </nav>
        
        
        <form method="post" action="#" class="form-busca">
        	<input type="text" name="busca" value="BUSCA">
            <input type="submit" value="">
        </form>
        
        
        	<div class="item-filtro" style="z-index:5">

	             <div class="box-filtro" id="ano">
                	<span class="item-escolhido" id="">Ano</span>

                    <ul>
                        <li id="">Todos</li>
                        
                        <?php
                            foreach($imo->listaAnos() as $ano){
                        ?>
                        
                        <li id="<?php echo $ano; ?>"><?php echo $ano; ?></li>
                        
                        <?php
                            }
                        ?>
                    </ul>
                </div>
			</div>
            
            <div class="item-filtro" style="z-index:4">
                
                <div class="box-filtro" id="profissional">
                	<span class="item-escolhido" id="">Profissional</span>
                    <ul id="profissionais">
                        <li id="">Todos</li>
                        
                        <?php
                            foreach($imo->listaProfissionais() as $profi){
                        ?>
                        
                        <li id="<?php echo $profi['id']; ?>"><?php echo $profi['nome']; ?></li>
                        
                        <?php
                            }
                        ?>
                    </ul>
            	</div>
			</div>
            
            <div class="item-filtro" style="z-index:3">
                
                <div class="box-filtro" id="tipo">
                	<span class="item-escolhido" id="">Tipo</span>
                    <ul>
                        <li id="">Todos</li>
                        <li id="1">Residenciais</li>
                        <li id="2">Comerciais</li>
                        <li id="3">Públicos</li>
                    </ul>
				</div>
            </div>
            
            <div class="item-filtro" style="z-index:2">
                
                <div class="box-filtro" id="categoria">
                	<span class="item-escolhido" id="">Categoria</span>
                    <ul>
                        <li id="">Todos</li>
                    </ul>
            	</div>
            </div>
            
	</section>        
