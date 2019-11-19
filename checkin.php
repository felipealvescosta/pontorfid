<?php
session_start();
	
	//seta o fuso horário
	date_default_timezone_set('America/Sao_Paulo');
	require("sistema/conexao.php");

	//matriula par realizar o ponto
	$ht_matricula = $_GET['matricula'];
	$_SESSION['pin'] = $ht_matricula;
	

	// saber se a matriula existe
	$sqlBuscaFun = "SELECT * FROM pe_funcionario WHERE fu_id = '$ht_matricula' ";
	$sttm = $conexao->prepare($sqlBuscaFun);
	$sttm->execute();
	$resultado = $sttm->fetchColumn();

 	//variaveis para o hekin
	$ht_data = Date('d-m-y');
	$ht_entrada = Date('H:i');

	//echo "Data:$ht_data<br>Hora:$ht_hora";

	if( $resultado > 0 )
	{
		//Busca checkin da matricula nesse dia
		$sqlBuscaPontoDia = "SELECT * FROM pe_historico WHERE ht_matricula='$ht_matricula' AND ht_data = '$ht_data'  ";
		$pegadia = $conexao->prepare($sqlBuscaPontoDia);
		$pegadia->execute();
		$pontodia = $pegadia->fetchColumn();

		// realizada a atualização do checkout
		if( $pontodia > 0 )
		{
			// busca a matricula e a data do dia correspondente
			$sqlPegaHoraEntrada = "SELECT * FROM pe_historico WHERE ht_matricula = '$ht_matricula' AND ht_data = '$ht_data' ";
			//busca na lista
			foreach ($conexao->query($sqlPegaHoraEntrada) as $horaentrada) {
				$id = $horaentrada['ht_id'];
				$entrada = $horaentrada['ht_entrada'];
				$status = $horaentrada['ht_status'];

			}

			if($status == 0 )
			{
				// hora de saída
				$ht_saida = Date('H:i');

				//atualiza o status
				$ht_status = 1;

				//realiza o calculo do tempo
				$ht_total = gmdate('H:i', abs( strtotime( $ht_saida ) - strtotime( $entrada ) ) );


				//echo"ID:$id<br>matricula:$ht_matricula<br>Entrada:$entrada<br>Saida:$ht_saida<br>Total:$ht_total<br>";

				// atualiza o campo hora saída
				$sqlCheckOut = "UPDATE  pe_historico SET ht_saida ='$ht_saida', ht_total = '$ht_total', ht_status= '$ht_status' WHERE  ht_id = '$id' ";
	      		$checkout = $conexao->query($sqlCheckOut);

	      			//confirma a atualização
		      		if($checkout)
		      		{
		      			//echo "Checkout deu certo";
		      			require('confirmacaocheckout.php');
		      		}
		      		else
		      		{
		      			echo "Checkout não deu certo";
		      			require('errocheckout.php'); 
		      		}
			}
			//insere novo horário no mesmo dia
			else{
				$ht_status = 0;
				$sqlInsere = "
						INSERT INTO
							pe_historico
							(ht_matricula,
							 ht_data, 
							 ht_entrada,
							 ht_status)
							VALUES
							(:ht_matricula, 
							 :ht_data ,
							 :ht_entrada,
							 :ht_status)
					"; 

				$insere = $conexao->prepare($sqlInsere);
				$insere->execute(
				    array(
				        ':ht_matricula' => $ht_matricula,
				        ':ht_data'      => $ht_data,
				        ':ht_entrada'   => $ht_entrada,
				        ':ht_status'	=> $ht_status
				        )
				    );
				if ($insere) 
				{	
					echo "Data:$ht_data<br>Hora:$ht_entrada<br>";
					echo "Realizou o primeiro checkout";
		     		require('confirmacao.php');
		     	}
		     	else
		     	{	
		     		echo "Primeiro checkou não deu certo";
		     		require('erro.php');
		     	}
			}
		}

		//realiza o checkin
		else
		{
			$ht_status = 0;
			$sqlInsere = "
					INSERT INTO
						pe_historico
						(ht_matricula,
						 ht_data, 
						 ht_entrada,
						 ht_status)
						VALUES
						(:ht_matricula, 
						 :ht_data ,
						 :ht_entrada,
						 :ht_status)
				"; 

			$insere = $conexao->prepare($sqlInsere);
			$insere->execute(
			    array(
			        ':ht_matricula' => $ht_matricula,
			        ':ht_data'      => $ht_data,
			        ':ht_entrada'   => $ht_entrada,
			        ':ht_status'	=> $ht_status
			        )
			    );

			if ($insere) 
			{	
				echo "Data:$ht_data<br>Hora:$ht_entrada<br>";
				echo "Realizou o primeiro checkout";
	     		require('confirmacao.php');
	     	}
	     	else
	     	{	
	     		echo "Primeiro checkou não deu certo";
	     		require('erro.php');
	     	}
		}
	}

	// Usuário Não encontrado
	else
	{
		require('erro.php');
	}

?>

