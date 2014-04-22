$(function(){
	
	//CARREGA AS CATEGORIAS QUANDO SELECIONAR O TIPO
	$("#tipo li").click(function(){
		
		$("#categoria .item-escolhido").text("Selecione").attr('id', '');
		$("#categoria ul").html('').load("../topo/listar_categorias.php?tipo=" + $(this).text());	
	});	
	
	
	
	//MARCA O ITEM SELECIONADO PELO USUARIO NOS FILTROS
	$(".box-filtro").on('click', 'li', function(){
		
		//TESTA SE ESTÁ NA HOME
		if($('.conteudo').attr('id') == 'projetos'){
				
			//MARCA O ITEM ESCOLHIDO
			$(this).parents(".box-filtro").find(".item-escolhido").text($(this).text()).attr('id', $(this).attr('id'));
			
			//ESCONDE A LISTA DE PROJETOS, INSERE O LOADER E CARREGA A LISTA FILTRADA
			$('.conteudo ul').fadeOut('fast').html('').parent('.conteudo').delay('300').queue(function(){
				
				//MONTA A VARIÁVEL COM OS VALORES DOS FILTROS
				var filtros = 'ano=' + $('#ano .item-escolhido').attr('id') + '&profissional=' + $('#profissional .item-escolhido').attr('id') + '&tipo=' + $('#tipo .item-escolhido').attr('id') + '&categoria=' + $('#categoria .item-escolhido').attr('id');
				
				//INSERE O LOADER E CARREGA A LISTA FILTRADA
				$(this).prepend('<span class="loader-produtos"><img src="../../imagens/loader.GIF" /></span>').find('ul').load('produtos.php?' + filtros);
			}).dequeue();
			
					
			//QUANDO O CARREGAMENTO TERMINAR, REMOVE O LOADER E EXIBE A LISTA
			$(document).ajaxComplete(function(){
				
				$('.loader-produtos').delay('300').fadeOut().queue(function(){
					$(this).remove();
				}).dequeue();
				
				$('.conteudo ul').delay('300').fadeIn('fast');			
			});
		}
		else{
			var busca = $(this).parents(".box-filtro").attr("id") + "=" + $(this).attr('id');
			document.location = "../home/home.php?" + busca;	
		}
				
	});
	
	
	
	//CARREGA OS PRODUTOS DE ACORDO COM A BUSCA ABERTA
	$('.form-busca').submit(function(e){
		e.preventDefault();				
		
		var busca = $('.form-busca input[type=text]').val();
			
		//TESTA SE SE HÁ UM TERMO DE BUSCA
		if(busca != '' && busca != 'BUSCA'){
			
			//TESTA SE ESTÁ NA HOME
			if($('.conteudo').attr('id') == 'projetos'){
				
				//ESCONDE A LISTA DE PROJETOS, INSERE O LOADER E CARREGA A LISTA FILTRADA
				$('.conteudo ul').fadeOut('fast').html('').parent('.conteudo').delay('300').queue(function(){
							
					//INSERE O LOADER E CARREGA A LISTA FILTRADA
					$(this).prepend('<span class="loader-produtos"><img src="../../imagens/loader.GIF" /></span>').find('ul').load('produtos.php?busca=' + busca);
				}).dequeue();
				
				//QUANDO O CARREGAMENTO TERMINAR, REMOVE O LOADER E EXIBE A LISTA
				$(document).ajaxComplete(function(){
					
					$('.loader-produtos').delay('300').fadeOut().queue(function(){
						$(this).remove();
					}).dequeue();
					
					$('.conteudo ul').delay('300').fadeIn('fast');	
						
				});
			}
			else{
				document.location = "../home/home.php?busca=" + busca;	
			}
		}
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
			$(".lista-fotos").animate({marginLeft: '+=580px'}, 500);	
			
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
			$(".lista-fotos").animate({marginLeft: '-=580px'}, 500);	
			
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
			$margem = $foto*580;
			
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



	//CÓDIGO DO BOTÃO VOLTAR
	$('.voltar').click(function(e){
		e.preventDefault();
		
		history.back(-1);	
	});	
	
	
	
	//CARREGA AS CATEGORIAS
	$("#tipo").change(function(){
		
		$("#categoria").html('').load("listar_categorias.php?tipo=" + $(this).val());	
	});

	
	
	//PEGA OS DADOS DO USUÁRIO QUANDO ELE SELECIONAR O NOME
	$('.seleciona-nome').change(function(){
		
		$('.box-seleciona-nome').append('<span class="loader-profi"><img src="../../imagens/loader.GIF" /></span>');
		
		$profi = $(this).val();
		
		//POSTA OS DADOS, PEGA O JSON RETORNADO E EXECUTA A FUNÇÃO
		$.post("pesquisa_profissionais.php", {profissional: $profi}, function(data){
				
				//SE HOUVER UM ERRO
				if(data.erro == 'sim'){
					
					//EXIBE A MENSAGEM
					$('.loader-profi').text(data.msg);
					
					//LIMPA O FORM
					$('.form-cad input[type=text], .form-cad select').val('');
					
				}
				else{
					$('.loader-profi').remove();
					
					//SE NÃO PREENCHE O FORM COM OS DADOS DO USUÁRIO
					$('.form-cad input[name=nome]').val(data.nome);	
					$('.form-cad input[name=endereco]').val(data.endereco);	
					$('.form-cad input[name=complemento]').val(data.complemento);	
					$('.form-cad input[name=bairro]').val(data.bairro);	
					$('.form-cad input[name=cidade]').val(data.cidade);	
					$('.form-cad select[name=estado]').val(data.estado);	
					$('.form-cad input[name=cep]').val(data.cep);	
					$('.form-cad input[name=email]').val(data.email);	
					$('.form-cad input[name=telefone]').val(data.telefone);	
					$('.form-cad input[name=site]').val(data.site);	
					$('.form-cad input[name=id]').val(data.id);
					$('.form-cad input[name=nomeFoto]').val(data.logo);
					
					$('#foto').attr('src', '../../fotos/pequenas/' + data.logo).css({display: "block"});
				}
		}, "json");	
			
	});
	
	
	
	//LIMITA O NÚMERO DE CARACTERES DO TEXTAREA
	$('#descricao').keyup(function(){
		
		if($(this).val().length > 500){

			$(this).val($(this).val().substring(0, 500));	
		}
		else{
			$('#contador strong').text(500 - $(this).val().length);
		}
	});
	
	
	
	//EFEITO DO BOTÃO DE PESQUISA
	$('.form-busca input[type=text]').focus(function(){
		if (this.value == 'BUSCA') {
			this.value = '';
		}				
	});
				
	$('.form-busca input[type=text]').blur(function(){
		if (this.value == '') {
			this.value = 'BUSCA';
		}
	});
	
	
});