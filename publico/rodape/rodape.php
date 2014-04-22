
	<script src="../../scripts/jquery.1.9.1.js"></script>
    
    <?php
		if(isset($scripts)){
	?>
    
	<script type="text/javascript" src="../../scripts/mascara_campos.js"></script>
	<script type="text/javascript" src="../../scripts/jquery.metadata.js"></script>
    <script type="text/javascript" src="../../scripts/jquery.validate.min.js"></script>
	<script type="text/javascript" src="../../scripts/swfobject.js"></script>
    <script type="text/javascript" src="../../scripts/jquery.uploadify.v2.1.4.min.js"></script>
	<script type="text/javascript">
		$(function(){
			
			//inicializa a validação do formulario
			$.metadata.setType("attr", "validate");
			$(".form-cad").validate();
			
			
			//APLICA AS MÁSCARAS DE CAMPO
			$('.telefone')  
				.mask("(99) 9999-9999?9")  
				.on('focusout', function (event) {  
					var target, phone, element;  
					target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
					phone = target.value.replace(/\D/g, '');  
					element = $(target);  
					element.unmask();  
					if(phone.length > 10) {  
						element.mask("(99) 99999-999?9");  
					} else {  
						element.mask("(99) 9999-9999?9");  
					}  
				});  
			$('.cep').mask("99999-999");
			
			
			/*gera o nome do arquivo*/								   
			<?php
				$caracteres ="abcdefghijlkmnopqrstuvxzwy0123456789";
				$nome_arquivo = "";
				for ($i = 0; $i < 5; $i++) {
					$nome_arquivo .= $caracteres{rand(0, strlen($caracteres) - 1)};
				} 
				$nome_arquivo .= md5(date("d:m:Y:H:i:s"));
			?>
			nome = '<?php echo $nome_arquivo ?>';

			$('#file_upload').uploadify({
				'uploader'  : '../../upload/uploadify.swf',
				'script'    : 'http://www.ad2editora.com.br/imoprojetos/upload/uploadify.php?nome=' + nome,
				'cancelImg' : '../../upload/cancel.png',
				'buttonImg'    : '../../upload/btn_arquivos.png',
				'fileExt'     : '*.jpg;*.gif;*.png',
				'fileDesc'    : 'Somente imagens',
				'multi': false,
				'width':152,
				'auto': true,
				'folder'    : '../../fotos',				
				'onComplete'    : function(event,ID,fileObj) {
					/*pega a extensão do arquivo*/
					nome_arquivo = fileObj.name.split(".");
					extensao = nome_arquivo.reverse();
					
					/*seta os campos com o nome do arquivo*/
				 	$('#foto').css({display: "block"});
					$('#foto').attr('src','../../fotos/pequenas/' + nome + '.' + extensao[0]);
					$('#nomeFoto').attr('value',nome + '.' + extensao[0]);					
			    }				
			});
		});
	</script>
    
	<?php
		}
	?>
    
	<script type="text/javascript" src="../../scripts/funcoes.js"></script>

</div>
</body>
</html>