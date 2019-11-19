<?php
session_start();
date_default_timezone_set('America/Sao_Paulo');

if(empty($_SESSION['ad_id'])){
    echo "<script>location.href='sair.php';</script>";
}

require('../sistema/conexao.php');


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
              <li><a href="cadastrarusuario.html">NOVO USUÁRIO <i class="fa fa-user-plus"></i></a></li>
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
                    <img src="../sistema/img/<?php echo $_SESSION['ad_foto']; ?>" width="150" alt="" class="img-responsive img-thumbnail">
                    <br>
                    <h4><?php echo $_SESSION['ad_nome']?></h4>
                </center>
            </div>
            
            <!-- relatórios-->
            <div class="col-lg-8 col-md-12 col-sm-12" >
                <form action="cadastrausuario.php" method="post" class="form-group" enctype="multipart/form-data"> 
                    <center><h2>Cadastro</h2></center>
                    <label>Nome</label>
                    <input type="text" name="nome" required class="form-control" placeholder="Ex. Fulano de Tal">
                    <br>
                     <label>CPF</label>
                    <input type="text" name="cpf" maxlength="14" required class="form-control" placeholder="Ex. 123.123.123-12">
                    <br>
                     <label>Foto</label>
                    <input type="file" name="foto" required class="form-control" placeholder="Ex. 1234">
                    <br>
                    <button type="submit" class="btn btn-success btn-block">Cadastrar no Sistema</button>
                </form>
                <br>
            </div>
          </div>
        </div>
      </div>

    <script src="../sistema/js/bootstrap.min.js" type="text/javascript"></script>
</body>
</html>
