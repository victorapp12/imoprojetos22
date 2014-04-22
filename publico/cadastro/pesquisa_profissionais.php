<?php

include '../../classes/admin.class.php';
$imo = new Imoprojetos();

$dados = $imo->infoProfissional($_REQUEST['profissional']);

//TESTA SE ACHOU AS INFORMAÇÕES
if(isset($dados['id']) and $dados['id'] != ''){
	
	if($dados['logo'] != ''){
		$logo = $dados['logo'];
	}
	else{
		$logo = 'sem-foto.png';	
	}

	//RETORNA UM JSON COM OS DADOS	
	echo json_encode(array("erro"=>"nao",							
							"nome"=>$dados['nome'],
							"endereco" => $dados['endereco'],
							"complemento" => $dados['complemento'],
							"bairro" => $dados['bairro'],
							"cidade" => $dados['cidade'],
							"estado" => $dados['estado'],
							"cep" => $dados['cep'],
							"telefone" => $dados['telefone'],
							"email" => $dados['email'],
							"site" => $dados['site'],
							"id" => $dados['id'],
							"logo" => $logo
							));

}
else{
	//RETORNA UM JSON INFORMANDO O ERRO
	echo json_encode(array("erro"=>"sim", "msg" => "Dados não encontrados. Por favor, preencha o formulário abaixo."));
	
}


	
?>
