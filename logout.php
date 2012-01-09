<?php
	session_start();
     if(!session_is_registered(username))
		{
 		 header("location:index.php");
		}
?>

<?php

      
	    include ("includes/rec_class.php");
			$check= new Check();
	    $check->logout();
	
?>


