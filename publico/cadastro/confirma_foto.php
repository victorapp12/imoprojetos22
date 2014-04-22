<?php 
include '../../config/conexao.php';


$foto = $_REQUEST['nomeFoto'];
$id = $_REQUEST['id'];
$credito = $_REQUEST['credito'];

//se houver um arquivo de foto
if($foto != ""){

	//faz o cadastro no banco
	$sql = mysql_query("insert into fotos (id_projeto, foto, credito) values ('$id', '$foto', '$credito')");

	//se a query funcionar
	if($sql){
?>
		<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
            document.location = "cadastrar_fotos.php?id=<?php echo $id; ?>";
        </SCRIPT>
	
<?php }else{ ?>
	
		<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">
            alert ("Ocorreu um erro. Por favor tente novamente.")
            document.location = "cadastrar_fotos.php?id=<?php echo $id; ?>";
        </SCRIPT>
		
<?php } 
}
//senão apenas volta para a página anterior
else{
	header("Location: cadastrar_fotos.php?id=" . $id);
}
?>
	
