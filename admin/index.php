<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');

if(empty($_SESSION['ad_id'])){
    echo "<script>location.href='sair.php';</script>";
}

require('../sistema/conexao.php');

//Busar informaões do usuário
$sqlInfo = "SELECT * FROM pe_admin WHERE ad_id = '$_SESSION[ad_id]' ";
foreach ($conexao->query($sqlInfo) as $info ) {
    $nome = $info['ad_nome'];
    $foto = $info['ad_foto'];
}


$mes = array(
    '01'=>'Janeiro',
    '02'=>'Fevereiro',
    '03'=>'Março',
    '04'=>'Abril',
    '05'=>'Maio',
    '06'=>'Junho',
    '07'=>'Julho',
    '08'=>'Agosto',
    '09'=>'Setembro',
    '10'=>'Outubro',
    '11'=>'Novembro',
    '12'=>'Dezembro'
);
//Pegas os dias e horas
$mesano = Date('m-y');
//Peda o total de dias
$sqlSomaDia = "SELECT DISTINCT ht_data  FROM pe_historico WHERE  ht_data LIKE '%$mesano' ";
$totaldias = 0;
foreach($conexao->query($sqlSomaDia) as $dias)
{    
    $totaldias++;
}
//pega total de horas
$sqlSomaHoras = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( ht_total ) ) ),'%H:%i') FROM  pe_historico WHERE ht_data LIKE '%$mesano%' ";
$totalhoras = $conexao->query($sqlSomaHoras)->fetchColumn(); 


?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Ponto Eletrônico - ELOS</title>
  <link rel="icon" type="image/png" href="../img/icon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />


  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link href="../sistema/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.css">

    <script src="../sistema/js/jquery.min.js" type="text/javascript"></script>
    
    <style type="text/css">
        .esp{
            padding: 1%;
        }
        p{
            font-size: 30px;
        }
    </style>
</head>

<body>
       <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">ELOS PONTO</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
              <li><a href="perfil">PERFIL <i class="fa fa-user"></i></a></li>
              <li><a href="cadastrarusuario.php">NOVO USUÁRIO <i class="fa fa-user-plus"></i></a></li>
              <li><a href="../sistema/sair.php">SAIR <i class="fa fa-sign-out"></i></a></li>
            </ul>
          </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <!-- Perfil Admin -->
            <div class="col-lg-3 col-md-12 esp" >
                <center>
                    <img src="../sistema/img/<?php echo $foto; ?>" width="150" alt="" class="img-responsive img-thumbnail">
                    <br>
                    <h4><?php echo $nome?></h4>
                    Administrador
                </center>
            </div>
            
            <!-- relatórios-->
            <div class="col-lg-8 col-md-12 col-sm-12" >
                <center>Mês de Referência :<b> <?php echo  $mes[date('m')]; ?></b></center>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 " >
                        <hr>
                        <center>
                           <h3>Dias Trabalhados <i class="fa fa-calendar"></i></h3>
                            <p><?php echo $totaldias;?></p>
                        </center>
                        <hr>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <hr>
                        <center>
                           <h3>Horas Trabalhadas <i class="fa fa-clock-o"></i></h3>
                           <p><?php echo $totalhoras;?></p>
                        </center>
                        <hr>
                    </div>
                </div>

                <!-- Funcionários -->
                <div class="row">
                  <center><h4>Funcionários</h4></center>
                  <hr>
                  <?php
                    $sqlFuncionarios = "SELECT * FROM pe_funcionario";

                    foreach ($conexao->query($sqlFuncionarios) as $fun) {
                      print"
                          <div class='col-lg-4 col-md-4 col-sm-12'>
                              <div class='media' style='padding-top:20px;'>
                                  <div class='media-left'>
                                    <a href='relatorio.php?pin=".$fun['fu_id']."'>
                                      <img class='media-object' src='../sistema/img/".$fun['fu_foto']."' width='70'>
                                    </a>
                                  </div>
                                  <div class='media-body'>
                                    <h4 class='media-heading'>".$fun['fu_nome']."</h4>
                                    <a href='relatorio.php?pin=".$fun['fu_id']."'>Relatório Individual</a>
                                    PIN:".$fun['fu_id']."
                                  </div>
                                </div>
                          </div>
                      ";
                    }
                  ?>
              </div>
          </div>
        </div>
      </div>

    <script src="../sistema/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>
