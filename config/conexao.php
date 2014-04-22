<?php

//define as variaveis
$servidor = "186.202.152.110";
$usuario = "ad2editora34";
$senha = "Curn1ch@";
$banco = "ad2editora34";

//faz a conexao
$conexao = mysql_connect($servidor,$usuario,$senha);
mysql_select_db($banco,$conexao);

//Cуdigo para resolver problemas com acentuaзгo
mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');
	

?>