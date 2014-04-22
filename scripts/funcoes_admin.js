<!--código para confirmar a exclusão-->
function confirma_exclusao(id, nome){		
		pergunta = confirm("Deseja mesmo excluir o item " + nome + "?");		
			if(pergunta==1){
				open("excluir.php?id="+id, "_self");
			}else{
				return false;
			}		
}


$(document).ready(function (){
	
	//animação do menu de usuario
	$(".menu-usuario span").mouseenter(function(){
		$(".menu-usuario span").css({backgroundColor: '#666'});
		$(".menu-usuario").animate({height: '115px'}, 200);
	});
	$(".menu-usuario").mouseleave(function(){
		$(".menu-usuario").animate({height: '46px'}, 200);	
		$(".menu-usuario span").css({backgroundColor: '#333'});
	});
	
	
			
	//efeito de cor das linhas da tabela
	$("table tr:odd").css("background-color", "#fff");
	
	
			
    //pega o indice escolhido e recarrega a página
    $('#ordenar').change(function() {
        	document.location = 'listar.php?indice='+$('#ordenar').val()+'&busca='+$('.campo-busca').val();
    });
                    
    //se o usuário clicar no botão de busca, recarrega a página
    $('.botao-busca').click(function(){
        	document.location = 'listar.php?indice='+$('#ordenar').val()+'&busca='+$('.campo-busca').val();		  
    });
          
    //se o usuário der enter no campo de busca, recarrega a página
    $('.campo-busca').keypress(function(event){
        	if ( event.which == 13 ) {
            	document.location = 'listar.php?indice='+$('#ordenar').val()+'&busca='+$('.campo-busca').val();		  
            }
    });
	
	
	
	//inicializa a validação do formulario
	$.metadata.setType("attr", "validate");
	$(".formulario").validate();
	
	
	
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



	//CARREGA AS CATEGORIAS
	$("#tipo").change(function(){
		
		$("#categoria").html('').load("listar_categorias.php?tipo=" + $(this).val());	
	});
	
	

	//ANIMAÇÃO DAS FOTOS DOS PRODUTOS
	
		//seta as variaveis anterior e proximo
		$ant = 0;
		$prox = $('.lista-fotos li').length - 1;
		
		
		//testa se precisa da seta de proximo e dos marcadores
		if($prox <= 0){
		
			//esconde a seta da direita
			$('.dir').css({display: "none"});
			$('.marcadores').css({display: "none"});			
		}
		
		
		//quando o usuario clicar na seta da esquerda
		$('.esq').click(function(){
			
			//desloca a lista							   
			$(".lista-fotos").animate({marginLeft: '+=720px'}, 500);	
			
			//atualiza as variaveis
			$ant--;
			$prox++;

			//atualiza o marcador das fotos
			$('#'+$ant).addClass('marcador-ativo').siblings().removeClass('marcador-ativo');

			//testa se o anterior zerou
			if($ant <= 0){
				//esconde a seta da esquerda
				$('.esq').css({display: "none"});
			}
			
			//exibe a seta da direita
			$('.dir').css({display: "block"});
		});
		
		
		//quando o usuario clicar na seta da direita
		$('.dir').click(function(){
			
			//desloca a lista
			$(".lista-fotos").animate({marginLeft: '-=720px'}, 500);	
			
			//atualiza as variaveis
			$prox--;
			$ant++;
			
			//atualiza o marcador das fotos
			$('#'+$ant).addClass('marcador-ativo').siblings().removeClass('marcador-ativo');
			
			//testa se o proximo zerou
			if($prox <= 0){
				//esconde a seta da direita
				$('.dir').css({display: "none"});
			}
			
			//exibe a seta da esquerda
			$('.esq').css({display: "block"});
		});
		
		
		//quando o usuario clicar no marcador das fotos
		$(".marcadores li").click(function(){
			
			//pega o id do marcador e transforma em inteiro
			$foto = parseInt($(this).attr('id'));
			
			//atualiza o marcador das fotos
			$(this).addClass('marcador-ativo').siblings().removeClass('marcador-ativo');
			
			//clacula o deslocamento
			$margem = $foto*720;
			
			//desloca a lista
			$(".lista-fotos").animate({marginLeft: (0 - $margem)}, 500);	
			
			//atualiza as variáveis
			$ant = $foto;
			$prox = $('.lista-fotos li').length -($foto+1);
			
			//se o anterior zerou
			if($ant <= 0){
				//esconde a seta da esquerda
				$('.esq').css({display: "none"});
			}else{
				//senão exibe a seta
				$('.esq').css({display: "block"});
			}
			
			//se o proximo zerou
			if($prox <= 0){
				//esconde a seta da direita
				$('.dir').css({display: "none"});
			}else{
				//senão exibe a seta
				$('.dir').css({display: "block"});
			}
		});
	
});	