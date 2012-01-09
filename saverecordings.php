<?php
	session_start();
     if(!session_is_registered('username'))
		{
 		 header("location:admin.php");
		}
?>



<?php

$allowSave=$_COOKIE['allowsave'];

if($allowSave == 1){
	$file = $_GET['file'];
	$filename_save = $_GET['filename_save'];
	$date=substr($Record_Date = $_GET['Recorded_Date'],0,11);
	$date2 = new DateTime($date); 
  $format_date=date_format($date2, 'Ymd');
	
	if (is_readable($file)) 
	{
		include ("includes/connection.php");
		$connect= new Connection();
			 
		if($connect->connectdb("db_recordings"))
		{
			$user=$_COOKIE['user'];
			$result= mssql_query("select * from rec_user where username='$user'")or die("ERROR!");
			$count=mssql_num_rows($result);
			if ($count==1)
			{	
				$row=mssql_fetch_array($result);
				$id=$row['id'];
				$activity="SAVE";
				$info_save= $filename_save.'_'.$format_date;
				$sql="insert into rec_logs(userId,logDate,logDetail,otherDetail) values('".$id."',GETDATE(),'".$activity."','".$info_save.                "')";
				mssql_query($sql);
					
			}else
			{
				echo'<div class="counter">'. "SAVE ERROR!".'</div>';
			}
		}else
		{
			echo'<div class="counter">'. "Database Error!".'</div>';
		}
		   
	
		$connect->closedb();
		header('Content-disposition: attachment; filename='.$filename_save.'_'.$format_date.'.wav');
		header('Content-type: audio/x-wav');
		ob_clean();
		flush();
		readfile($file);
		
	}else
	{
		echo '<div class="counter">'. "Source file don't exist".'</div>';
	}
}else
{
	echo '<div class="counter">'. "You don't have permission to access this page".'</div>';
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>SAVE_RECORDINGS</title>
</head>
<body>
</body>
</html>