<?php

class Imoprojetos{
	
	
	//CONSTRUTOR
	public function __construct(){
		include("../../config/conexao.php");		
	}
	
	
	
	//#######################################################
	//
	//FUNÇÕES DE PROFISSIONAIS
	//
	//#######################################################
	
	//CRIA OS PROFISSIONAIS
	public function criarProfissional($nome, $telefone, $endereco, $complemento, $bairro, $cep, $cidade, $estado, $email, $site, $logo){
		
		$sql = mysql_query("insert into profissionais(nome, telefone, endereco, complemento, bairro, cep, cidade, estado, email, site, logo) values('$nome', '$telefone', '$endereco', '$complemento', '$bairro', '$cep', '$cidade', '$estado', '$email', '$site', $logo)");
		
		if($sql){
			return true;	
		}
		else{
			return false;
		}
	}



	//EDITA OS PROFISSIONAIS
	public function editarProfissional($nome, $telefone, $endereco, $complemento, $bairro, $cep, $cidade, $estado, $email, $site, $id, $logo){
		
		$sql = mysql_query("update profissionais set nome = '$nome',
													telefone = '$telefone',
													endereco = '$endereco',
													complemento = '$complemento',
													bairro = '$bairro',
													cep = '$cep',
													cidade = '$cidade',
													estado = '$estado',													 
													email = '$email', 
													site = '$site',
													logo = '$logo'
												where 
													id = '$id'
												");
			
		if($sql){
			return true;	
		}
		else{
			return false;
		}
	}



	//REMOVE PROFISSIONAIS
	public function removerProfissional($id){
		
		$sql = mysql_query("delete from profissionais where id = '$id'");
		
		if($sql){
			
			//LISTA OS PROJETOS DELE
			$sql2 = mysql_query("select id from projetos where id_profissional = '$id'");
			while($dados = mysql_fetch_array($sql2)){
				
				//LISTA AS FOTOS DO PROJETO
				$sql3 = mysql_query("select foto from fotos where id_projeto = '$dados[id]'");	
				while($dados_fotos = mysql_fetch_array($sql3)){
					
					//REMOVE AS FOTOS DO PROJETO
					unlink('../../fotos/pequenas/' . $dados_fotos['foto']);	
					unlink('../../fotos/medias/' . $dados_fotos['foto']);	
					unlink('../../fotos/grandes/' . $dados_fotos['foto']);	
				}
				
				//LIMPA A TABELA DE FOTOS
				mysql_query("delete from fotos where id_projeto = '$dados[id]'");
			}
			
			//REMOVE OS PROJETOS DELE
			mysql_query("delete from projetos where id = '$dados[id]'");
			
			return true;	
		}
		else{
			return false;
		}
	}



	//LISTA PROFISSIONAIS
	public function listarProfissionais($indice, $busca){
		
		if($indice == '' or $indice == 'nome'){
			$indice = 'profissionais.nome asc';	
		}
		else if($indice == 'id'){
			$indice = 'profissionais.id desc';	
		}
			
		
		$i = 0;
		$dados = array();
		
		$sql = mysql_query("select 
						   		profissionais.id,
								profissionais.nome,
								profissionais.email,
								profissionais.telefone
							from
								profissionais
							where
								profissionais.nome like '%$busca%'
							or
								profissionais.email like '%$busca%'
							order by
								$indice
							");
		
		while($rs = mysql_fetch_array($sql)){
			
			$dados[$i]['id'] = $rs['id'];
			$dados[$i]['nome'] = $rs['nome'];
			$dados[$i]['email'] = $rs['email'];
			$dados[$i]['telefone'] = $rs['telefone'];
			
			$i++;
		}
		
		return $dados;
	}



	//VISUALIZA PROFISSIONAIS
	public function infoProfissional($id){
		
		$sql = mysql_query("select * from profissionais where id = '$id'");
		
		$dados = mysql_fetch_array($sql);

		return $dados;
	}


	
	

	//#######################################################
	//
	//FUNÇÕES DE PROJETOS
	//
	//#######################################################
	
	//CRIA OS PROJETOS
	public function criarProjeto($nome, $ano, $tipo, $categoria, $profissional, $descricao, $status = 'Ativo', $email = 1){
		
		$sql = mysql_query("insert into projetos(id_profissional, nome, descricao, ano, tipo, categoria, status) values('$profissional', '$nome', '$descricao', '$ano', '$tipo', '$categoria', '$status')");
		
		if($sql){
			
			if($email == 1){
				
				//SETA A MSG
				$msg = 'Um novo projeto foi cadastrado no Imoprojetos e aguarda sua aprovação.';
			
				//ENVIA O EMAIL
				$this->envia_email('Produtor(a)', $msg, 'josiane@ad2editora.com.br', 'Novo projeto no Imoprojetos');
					
			}
			
			return true;	
		}
		else{
			return false;
		}
	}



	//EDITA O PROJETO
	public function editarProjeto($id, $nome, $ano, $tipo, $categoria, $profissional, $descricao, $status){
		
		$sql = mysql_query("update projetos set id_profissional = '$profissional',
												nome = '$nome', 
												descricao = '$descricao',
												ano = '$ano',
												tipo = '$tipo',
												categoria = '$categoria',
												status = '$status' 
											where
												id = '$id'
											");

		if($sql){
			return true;	
		}
		else{
			return false;
		}
	}



	//REMOVE A PROJETO
	public function removerProjeto($id){
		
		//LISTA AS FOTOS DO PROJETO
		$sql = mysql_query("select foto from fotos where id_projeto = '$id'");
		while($dados_fotos = mysql_fetch_array($sql)){
			
			//REMOVE AS FOTOS DO PROJETO
			unlink('../../fotos/pequenas/' . $dados_fotos['foto']);	
			unlink('../../fotos/medias/' . $dados_fotos['foto']);	
			unlink('../../fotos/grandes/' . $dados_fotos['foto']);	
		}
		
		//LIMPA NO BANCO
		$sql2 = mysql_query("delete from fotos where id_projeto = '$id'");
		$sql3 = mysql_query("delete from projetos where id = '$id'");
		
		if($sql3){
			return true;	
		}
		else{
			return false;
		}
	}



	//LISTA OS PROJETOS
	public function listarProjetos($indice, $busca){
		
		if($indice == '' or $indice == 'nome'){
			$indice = 'projetos.nome asc';
		}
		else if($indice == 'profissional'){
			$indice = 'profissionais.nome asc';
		}
		else if($indice == 'id'){
			$indice = 'projetos.id desc';
		}
		else{
			$indice = 'projetos.' . $indice;
		}
		
		$i = 0;
		$dados = array();
		
		$sql = mysql_query("select 
						   		projetos.*,
								profissionais.nome as profissional
							from
								projetos,
								profissionais 								
							where( 
								projetos.nome like '%$busca%'
							or
								projetos.ano like '%$busca%'
							or
								projetos.status like '%$busca%'
							or
								profissionais.nome like '%$busca%'
							)
							and
								profissionais.id = projetos.id_profissional
							order by 
								$indice
							");
		
		while($rs = mysql_fetch_array($sql)){
			
			$dados[$i]['id'] = $rs['id'];
			$dados[$i]['nome'] = $rs['nome'];
			$dados[$i]['status'] = $rs['status'];
			$dados[$i]['profissional'] = $rs['profissional'];
			$dados[$i]['ano'] = $rs['ano'];
			
			$i++;
		}
		
		return $dados;
	}



	//VISUALIZA O PROJETO
	public function infoProjeto($id){
		
		$dados = array();
		
		$sql = mysql_query("select 
								projetos.*,
								profissionais.nome as profissional
							from
								projetos,
								profissionais
							where 
								projetos.id = '$id'
							and
								profissionais.id = projetos.id_profissional
							");
		
		$dados = mysql_fetch_array($sql);
		
		switch($dados['tipo']){
			
			case 1:
				$dados['nome_tipo'] = 'Projetos Residenciais';
				break;
					
			case 2:
				$dados['nome_tipo'] = 'Projetos Comerciais';
				break;
					
			case 3:
				$dados['nome_tipo'] = 'Projetos Públicos';
				break;
		}
			
					
		switch($dados['categoria']){
			
			case 1:
				$dados['nome_categoria'] = 'Casas';
				break;
					
			case 2:
				$dados['nome_categoria'] = 'Apartamentos';
				break;
					
			case 3:
				$dados['nome_categoria'] = 'Outros';
				break;
					
			case 4:
				$dados['nome_categoria'] = 'Corporativos';
				break;
					
			case 5:
				$dados['nome_categoria'] = 'Comércio';
				break;
					
			case 6:
				$dados['nome_categoria'] = 'Outros';
				break;
					
			case 7:
				$dados['nome_categoria'] = 'Outros';
				break;
		}
					
		return $dados;
	}
	
	
	
	//LISTAR FOTOS
	public function listarFotos($id){
		
		$i = 0;
		$dados = array();
		
		$sql = mysql_query("select * from fotos where id_projeto = '$id'");
		while($rs = mysql_fetch_array($sql)){
			
			$dados[$i]['id'] = $rs['id'];
			$dados[$i]['foto'] = $rs['foto'];
			$dados[$i]['credito'] = $rs['credito'];
			
			$i++;
		}
		
		return $dados;
	}
	
	
	
	//ATUALIZA STATUS DO PROJETO
	public function atualizaStatus($id, $status){
		
		$sql = mysql_query("update projetos set status = '$status' where id = '$id'");	
		
		if($sql){
			//PEGA OS DADOS DO PROJETO
			$sql = mysql_query("select projetos.nome,
										profissionais.nome as profissional
										profissionais.email
									from
										projetos,
										profissionais
									where
										projetos.id = '$id'
									and
										profissionais.id = projetos.id_profissional");
			$dados = mysql_fetch_array($sql);
			
			//SETA A MSG
			$msg = 'Parabéns, seu projeto <strong>' . $dados['nome'] . '</strong> foi aprovado e já está disponível para visualização no <strong>Imoprojetos</strong>.';
			
			//ENVIA O EMAIL
			$this->envia_email($dados['profissionais'], $msg, $dados['email'], 'Projeto Aprovado');	

			return true;
		}
		else{
			return false;
		}
	}




	//************************************************
	//
	//FUNÇÕES PARA O ENVIO DE EMAILS
	//
	//************************************************

	//ENVIA EMAIL AO USUÁRIO
	public function envia_email($nome, $texto, $email, $assunto){
		
		$msg = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
				<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
				</head>
				
				<body style="background-color:#FFF">
					<table style="width:600px; margin:0 auto; margin-top: 20px; border:1px solid #fc9f8a;" cellspacing="0">
					
						<tr style="color:#5d5d5d;">
							<td colspan="3">
                            	<br />
								<p style="font-family: Arial, Verdana, sans-serif; font-size: 14px; margin:12px 20px; line-height:150%;">
                                	<strong style="color: #ef4921;">Prezado(a) ' . $nome . '</strong>
                                    <br /><br /><br />
                                    <span>' . $texto . '</span>
                                </p>
								
                                <br />
                                
                                <p style="font-family: Arial, Verdana, sans-serif; font-size: 14px; margin:12px 20px; line-height:150%; text-align:right;">
                                    <strong style="color: #ef4921;">Equipe do Imoprojetos</strong>.
                               </p>
							</td>
						</tr>
						
						<tr>
							<td style="height:20px;">&nbsp;&nbsp;</td>
						</tr>
					</table>
				</body>
				</html>
		';
		
		/* Verifica qual é o sistema operacional do servidor para ajustar o cabeçalho de forma correta. */
		if(PHP_OS == "Linux") $quebra_linha = "\n"; //Se for Linux
		elseif(PHP_OS == "WINNT") $quebra_linha = "\r\n"; // Se for Windows
		else die("Este script nao esta preparado para funcionar com o sistema operacional de seu servidor");

		/* Montando o cabeçalho da mensagem */
		$headers = "MIME-Version: 1.1".$quebra_linha;
		$headers .= "Content-type: text/html; charset=iso-8859-1".$quebra_linha;
		$headers .= "From: Imoprojetos <secretaria@ad2editora.com.br>" . $quebra_linha;
		$headers .= "Return-Path: secretaria@ad2editora.com.br" . $quebra_linha;
		$headers .= "Reply-To: secretaria@ad2editora.com.br" . $quebra_linha;
		 
		/* Enviando a mensagem */
		if(mail($email, utf8_encode($assunto), utf8_decode($msg), $headers, "-r". $email)){
			
			return true;
		}
		else{
			return false;
		}
	}




}
?>