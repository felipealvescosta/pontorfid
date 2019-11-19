<?php
  session_start();
	if (isset($_SESSION['pin']))
  {
  		session_unset(); // Eliminar todas as variÃƒÂ¡veis da sessÃƒÂ£o
  		session_destroy(); // Destruir a sessÃƒÂ£o
  		sleep(1);
      echo "<script>location.href=('../')</script>";  		
	} 

  else
	{
      sleep(1);
      session_unset(); // Eliminar todas as variÃƒÂ¡veis da sessÃƒÂ£o
      session_destroy(); // Destruir a sessÃƒÂ£o
      sleep(1);
      echo "<script>location.href=('../')</script>";
	}
	
?>
