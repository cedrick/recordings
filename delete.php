<?php
	session_start();
     if(!session_is_registered('username1'))
		{
 		 header("location:admin.php");
		}
?>

<?php
     include ("includes/connection.php");
     $connect= new Connection();
	 if($connect->connectdb("db_recordings"))
	    {
			$id=$_GET['id'];
	        $value=$_GET['value'];
			$sql="delete from rec_user  WHERE id='$id'";
	        $result=mssql_query($sql);
			if($result)
			 {
			   header ("location:admin_portal.php");	 
			 }
			else{ echo " Cannot Delete Record!";} 
			 
 
			
		}
		
	else
	
	    {
		  echo "Database Error!";
		} 


?>