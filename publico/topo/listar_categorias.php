<?php 

//recebe o tipo
$tipo = $_REQUEST['tipo'];

echo '<li id="">Todos</li>';

if($tipo == 'Residenciais'){
	
	echo '<li id="1">Casas</li>';
	echo '<li id="2">Apartamentos</li>';
	echo '<li id="3">Outros</li>';
}
else if($tipo == 'Comerciais'){
	
	echo '<li id="4">Corporativos</li>';
	echo '<li id="5">Comércio</li>';
	echo '<li id="6">Outros</li>';
}
	
?>

