<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Recording Player</title>
</head>

<body>
<?php
		 session_start();
     if(session_is_registered('username'))
		{
 		 
		}else
		{
			header("location:index.php");
		}
?>
<?php include ("templates/template.php"); ?>
<div class="liner"></div>
<center>
  <br /><br /><br /><br /><br />
<?php 

  	$filename_save = $_GET['filename_save'];
		$date=substr($Record_Date = $_GET['Recorded_Date'],0,11);
		$date2 = new DateTime($date); 
 	 	$format_date=date_format($date2, 'Ymd');
		$recording = $_GET['fileplay'];
		if(!empty($recording))
		{
				echo '<embed type="application/x-mplayer2" src="'.$recording.'" autostart="true" loop="false">';
				include ("includes/connection.php");
				$connect= new Connection();
					 
					 if($connect->connectdb("db_recordings"))
					{
							$user = $_COOKIE['user'];
							$result = mssql_query("select * from rec_user where username='$user'")or die("ERROR!");
							$count = mssql_num_rows($result);
							if ($count == 1)
							{	
								$row = mssql_fetch_array($result);
								$id = $row['id'];
								$activity = "PLAY";
								$info_save= $filename_save."_".$format_date;
								$sql= "insert into rec_logs(userId,logDate,logDetail,otherDetail) values('".$id."',GETDATE(),'".$activity."','".$info_save."')";
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
		}else
		{
			 echo "File Error!";
		}
	
?>
  
</div>
<br /><br />
<div style="color: #4169E1; font-family: 'Lucida Grande','Lucida Sans Unicode',Verdana,Arial,Helvetica,sans-serif; font-size: 12px; background-color: #FFD2D2; width: 230px; border: solid 1px #000283; padding: 5px">Dont see or hear any recording? Please report it immediately in IT Department.</div>
<br />
<?php include ("templates/footer.php"); ?>
</center>
</body>
</html>
