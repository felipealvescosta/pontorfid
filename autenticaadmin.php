<?php
session_start();
require("sistema/conexao.php");

$usuario = filter_input(INPUT_POST, 'usuario');
$passe = filter_input(INPUT_POST, 'passe');
 

//echo "$usuario<br>$passe";

$sql[0] = "SELECT * FROM pe_admin WHERE ad_usuario ='$usuario' AND ad_passe='$passe' ";

$sttm = $conexao->prepare($sql[0]);
$sttm->execute();

$result = $sttm->fetchColumn();

foreach ($conexao->query($sql[0]) as $key ) {
    $id = $key['ad_id'];
 	$nome = $key['ad_nome'];
 	$foto = $key['ad_foto'];
}

if ($result >  0)
 {
    $_SESSION['ad_id'] = $id;
 	$_SESSION['ad_nome'] = $nome;
 	$_SESSION['ad_foto'] = $foto;
 	$_SESSION['ad_passe'] = $passe;

 	echo "<script>location.href=('admin/');</script>";
}
else
 {
    unset ($_SESSION['ad_id']); 
 	unset ($_SESSION['ad_nome']); 
    unset ($_SESSION['ad_passe']); 
    unset ($_SESSION['ad_acesso']); 
    echo "<script>alert('Usuario ou senha incorreto. '); history.go(-1);</script>"; 
}
 