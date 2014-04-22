<?php session_start();

include '../../classes/admin.class.php';
$imo = new Imoprojetos();


//recebe os dados
$nome = $_REQUEST['nome'];
$ano = $_REQUEST['ano'];
$tipo = $_REQUEST['tipo'];
$categoria = $_REQUEST['categoria'];
$profissional = $_REQUEST['profissional'];
$descricao = $_REQUEST['descricao'];
$status = 'Pendente';

$resultado = $imo->criarProjeto($nome, $ano, $tipo, $categoria, $profissional, $descricao, $status);

//se a query funcionar
if($resultado == true){ 

	$id = mysql_insert_id();
?>
	<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
		document.location = "cadastrar_fotos.php?id=<?php echo $id; ?>";
	</SCRIPT>

<?php
}
else{
?>
	<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
		alert ("Ocorreu um erro. Por favor tente novamente.")
		history.back(-1);
	</SCRIPT>
<?php 
}
?>
