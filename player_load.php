<?php
		 session_start();
     if(session_is_registered('username'))
		{
 		 
		}else
		{
			header("location:index.php");
		}
?>

<?php
		$filename_save = $_GET['filename_save'];
		$date=substr($Record_Date = $_GET['Recorded_Date'],0,11);
		$date2 = new DateTime($date); 
 	 	$format_date=date_format($date2, 'Ymd');
		$recording = $_GET['fileplay'];
?>