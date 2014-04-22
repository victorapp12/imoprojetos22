<?php session_start();

include '../../config/conexao.php';


$foto = $_REQUEST['foto'];
$id = $_REQUEST['id'];

//apaga o arquivo fisico
unlink('../../fotos/pequenas/' . $foto);
unlink('../../fotos/medias/' . $foto);
unlink('../../fotos/grandes/' . $foto);

//limpa no banco
$sql = mysql_query("delete from fotos where foto = '$foto'");

if($sql){
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
            document.location = "cadastrar_fotos.php?id=<?php echo $id; ?>";
        </SCRIPT>
<?php
}
?>
	
