<?php 
    

    require("../sistema/conexao.php");

    $sql = "SELECT max(pf_id)  FROM perfil";

    $ultimovalor = $conexao->query($sql)->fetchColumn();

    //echo "$ultimovalor";

    $sql2 = "SELECT * FROM perfil WHERE pf_id = '$ultimovalor' ";

    foreach ($conexao->query($sql2) as $key) {
           
            $nome = $key['pf_nome'];
            $email = $key['pf_email'];
            $foto = $key['pf_foto'];
    }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

    <title>CollabTrash</title>

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
    <link href="../sistema/assets/css/toolkit.css" rel="stylesheet">
    
    <link href="../sistema/assets/css/application.css" rel="stylesheet">
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <style>
      /* note: this is a hack for ios iframe for bootstrap themes shopify page */
      /* this chunk of css is not part of the toolkit :) */
      body {
        width: 1px;
        min-width: 100%;
        *width: 100%;
      }
      .nav{
       color: #5CAE3E!important;
      }
    </style>

  </head>
  <body class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 pin">
                <center style="margin-top: 100px;"><img src="../img/logo.png" class="img-responsive img-circle" width="200"></center>
                <br><br>
               <div class="">
                <center>
                    <img src="../sistema/assets/fotos/<?php echo $foto;?>" class="img-responsive img-circle" width="80">
                </center>
                <div class="tv">
                    <br>
                  <center><strong><?php echo $nome; ?></strong></center>
                  <br>
                  <div class="bqo">
                    <center><?php echo $email?></center>
                  </div>
                 <center><br>
                   <h3>Obrigado por se cadastrar!<br>Anote Seu PIN</h3><br>
                       <h1>000 <?php echo $ultimovalor?>
                    </h1>
                  </center>
                </div>
              </div>
                <br>
                
                <center><a href="../sistema/index.php?pin=<?php echo $ultimovalor?>" class="btn btn-lg btn-success">Ir para Sistema</a></center>
            </div>
            <div class="col-md-3"></div>
        </div> 

        <div class="container">
            <div class="row">
                <div class="col-md-12 footer">

                   <center style="margin-top:100px;">CollabTrash - Coleta Colaborativa</center>
                </div>
            </div>
        </div>
  </body>
  </html>