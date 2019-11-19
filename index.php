<?php
    $cartao = $_GET['cartao'];
    echo $cartao; 


    $porta=fopen('/dev/cu.usbserial-1410
    ','r+');

    if($porta)
    {         
                //Dados da serial
                $serial = fgets($porta);
                // $dados = $serial;
                //$sensores = explode(":", $dados);
                //echo $sensores;
    }
    else
    {
        echo "Conexão serial não foi realizada.";

    } 
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de ponto digital, Elos Educacional">
    <meta name="author" content="Felipe Alves">

    <title>Elos Ponto Digital</title>

    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">        
    <link rel="icon" type="image/png" href="../img/icon.png">
    <script src="js/jquery-3.2.1.min.js"></script>
            
    <script src="js/bootstrap.js"></script>
            
    <style type="text/css">
        .pin{
            padding: 50px 30px 30px 50px;
        }
        .footer{
            margin-top: 5%;
        }
        body{
            background-color:#EEEEEE ; 
        }
        .nav-link{
            color: #868585;
        }
    </style>
  </head>
  <body class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 pin">
                <center><a href="../"><img src="img/logo.png" width="300" alt="Ponto Digital" class="img-responsive"></a></center>
                <br>
                <br>
                <form action="login.php" method="get``" class="form-group"> 
                    <center><h2>Aproxime o Cartão</h2></center>
                    <br>
                    <input type="number" name="pin" required class="form-control" placeholder="Ex. elos100">
                    <br>
                    <button type="submit" class="btn btn-success btn-block">Acessar Sistema <i class="fa fa-sign-in"></i></button>
                </form>
                
            </div>
            <div class="col-md-3"></div>
        </div> 

        <div class="container">
            <div class="row">
                <div class="col-md-12 footer">
                   <center>
                        Acessar o ambiente Administrativo
                        <br>
                        <br>
                        <a href="loginadmin.html" style="color:gray;"><i class="fa fa-gear fa-4x animated rotateIn"></i></a>
                        <br>
                        <br>
                        <small>Elos Ponto Digital</small>
                    </center>
                </div>
            </div>
        </div>
  </body>
  </html>