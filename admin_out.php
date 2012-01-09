<?php
	session_start();
     if(!session_is_registered('username1'))
		{
 		 header("location:admin.php");
		}
?>
<?php

      
	    include ("includes/admin_class.php");
			$check= new Check();
	    $check->logout();
	
?>

