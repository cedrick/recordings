<?php
 
include ("connection.php");
Class Check extends Connection
{
    //function for login
	function login($user,$password)
	{	
		if($this->connectdb("db_recordings"))
		{
			$user=$this->escape_string($user);
			$password=$this->escape_string($password);
			//$key="NORTHSTAR";
			//$password=md5($password.$key);
			$password=md5($password);
			$result= mssql_query("select * from rec_user where username='$user' and password='$password'")or die("ERROR!");
			$count=mssql_num_rows($result);
			if ($count==1 && $user!= NULL && $password!= NULL)
			{	
				$row=mssql_fetch_array($result);
				$id=$row['id'];
				$login="LOGIN";
				$sql="insert into rec_logs(userId,logDate,logDetail) values('".$id."',GETDATE(),'".$login."')"; 
				if (mssql_query($sql))
				{
					
					
		  		 $result= mssql_query("select * from rec_user where username='$user'")or die("ERROR!");
					 $count=mssql_num_rows($result);
				    if ($count==1)
						{	
							
			       			header("location:index.php");
				
						}else
						{
							$_COOKIE['error_msg'] = "COOKIE Error!";
						}    
					
				}else
				{
				  $_COOKIE['error_msg'] = "Error Login!";
				}
			}else
			{
				$_COOKIE['error_msg'] = "Error Login!";
			}
		}else
		{
			$_COOKIE['error_msg'] = "Database Error!";
		}
	}
	
	
	//function for registration
	function register($user,$password,$conpass,$name,$permission)
	{
					
		if($this->connectdb("db_recordings"))
		{
			$user=$this->escape_string($user);
			$password=$this->escape_string($password);
			$conpass=$this->escape_string($conpass);
			$name=$this->escape_string($name);
			$sql= mssql_query("select * from rec_user where username='$user'")or die("ERROR!");
			if(mssql_num_rows($sql)== 0 && $user!=NULL && $password!= NULL && $user!= "admin" && $user!="Admin" && $user!="ADMIN"   )
			
			{
				if($password==$conpass)
				{
					//$key="NORTHSTAR";
			   		//$password=md5($password.$key);
					$password=md5($password);
					$sql="insert into rec_user(username, password,name,rdate,allowsave) values('".$user."','".$password."','".$name."',GETDATE(),'".$permission."')"; 
			
					if (mssql_query($sql))
					{
						$_COOKIE['error_msg'] = '<font color=#99FFFF face=Arial size=2>'.$user.'&nbsp;is now registered!</font>';
					}else
				
					{
				    	$_COOKIE['error_msg'] = "<font color=#800000 face=Arial size=2>Registration Failed!</font>";
					}
				}
				 else
			   		{
				  		$_COOKIE['error_msg'] = "<font color=#800000 face=Arial size=2>Password do not match!</font>";
			   		}
				
			}
			else
			   {
						$_COOKIE['error_msg'] = "<font color=#800000 face=Arial size=2>Existing Username/field error!</font>";		
			   }
			}else
			
			
		
			{
				 $_COOKIE['error_msg'] = "<font color=#800000 face=Arial size=2>Database Error!</font>";		
			}
				
				$this->closedb();
		}
	
	
	//function escape string
	function escape_string($string)
	{
	  
	 	return str_replace("'","''",$string);
	}
	 
	
	
	 //function for logout
	 function logout()
	 {
		 if($this->connectdb("db_recordings"))
		{
			$user=$_COOKIE['user'];
		    $result= mssql_query("select * from rec_user where username='$user'")or die("ERROR!");
			$count=mssql_num_rows($result);
			if ($count==1)
			{	
				$row=mssql_fetch_array($result);
				$id=$row['id'];
				$logout="LOGOUT";
				$sql="insert into rec_logs(userId,logDate,logDetail) values('".$id."',GETDATE(),'".$logout."')"; 
				if (mssql_query($sql))
				{
					
					session_start();
					session_destroy();
					$this->closedb();
					header("location:index.php");

					
				}else
				
				{
				  echo'<div class="counter">'. "Error Logout!".'</div>';
				}
		 
			}
			
		}
		else
		
			{
				echo'<div class="counter">'. "Database error".'</div>';
			}
	 $this->closedb();
	 }
	 
	 
	 //function for search
	 function main($search,$rad_id,$rad_sort)
	 { 
		
	    if($this->connectdb("I3_IC"))
		{
	       
			$permission=$_COOKIE['allowsave'];
			$escape=$this->escape_string($search);
			$explode=explode(',',$escape);
		
		if($search!= NULL)
		{
				if($explode!= NULL && $rad_id==1 && $rad_sort==1)
					{
							$sorter.= " RecordingDate ";
							foreach ($explode as $array)
						{
							 $i++;
					
							if($i==1)
			  			{
								$query.= "ANI = '$array' ";
							}else
							{
								$query.= "  OR ANI = '$array' ";
							}
						}
		  		}elseif($explode!= NULL && $rad_id==1 && $rad_sort==0)
					{
							$sorter.= " ANI "; 
							foreach ($explode as $array)
						{
							 $i++;
						if($i==1)
							{
								$query.= "ANI = '$array' ";
							}else
							{
								$query.= "  OR ANI = '$array' ";		  
							}
						}
					}elseif($explode!= NULL &&$rad_id==0 && $rad_sort==1)
					{
							$sorter.= " RecordingDate "; 
							foreach ($explode as $array)
						{
							$i++;
						if($i==1)
							{
									$query.= " RecordedCallIDKey like '$array%' ";
							}else
							{
									$query.= "  OR RecordedCallIDKey like '$array%' ";    
							}
						}
				}elseif($explode!= NULL && $rad_id==0 && $rad_sort==0)
				{
					$sorter.= " ANI "; 
					foreach ($explode as $array)
						{
							$i++;
					if($i==1)
			  		{
								$query.= " RecordedCallIDKey like '$array%' ";
						}else
						{
								$query.= "  OR RecordedCallIDKey like '$array%' ";
						}
					}
				}
				
			$sql= "select ANI as Phone_Number,RecordedCallIDKey as CallId,RecordingTitle as CallTitle,RecordingFileSize as File_Size,RecordingTitle,RecordingDate as InitiatedDate,RecordingFileName from RecordingCall inner join RecordingData  on RecordingCall.RECORDINGID=RecordingData.RECORDINGID where $query order by $sorter asc ";  
		  	$result=mssql_query($sql);
			 	$count=mssql_num_rows($result);
			 	$counter="<b>Result</b>".":"." ".$count." "."Recordings Found!";
			 	echo '<div class="search_result">'.'<font color="#800000" face="Arial">'.'<center>'.$counter.'</center>'.'</font>'.'</div>';
				
				  	if($count>0)
						{   
					    $x=0; 
						echo "<table width=1000 border=0 align=center cellspacing=1 cellpadding=2 bgcolor=#A0C0FF style='font-size:12px'>";
						echo"<td>"."<b>"."#"."</b>"."</td>";
						echo"<td>"."<b>"."Phone&nbsp;number"."</b>"."</td>";
						echo"<td>"."<b>"."Call&nbsp;id"."</b>"."</td>";
						echo"<td>"."<b>"."Recording&nbsp;tittle"."</b>"."</td>";
						echo"<td>"."<b>"."File&nbsp;size" ."</b>"."</td>";
						echo"<td>"."<b>"."Call Date" ."</b>"."</td>";
						echo"<td>"."<b>"." Save" ."</b>"."</td>";
						echo"<td>"."<b>"." Play" ."</b>"."</td>";
						while($row=mssql_fetch_array($result))
							{
								
								if($x%2==0)
								{
									$color = " bgcolor = '#C6DEFF' ";
								}else
								{
									$color=" bgcolor='#FFF5EE'";
							  	}

				        		$x++;
								echo '<tr'.$color.'>';
								echo"<td>".$x."</td>";
								echo"<td>". $row['Phone_Number'] ."</td>";
								echo"<td>". substr($row['CallId'],0,10)."</td>";
								echo"<td>". $row['CallTitle'] ."</td>";
								echo"<td>". $row['File_Size'] ."</td>";
								echo"<td>". date('M d Y h:i A', strtotime($row['InitiatedDate']) + 28800) ."</td>";
								if($permission==1)
				  					{
										 if(substr($row ['RecordingFileName'],2,2)=='bi')
											{
											$location=$row ['RecordingFileName'];
											$filename = str_replace('\\', '/', '\\'.$location);
											echo "<td>".'<a href="saverecordings.php?filename_save='.$row['Phone_Number'].'_'.substr($row['CallId'],0,10).'&Recorded_Date='.$row['InitiatedDate'].'&file='.$filename.' "><img src="templates/images/Save.png" width="25" height="25" border="0"></a>';
											
										
								 			}
									}else{
						             echo"<td>".' <img src="templates/images/delete-icon.png" width="25" height="25" border="0" />'."</td>";
                       }
											 
											 	$locationplay=$row ['RecordingFileName'];
											$record = str_replace('\\', '/', '\\'.$locationplay);
											echo "<td>".'<a target="_blank" href="player.php?filename_save='.$row['Phone_Number'].'_'.substr($row['CallId'],0,10).'&Recorded_Date='.$row['InitiatedDate'].'&fileplay='.$record.' "><img src="templates/images/play.png" width="25" height="25" border="0"></a>';
								   
									
								echo"</tr>";

							}
	    				 	echo "</table>";
							
						}
					
				}else
				{
					echo $_COOKIE['error_msg']='<div class="search_result">'.'<font color="#800000" face="Arial">'.'<center>'."Record is not Existing!".'		 	  				</center>'.'</font>'.'</div>';;
				}
		   $this->closedb();
				
		}
		else
			{
				echo'<div class="counter">'. "Database error".'</div>';
			}
	 }
	 
	 
	 
	 function search_logs($search)
	 {
	   
	 if($this->connectdb("db_recordings"))
		{
			$user=$_COOKIE['user'];
		    $result= mssql_query("select * from rec_user where username='$user'")or die("ERROR!");
			$count=mssql_num_rows($result);
			if ($count==1)
			{	
				$row=mssql_fetch_array($result);
				$id=$row['id'];
				$activity="SEARCH";
				$info_search=$search;
				$search_string=$this->escape_string($info_search);
				$sql="insert into rec_logs(userId,logDate,logDetail,otherDetail) values('".$id."',GETDATE(),'".$activity."',                  '".$search_string."')"; 
				  mssql_query($sql);
				
			}
			
			else{echo'<div class="counter">'. "Search Log_Error".'</div>';}
			
		}
		else
		
			{
				echo'<div class="counter">'. "Database error".'</div>';
			}
		$this->closedb();
	 }
	 
	
 	function search_logs2($search,$start,$end)
	 {
	   
	 if($this->connectdb("db_recordings"))
		{
			$user=$_COOKIE['user'];
		    $result= mssql_query("select * from rec_user where username='$user'")or die("ERROR!");
			$count=mssql_num_rows($result);
			if ($count==1)
			{	
				$row=mssql_fetch_array($result);
				$id=$row['id'];
				$activity="SEARCH";
				$info_search=$search.$start.$end;
				$search_string=$this->escape_string($info_search);
				$sql="insert into rec_logs(userId,logDate,logDetail,otherDetail) values('".$id."',GETDATE(),'".$activity."','".$search_string."')"; 
				  mssql_query($sql);
				
			}
			
			else{echo'<div class="counter">'. "Search Log_Error".'</div>';}
			
		}
		else
		
			{
				echo'<div class="counter">'. "Database error".'</div>';
			}
		$this->closedb();
	 }
	 
	 function allowsave()
	{
		
		   $user=$_COOKIE['user'];
		   $result= mssql_query("select * from rec_user where username='$user'")or die("ERROR!");
			$count=mssql_num_rows($result);
			if ($count==1)
			{	
				$row=mssql_fetch_array($result);
				$permission=$row['allowsave'];
				setcookie('allowsave',$permission);
				
			}
			else{echo'<div class="counter">'. "COOKIE_ERROR!".'</div>';}
	
	}
	
	
	 //function for search
	 function agent_id($search,$start,$end)
	 { 
		
	    if($this->connectdb("I3_IC"))
		{
	       
			$permission=$_COOKIE['allowsave'];
			$escape_search=$this->escape_string($search);
			$escape_start=$this->escape_string($start);
			$escape_end=$this->escape_string($end);
		
		if($search!= NULL)
		{
				if($escape_search!= NULL && $escape_start!= NULL && $escape_end!=NULL)
					{
							$sorter.= " RecordingDate ";
							$query="LocalUserId ='$escape_search' and InitiatedDate>='$escape_start' and InitiatedDate <='$escape_end'";
							$sql="select RemoteNumber as Phone_Number,RecordedCallIDKey as CallId,RecordingFileName,RecordingTitle as CallTitle,RecordingFileName,RecordingFileSize as File_Size,InitiatedDate from calldetail inner join RecordingCall on calldetail.CallId = RecordingCall.RecordedCallIDKey inner join RecordingData on RecordingCall.RECORDINGID = RecordingData.RECORDINGID where RecordedCallIDKey=CallId and $query  order by RecordingDate,RemoteNumber,RecordingFileSize";
				$result=mssql_query($sql);
			 	$count=mssql_num_rows($result);
			 	$counter="<b>Result</b>".":"." ".$count." "."Recordings Found!";
			 	echo '<div class="search_result">'.'<font color="#800000" face="Arial">'.'<center>'.$counter.'</center>'.'</font>'.'</div>';
				
				  	if($count>0)
						{   
					    $x=0; 
						echo "<table width=1000 border=0 align=center cellspacing=1 cellpadding=2 bgcolor=#A0C0FF style='font-size:12px'>";
						echo"<td>"."<b>"."#"."</b>"."</td>";
						echo"<td>"."<b>"."Phone&nbsp;number"."</b>"."</td>";
						echo"<td>"."<b>"."Call&nbsp;id"."</b>"."</td>";
						echo"<td>"."<b>"."Recording&nbsp;tittle"."</b>"."</td>";
						echo"<td>"."<b>"."File&nbsp;size" ."</b>"."</td>";
						echo"<td>"."<b>"."Call Date" ."</b>"."</td>";
						echo"<td>"."<b>"." Save" ."</b>"."</td>";
						echo"<td>"."<b>"." Play" ."</b>"."</td>";
						while($row=mssql_fetch_array($result))
							{
								
								if($x%2==0)
								{
									$color = " bgcolor = '#C6DEFF' ";
								}else
								{
									$color=" bgcolor='#FFF5EE'";
							  	}

				        		$x++;
								echo '<tr'.$color.'>';
								echo"<td>".$x."</td>";
								echo"<td>". $row['Phone_Number'] ."</td>";
								echo"<td>". substr($row['CallId'],0,10)."</td>";
								echo"<td>". $row['CallTitle'] ."</td>";
								echo"<td>". $row['File_Size'] ."</td>";
								echo"<td>". date('M d Y h:i A', strtotime($row['InitiatedDate']) + 28800) ."</td>";
								if($permission==1)
				  					{
										 if(substr($row ['RecordingFileName'],2,2)=='bi')
											{
											$location=$row ['RecordingFileName'];
											$filename = str_replace('\\', '/', '\\'.$location);
											echo "<td>".'<a href="saverecordings.php?filename_save='.$row['Phone_Number'].'_'.substr($row['CallId'],0,10).'&Recorded_Date='.$row['InitiatedDate'].'&file='.$filename.' "><img src="templates/images/Save.png" width="25" height="25" border="0"></a>';
											
										
								 			}
									}else{
						             echo"<td>".' <img src="templates/images/delete-icon.png" width="25" height="25" border="0" />'."</td>";
                       }
											 
											 	$locationplay=$row ['RecordingFileName'];
											$record = str_replace('\\', '/', '\\'.$locationplay);
											echo "<td>".'<a target="_blank" href="player.php?filename_save='.$row['Phone_Number'].'_'.substr($row['CallId'],0,10).'&Recorded_Date='.$row['InitiatedDate'].'&fileplay='.$record.' "><img src="templates/images/play.png" width="25" height="25" border="0"></a>';
								   
									
								echo"</tr>";

							}
	    				 	echo "</table>";
							
						}
					
				}
					
				}else
				{
						echo $_COOKIE['error_msg']='<div class="search_result">'.'<font color="#800000" face="Arial">'.'<center>'."Record is not Existing!".'</center>'.'</font>'.'</div>';
					
				}
				
			//$sql= "select ANI as Phone_Number,RecordedCallIDKey as CallId,RecordingTitle as CallTitle,RecordingFileSize as File_Size,RecordingTitle,RecordingDate as InitiatedDate,RecordingFileName from RecordingCall inner join RecordingData  on RecordingCall.RECORDINGID=RecordingData.RECORDINGID where $query order by $sorter asc ";  
			
		//echo	$sql="select RemoteNumber as Phone_Number,RecordedCallIDKey as CallId,RecordingFileName,RecordingTitle as CallTitle,RecordingFileName,RecordingFileSize as File_Size,InitiatedDate from calldetail inner join  RecordingData on calldetail.CallId = RecordingCall.RecordedCallIDKey and RecordingData inner join RecordingCall on RecordingData.RECORDINGID = RecordingCall.RECORDINGID     where RecordedCallIDKey=CallId and RecordingId=RecordingId and $query order by RecordingDate,RemoteNumber,RecordingFileSize";
		  	
				
		   $this->closedb();
				
		}
		else
			{
				echo'<div class="counter">'. "Database error".'</div>';
			}
	 }
	 
	
}
?>