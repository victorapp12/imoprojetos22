<?php session_start();

include '../../classes/admin.class.php';
$imo = new Imoprojetos();


//recebe os dados
$nome = $_REQUEST['nome'];
$telefone = $_REQUEST['telefone'];
$endereco = $_REQUEST['endereco'];
$complemento = $_REQUEST['complemento'];
$bairro = $_REQUEST['bairro'];
$cep = $_REQUEST['cep'];
$cidade = $_REQUEST['cidade'];
$estado = $_REQUEST['estado'];
$email = $_REQUEST['email'];
$site = $_REQUEST['site'];
$id = $_REQUEST['id'];
$logo = $_REQUEST['nomeFoto'];


//TESTA SE UM ID FOI INFORMADO
if($id == ''){

	//FAZ O CADASTRO NO BANCO	
	$resultado = $imo->criarProfissional($nome, $telefone, $endereco, $complemento, $bairro, $cep, $cidade, $estado, $email, $site, $logo);
	
	//se a query funcionar
	if($resultado == true){ 
	
		$id = mysql_insert_id();
?>
		<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
            document.location = "cadastrar_projeto.php?id=<?php echo $id; ?>";
        </SCRIPT>

<?php
	}
	else{
?>
		<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
            alert ("Ocorreu um erro. Por favor tente novamente.");
            history.back(-1);
        </SCRIPT>
<?php 
	}
}
else{
	
	//ATUALIZA OS DADOS DO PROFISSIONAL
	$imo->editarProfissional($nome, $telefone, $endereco, $complemento, $bairro, $cep, $cidade, $estado, $email, $site, $id, $logo)
?>

	<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
           document.location = "cadastrar_projeto.php?id=<?php echo $id; ?>";
    </SCRIPT>
        
<?php	
}
?>
