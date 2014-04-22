<?php

class Publico{
	
	//CONSTRUTOR
	public function __construct(){
		include("../../config/conexao.php");		
	}
	

	//LISTA OS ANOS QUE POSSUEM PROJETOS CADASTRADOS
	public function listaAnos(){
		
		$dados = array();
		$i = 0;
		
		$sql = mysql_query("select distinct ano from projetos where status = 'Ativo' order by ano desc");	
		while($rs = mysql_fetch_array($sql)){
			
			$dados[$i] = $rs['ano'];
			
			$i++;	
		}
		
		return $dados;
	}
	
	
	
	//LISTA OS PROFISSIONAIS QUE POSSUEM PROJETOS CADASTRADOS
	public function listaProfissionais(){
		
		$dados = array();
		$i = 0;
		
		$sql = mysql_query("SELECT distinct 
										projetos.id_profissional as id, 
										profissionais.nome, 
										profissionais.cidade, 
										profissionais.estado, 
										profissionais.logo
									FROM 
										projetos, 
										profissionais 
									where 
										projetos.id_profissional = profissionais.id
									and
										projetos.status = 'Ativo'
									order by
										profissionais.nome asc
									");	
		while($rs = mysql_fetch_array($sql)){
			
			$dados[$i]['id'] = $rs['id'];
			$dados[$i]['nome'] = $rs['nome'];
			$dados[$i]['cidade'] = $rs['cidade'];
			$dados[$i]['estado'] = $rs['estado'];
			
			if($rs['logo'] != ''){
				
				$dados[$i]['logo'] = $rs['logo'];
			}
			else{
				$dados[$i]['logo'] = 'sem-foto.png';	
			}
			
			$i++;	
		}
		
		return $dados;
	}
	
	
	
	//LISTA TODOS OS PROFISSIONAIS
	public function listaTodosProfissionais(){
		
		$dados = array();
		$i = 0;
		
		$sql = mysql_query("SELECT profissionais.id, 
									profissionais.nome 
								FROM 
									profissionais 
								order by
									profissionais.nome asc
								");	
		while($rs = mysql_fetch_array($sql)){
			
			$dados[$i]['id'] = $rs['id'];
			$dados[$i]['nome'] = $rs['nome'];
			
			$i++;	
		}
		
		return $dados;
	}
	
	
	
	//LISTA OS PROJETOS
	public function listaProjetos($ano = '', $profissional = '', $tipo = '', $categoria = '', $busca = ''){
		
		$i = 0;
		$dados = array();
		
		if($busca != ''){
			
			$query = "(projetos.ano like '%$busca%'
						or					
					projetos.tipo like '%$busca%'
						or
					projetos.categoria like '%$busca%'
						or
					projetos.nome like '%$busca%'
						or
					profissionais.nome like '%$busca%')
					";	
		}
		else{
			$query = "projetos.ano like '%$ano%'
						and
					projetos.id_profissional like '%$profissional%'
						and
					projetos.tipo like '%$tipo%'
						and
					projetos.categoria like '%$categoria%'";
		}
		
		$sql = mysql_query("select
								projetos.nome,
								projetos.ano,
								projetos.id,
								profissionais.nome as profissional,
								fotos.foto
							from
								projetos,
								profissionais,
								fotos
							where
								projetos.id_profissional = profissionais.id
							and
								projetos.id = fotos.id_projeto
							and
								projetos.status = 'Ativo'
							and
								$query
							group by
								projetos.id
							order by
								projetos.id desc
							");
		
		while($rs = mysql_fetch_array($sql)){
			
			$dados[$i]['id'] = $rs['id'];	
			$dados[$i]['nome'] = $rs['nome'];	
			$dados[$i]['profissional'] = $rs['profissional'];	
			$dados[$i]['ano'] = $rs['ano'];	
			$dados[$i]['foto'] = $rs['foto'];	
			
			$i++;
		}
		
		return $dados;
	}
	
	
	
	//PEGA AS INFORMAÇÕES DO PROJETO
	public function infoProjeto($id){
		
		$sql = mysql_query("select 
								projetos.*,
								profissionais.nome as profissional
							from
								projetos,
								profissionais
							where
								projetos.id_profissional = profissionais.id
							and
								projetos.id = '$id'
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
	
	
	
	//PEGA AS FOTOS DO PROJETO
	public function fotosProjeto($id){
		
		$i = 0;
		$dados = array();
		
		$sql = mysql_query("select * from fotos where id_projeto = '$id'");
		
		while($rs = mysql_fetch_array($sql)){	
			
			$dados[$i]['foto'] = $rs['foto'];
			$dados[$i]['credito'] = $rs['credito'];
			
			$i++;
		}
		
		return $dados;
	}
	
	
}

?>