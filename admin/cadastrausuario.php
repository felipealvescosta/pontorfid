<?php
	require('../sistema/conexao.php');

	$fu_nome = $_POST['nome'];

  $fu_cpf = $_POST['cpf'];

  
	// Imagem
  $destino = "../sistema/img/".$_FILES['foto']['name'];
  $fu_foto = $_FILES['foto']['name']; 
  $arquivo_tmp = $_FILES['foto']['tmp_name'];
  move_uploaded_file($arquivo_tmp,$destino);

  //echo "Aqui:$fu_nome<br>$fu_cpf<br>$fu_foto";
   

  $sql = "

		INSERT INTO

			pe_funcionario

			(fu_nome , fu_foto, fu_cpf )

			VALUES

			(:fu_nome, :fu_foto, :fu_cpf)

	"; 

         $stmt = $conexao->prepare($sql);

         $stmt->execute(
            array(
                  ':fu_nome' => $fu_nome,
                  ':fu_foto' => $fu_foto,
                  ':fu_cpf'  => $fu_cpf
               )
            );

     if ($stmt) {
     	echo "<script>location.href=('index');</script>";
     }

	