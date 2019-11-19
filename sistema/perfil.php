<?php
session_start();

if(empty($_SESSION['pin'])){
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

require('conexao.php');
//Busar informaões do usuário
$sqlInfo = "SELECT * FROM pe_funcionario WHERE fu_id = '$_SESSION[pin]' ";
foreach ($conexao->query($sqlInfo) as $info ) {
    $nome = $info['fu_nome'];
    $cpf = $info['fu_cpf'];
    $foto = $info['fu_foto'];
}


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

    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.css">
    
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
<div class="wrapper">
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
              <li><a href="index">HOME <i class="fa fa-home"></i></a></li>
              <li><a href="sair.php">SAIR <i class="fa fa-sign-out"></i></a></li>
            </ul>
          </div>
        </div>
    </nav>

        
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 esp" >
                <center>
                    <img src="img/<?php echo $foto; ?>"  width="150" alt="" class="img-responsive img-thumbnail img-">
                    <br>
                    <h4><?php echo "$nome";?></h4>
                    <hr>
                    <?php echo "$cpf";?>  
                </center>
            </div>
            <div class="col-lg-12 col-md-12">

                <center><h4>Atualizar informações</h4></center>
                <form method="POST" action="atualizadados.php" class="form-group" enctype="multipart/form-data">
                    <input type="text" name="matricula" value="<?php echo $_SESSION['pin']?>" style="display: none;"> 
                    <label>Nome:</label>
                    <input type="text" name="nome" value="<?php echo $nome;?>" class="form-control">
                    <br>
                    <label>Foto:</label>
                    <input type="file" name="foto"  class="form-control"><br>
                    <button type="submit" class="btn btn-info btn-lg btn-block">Atualizar Dados <i class="fa fa-upload"></i></button>
                </form>
        </div>  
    </div>
</div>

</body>

<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>

</html>
