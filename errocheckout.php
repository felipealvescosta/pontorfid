<html>
	     	<head>
	     		<meta charset="utf-8">
	     		<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	     		<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
	     		
		     		<link rel="icon" type="image/png" href="../img/icon.png">

		     		<title>Ponto Eletrônico - Elos  </title>
	     		<style type="text/css">
	     			.modal{
	     				height: 800px !important; 
	     			}
	     		</style>
	     	</head>
	     	<body>

	     	<script src="js/jquery-3.2.1.min.js"></script>
			
			<script src="js/bootstrap.js"></script>
			
			<script type="text/javascript">
                          $(window).on('load',function(){
                              $('#modalConfirm').modal('show');
                          });
            </script>
			
					<div class="modal fade" id="modalConfirm" tabindex="0" role="dialog"  aria-hidden="true" style="margin-top: 15%">
					        <div class="modal-dialog modal-lg modal-notify modal-danger center" role="document">	
					            <!--Content-->
					            <div class="modal-content text-center">
					                <!--Header-->
					                <div class="modal-header ">
					                    <center><h2 style="color:white;">Checkout não realizado!</h2></center>
					                </div>

					                <!--Body-->
					                <div class="modal-body">
					                    <i class="fa fa-times fa-5x animated rotateIn"></i>
					                    <br>
					                    Deseja realizar o checkout manualmente?
					                </div>

					                <!--Footer-->
					                <div class="modal-footer justify-content-center">
					                    <a href="index.php" class="btn  btn-success btn-lg" > Sim <i class="fa fa-check"></i>
					                    </a>
					                    <a href="fechar.html" class="btn  btn-danger btn-lg" > Não <i class="fa fa-sign-out"></i>
					                    </a>
					                </div>
					            </div>
					            <!--/.Content-->
					        </div>
					    </div>
			   	</body>
			   </html>