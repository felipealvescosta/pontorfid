<?php
	
	$host = "localhost";
	$user = "root";
	$pass = "felipe123"; //Mudar para a senha do seu banco, caso tenha senha
	$db = "elos_ponto";

		
	$conexao = new PDO("mysql:host=$host;port=3306;dbname=$db",$user,$pass);
	
	if ($conexao) {
	//	echo "deu certo";
	}

?>