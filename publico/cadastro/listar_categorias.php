<?php

//recebe o tipo
$tipo = $_REQUEST['tipo'];

echo '<option value="">Selecione:</option>';

if($tipo == 1){
	
	echo '<option value="1">Casas</option>';
	echo '<option value="2">Apartamentos</option>';
	echo '<option value="3">Outros</option>';
}
else if($tipo == 2){
	
	echo '<option value="4">Corporativos</option>';
	echo '<option value="5">Comércio</option>';
	echo '<option value="6">Outros</option>';
}
else if($tipo == 3){

	echo '<option value="7">Outros</option>';
}

	
?>
