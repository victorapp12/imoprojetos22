<?php
require 'gerarThumb/ThumbLib.inc.php';


if (!empty($_FILES)) {
	
	//recebe o arquivo e o nome
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$nome = $_REQUEST['nome'] . "." . end(explode(".", $_FILES['Filedata']['name']));
	
	//gera o caminho do arquivo
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/grandes/';
	$targetFile =  str_replace('//','/',$targetPath) . $nome;
	
	//faz o upload
	move_uploaded_file($tempFile,$targetFile);
		
	//Gera a versão grande da foto
	$thumb = PhpThumbFactory::create($targetFile);
	$thumb->adaptiveResize(720, 720);
	$thumb->save($_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'].'/grandes/'.$nome);
	
	//Gera a versão pequena da foto
	$thumb = PhpThumbFactory::create($targetFile);
	$thumb->adaptiveResize(240, 240);
	$thumb->save($_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'].'/pequenas/'.$nome);
	
	echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile);
}

?>