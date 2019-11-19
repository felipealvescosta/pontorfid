<?php
	require('../sistema/conexao.php');

	$matricula = $_POST['matricula'];
  $nome = $_POST['nome'];

  
	// Imagem
  $destino = "../sistema/img/".$_FILES['foto']['name'];
  $foto = $_FILES['foto']['name']; 
  $arquivo_tmp = $_FILES['foto']['tmp_name'];
  move_uploaded_file($arquivo_tmp,$destino);
  

  echo "Matriula:$matricula<br>Nome:$nome<br>Foto:$foto";

  if(!empty($foto))
  {
      $sqlUpdate = "UPDATE  pe_admin SET ad_nome ='$nome', ad_foto = '$foto' WHERE  ad_id = '$matricula'";
      $atualiza = $conexao->query($sqlUpdate);

      if($atualiza){
        echo "<script>alert('Dados Atualizados');location.href=('perfil.php');</script>";
      }
      else{
        echo "<script>alert('Algo deu Errado, tente novamente!');location.href=('perfil.php');</script>";
      }
  }
  else
  {
    $sqlUpdate = "UPDATE 	pe_admin SET ad_nome ='$nome'  WHERE  ad_id = '$matricula'";
    $atualiza = $conexao->query($sqlUpdate);
    echo "<script>alert('Dados Atualizados');location.href=('perfil.php');</script>";
  }


	