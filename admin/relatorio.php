<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');

if(empty($_SESSION['ad_id'])){
    echo "<script>location.href='sair.php';</script>";
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


$pin = $_GET['pin'];

require('../sistema/conexao.php');
//Busar informaões do usuário
$sqlInfo = "SELECT * FROM pe_funcionario WHERE fu_id = '$pin' ";
foreach ($conexao->query($sqlInfo) as $info ) {
    $nome = $info['fu_nome'];
    $cpf = $info['fu_cpf'];
    $foto = $info['fu_foto'];
}

//Pegas os dias e horas
$mesano = Date('m-y');
//Peda o total de dias
$sqlSomaDia = "SELECT DISTINCT ht_data  FROM pe_historico WHERE  ht_data LIKE '%$mesano' AND ht_matricula = '$pin' ";
$totaldias = 0;
foreach($conexao->query($sqlSomaDia) as $dias)
{    
    $totaldias++;
}
//pega total de horas
$sqlSomaHoras = "SELECT time_format( SEC_TO_TIME( SUM( TIME_TO_SEC( ht_total ) ) ),'%H:%i') FROM  pe_historico WHERE ht_data LIKE '%$mesano%' AND ht_matricula = '$pin' ";
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
              <li><a href="sair.php">SAIR <i class="fa fa-sign-out"></i></a></li>
            </ul>
          </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-12 esp" >
                <center>
                    <img src="../sistema/img/<?php echo $foto; ?>" width="150" alt="" class="img-responsive img-thumbnail">
                    <br>
                    <h4><?php echo "$nome";?></h4>
                    <?php echo "$cpf";?>  
                    <br><br>
                    <a href="index" class="btn btn-default" > <i class="fa fa-chevron-left"></i> Voltar</a>
                </center>

            </div>

            <div class="col-lg-8 col-md-12 col-sm-12" >
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 " >
                        <hr>
                        <center>
                           <h3>Dias <i class="fa fa-calendar"></i></h3>
                            <p><?php echo $totaldias;?></p>
                        </center>
                        <hr>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <hr>
                        <center>
                           <h3>Horas <i class="fa fa-clock-o"></i></h3>
                           <p><?php echo $totalhoras;?></p>
                        </center>
                        <hr>
                    </div>
                </div>
                <center>
                    <h5>Histórico</h5>
                    Mês Corrente: <b><?php echo  $mes[date('m')]; ?> </b>
                </center>

                <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                            <th>*</th>
                            <th><center>Data <i class="fa fa-calendar"></i></center></th>
                            <th><center>Entrada <i class="fa fa-sign-in"></i></center></th>
                            <th><center>Saída <i class="fa fa-sign-out"></i></center></th>
                            <th><center>Permanência <i class="fa fa-stop"></i></center></th>
                        </tr>
                    </thead>
                    <tbody>
                      <form action="" method="get">
                       <?php
                            $sqlHistorico = "SELECT * FROM pe_historico WHERE ht_matricula = '$pin' AND ht_data LIKE '%$mesano' ";
                            $numero = 1;
                            foreach ($conexao->query($sqlHistorico) as $hist) 
                            {
                                print"
                                    <tr>
                                        <td>".$numero."</td>
                                        <td align='center'>".$hist['ht_data']."</td>
                                        <td align='center'>".$hist['ht_entrada']."</td>
                                        <td align='center'>".$hist['ht_saida']."</td>
                                        <td align='center'>".$hist['ht_total']."</td>
                                    </tr>
                                "; 
                                $numero++;
                            }
                       ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
     <!-- Visualizar Historico de Pontos-->
      <script type="text/javascript">
       $( "button[name*='btn']" ).click(function() {
          $("textarea[name='teste']").val($(this).val());
        });
      </script>

      <div class="modal fade" id="modalVisualizarHistorico" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title"><center>Histórico Diário <i class="fa fa-history"></i></center></h4>
            </div>
            <div class="modal-body">
                <table class="table table-hover table-responsive">
                    <thead>
                        <tr>
                            <th>*</th>
                            <th><center>Data <i class="fa fa-calendar"></i></center></th>
                            <th><center>Entrada <i class="fa fa-sign-in"></i></center></th>
                            <th><center>Saída <i class="fa fa-sign-out"></i></center></th>
                            <th><center>Permanência <i class="fa fa-stop"></i></center></th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php
                            
                            $sqlHistoricoDetalhado = "SELECT * FROM pe_historico WHERE ht_matricula = '$pin' ";
                            $numero = 1;
                            foreach ($conexao->query($sqlHistoricoDetalhado) as $hist) 
                            {
                                print"
                                    <tr>
                                        <td>".$numero."</td>
                                        <td align='center'>".$hist['ht_data']."</td>
                                        <td align='center'>".$hist['ht_entrada']."</td>
                                        <td align='center'>".$hist['ht_saida']."</td>
                                        <td align='center'>".$hist['ht_total']."</td>
                                    </tr>
                                ";
                            $numero++;
                            }
                       ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer"> 
               <button type="button" class="btn btn-default" data-dismiss="modal">Fechar <i class="fa fa-close"></i></button>
            </div>
          </div>
        </div>
      </div>
      <!-- Fim visualizar produto e serviço -->
      <script src="../sistema/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>
