
<?php
 
 include ("connection.php");
Class Check extends Connection
{
    function login($user,$password)
	{	
		if($this->connectdb("db_recordings"))
		{
			$user=$this->escape_string($user);
			$password=$this->escape_string($password);
			$key="NORTHSTAR";
			$password=md5($password.$key);
			$result= mssql_query("select * from rec_admin where username1='$user' and password='$password'")or die("ERROR!");
			$count=mssql_num_rows($result);
			if ($count==1 && $user!= NULL && $password!= NULL)
			{	
				$row=mssql_fetch_array($result);
				$id=$row['id'];
				$login="LOGIN";
				$sql="insert into rec_logs(userId,logDate,logDetail) values('".$id."',GETDATE(),'".$login."')"; 
				if (mssql_query($sql))
				{
					
							setcookie('user',$user);
			        session_register("username1");
			        header("location:admin_portal.php");
					
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
			$sql= mssql_query("select * from rec_admin where username1='$user'")or die("ERROR!");
			if(mssql_num_rows($sql)== 0 && $user!=NULL && $password!= NULL  )
			
			{
				if($password==$conpass)
				{
					$key="NORTHSTAR";
			   		$password=md5($password.$key);
					$sql="insert into rec_admin(username1, password,name,rdate,allowsave) values('".$user."','".$password."',                 	'".$name."',GETDATE(),'".$permission."')"; 
			
					if (mssql_query($sql))
					{
						$_COOKIE['error_msg'] = '<font color=#99FFFF face=Arial size=2>'.$user.'&nbsp;is now registered!</font>';
					}else
					{
				    	$_COOKIE['error_msg'] = "<font color=#800000 face=Arial size=2>Registration Failed!</font>";
					}
				}else
			  {
				 	$_COOKIE['error_msg'] = "<font color=#800000 face=Arial size=2>Password do not match!</font>";
			  }
				
				 
			}else
			{
					$_COOKIE['error_msg'] = "<font color=#800000 face=Arial size=2>Existing Username/field error!</font>";		
			}
			
		}else
		{
				$_COOKIE['error_msg'] = "<font color=#800000 face=Arial size=2>Database Error!</font>";		
		}	
			
				$this->closedb();
		}
	
	
	function escape_string($string)
	{
	  
	 	return str_replace("'","''",$string);
	}
	 
	
	
	 function logout()
	 {
		 if($this->connectdb("db_recordings"))
		{
			$user=$_COOKIE['user'];
		    $result= mssql_query("select * from rec_admin where username1='$user'")or die("ERROR!");
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
					header("location:admin.php");

					
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
	 }
	 
	 
	 function manage_user1()
	 {
		
		 if($this->connectdb("db_recordings"))
		 {
			 
					//This checks to see if there is a page number, that the number is not 0, and that the number is actually a number. If not, it will set it to page number to 1.
		if ((!isset($_GET['pagenum'])) || (!is_numeric($_GET['pagenum'])) || ($_GET['pagenum'] < 1)) { $pagenum = 1; }
		else { $pagenum = $_GET['pagenum']; }
		
		//Now you can use this query to see how many rows you are dealing with
//Edit $result as your query
		$result = mssql_query ("SELECT * FROM rec_user") or die(mssql_error());
		$rows = mssql_num_rows($result);
		
		//This is the number of results displayed per page 
	    $page_rows=10;
		
		
		//This tells us the page number of our last page 
		$last = ceil($rows/$page_rows);
		
		//Seeing if the current page we are on is the last
		if (($pagenum > $last) && ($last > 0))
		    { 
			 $pagenum = $last;
		    }
			
	  //This sets the range to display in our query 
     $max = ($pagenum - 1) * $page_rows;
       
	   
	   //This is your query again, just spiced up a bit
//mssql doesnt have that nice limit ability like mysql... so we use this to make it work...
//the way the table is designed is, "id" is the unique id, and "name" is just a list of names i have in there.
	$result2 = mssql_query("select top $page_rows * from rec_user where id not in (select top $max id from rec_user order by id asc) order by id asc") or die(mssql_error());
	
	
	//This is where you show your results
					echo '<br>'.'<br>';
	        echo "<table width=800 border=0 align=center cellspacing=1 bgcolor=	#AFC7C7>";
					echo"<td>"."<b>"."USER_ID"."</b>"."</td>";
					echo"<td>"."<b>"."USER_NAME"."</b>"."</td>";
					echo"<td>"."<b>"."NAME"."</b>"."</td>";
					echo"<td>"."<b>"."DATE" ."</b>"."</td>";
					echo"<td>"."<b>"."PERMISSION" ."</b>"."</td>";
					echo"<td>"."<b>"."SET_PERMISSION" ."</b>"."</td>";
					echo"<td>"."<b>"."DELETE" ."</b>"."</td>";
					
					while($row=mssql_fetch_array($result2))
						{
							
							if($row['id']%2==0)
								{$color=" bgcolor = '#a19f9e' ";}
								else{$color=" bgcolor='#FFF5EE'";}
							echo '<tr'.$color.'>';
							echo"<td>". $row['id'] ."</td>";
							echo"<td>". $row['username'] ."</td>";
							echo"<td>". $row['name'] ."</td>";
							echo"<td>". $row['rdate'] ."</td>";
							echo"<td>". $row['allowsave'] ."</td>";
							$checked1 = NULL; $checked2 = NULL;
							$row['allowsave'] == 1 ? $checked1 = 'checked = "checked"' : $checked2 = 'checked = "checked"';
							echo "<td>".'<a href="update.php?id='.$row['id'].'&value=1">'
																.	"Yes".
															'<input name="'.$row['id'].'" type="radio" id="'.$row['id'].'" value="1" '.$checked1.'/>'.
														
														'</a>'.'<a href="update.php?id='.$row['id'].'&value=0">'
    												  	."No".
        											'<input name="'.$row['id'].'" type="radio" id="'.$row['id'].'" value="0" '.$checked2.' />'.
														'</a>'.
										"</td>";
							echo"<td>". '<a href=delete.php?id='.$row['id'].'>'.
														'<img src="templates/images/Delete.png" width="25" height="25" border="0" />'.
													'<a/>' .
									"</td>";
							echo"</tr>";

						}
	    				 echo "</table>";
	
	

      	 // This shows the page they are on, and the total number of pages
		echo " --Page $pagenum of $last-- <p>";
		
		// First we check if we are on page one. If we are then we don't need a link to the previous page or the first page so we do nothing. If we aren't then we generate links to the 

         if($pagenum==1)
		{

        }
		
		else{
			  echo " <a href='{$_SERVER['PHP_SELF']}?pagenum=1'> <<-First</a> ";
				echo " ";
				$previous = $pagenum-1;
				echo " <a href='{$_SERVER['PHP_SELF']}?pagenum=$previous'> <-Previous</a> ";
			}
		 //just a spacer
        echo " ---- ";
		
		
		
		 if($pagenum==$last)
		{

        }
		
		else{
			  	$next = $pagenum+1;
				echo " <a href='{$_SERVER['PHP_SELF']}?pagenum=$next'>Next -></a> ";
				echo " ";
				echo " <a href='{$_SERVER['PHP_SELF']}?pagenum=$last'>Last ->></a> ";
			}
			
			 
			  $this->closedb();
		 }
		 else{echo'<div class="counter">'. "Database error".'</div>';}
		 
	 }
	 
	 
	 
	 
	 function manageuser2()
	 {
		 if($this->connectdb("db_recordings"))
		 {
			 
					//This checks to see if there is a page number, that the number is not 0, and that the number is actually a number. If not, it will set it to page number to 1.
		if ((!isset($_GET['pagenum'])) || (!is_numeric($_GET['pagenum'])) || ($_GET['pagenum'] < 1)) { $pagenum = 1; }
		else { $pagenum = $_GET['pagenum']; }
		
		//Now you can use this query to see how many rows you are dealing with
//Edit $result as your query
		$result = mssql_query ("SELECT * FROM rec_logs") or die(mssql_error());
		$rows = mssql_num_rows($result);
		
		//This is the number of results displayed per page 
	    $page_rows=10;
		
		
		//This tells us the page number of our last page 
		$last = ceil($rows/$page_rows);
		
		//Seeing if the current page we are on is the last
		if (($pagenum > $last) && ($last > 0))
		    { 
			 $pagenum = $last;
		    }
			
	  //This sets the range to display in our query 
     $max = ($pagenum - 1) * $page_rows;
       
	   
	   //This is your query again, just spiced up a bit
//mssql doesnt have that nice limit ability like mysql... so we use this to make it work...
//the way the table is designed is, "id" is the unique id, and "name" is just a list of names i have in there.
	$result2 = mssql_query("select top $page_rows * from rec_logs where logid not in (select top $max logid from rec_logs order by logdate asc) order by logdate desc") or die(mssql_error());
	
	
	//This is where you show your results
					echo '<br>'.'<br>';
	        echo "<table width=900 border=0 align=center cellspacing=1 bgcolor=	#AFC7C7>";
					echo"<td>"."<b>"."LOG_ID"."</b>"."</td>";
					echo"<td>"."<b>"."USER_ID"."</b>"."</td>";
					echo"<td>"."<b>"."LOG_DATE" ."</b>"."</td>";
					echo"<td>"."<b>"."LOG_DETAIL" ."</b>"."</td>";
					echo"<td>"."<b>"."OTHER_DETAIL" ."</b>"."</td>";
					while($row=mssql_fetch_array($result2))
						{
							if($row['logId']%2==0)
								{$color=" bgcolor = '#a19f9e' ";}
								else{$color=" bgcolor='#FFF5EE'";}
							echo '<tr'.$color.'>';
							echo"<td>". $row['logId'] ."</td>";
							echo"<td>". $row['userId'] ."</td>";
							echo"<td>". $row['logDate'] ."</td>";
							echo"<td>". $row['logDetail'] ."</td>";
							echo"<td>". $row['otherDetail'] ."</td>";
		
							echo"</tr>";

						}
	    				 echo "</table>";
	
	

      	 // This shows the page they are on, and the total number of pages
		echo " --Page $pagenum of $last-- <p>";
		
		// First we check if we are on page one. If we are then we don't need a link to the previous page or the first page so we do nothing. If we aren't then we generate links to the 

         if($pagenum==1)
		{

        }
		
		else{
			  	echo " <a href='{$_SERVER['PHP_SELF']}?pagenum=1'> <<-First</a> ";
				echo " ";
				$previous = $pagenum-1;
				echo " <a href='{$_SERVER['PHP_SELF']}?pagenum=$previous'> <-Previous</a> ";
			}
		 //just a spacer
        echo " ---- ";
		
		
		
		 if($pagenum==$last)
		{

        }
		
		else{
			  	$next = $pagenum+1;
				echo " <a href='{$_SERVER['PHP_SELF']}?pagenum=$next'>Next -></a> ";
				echo " ";
				echo " <a href='{$_SERVER['PHP_SELF']}?pagenum=$last'>Last ->></a> ";
			}
			
			 
			  $this->closedb();
		 }
		 else{echo'<div class="counter">'. "Database error".'</div>';}
		 
	}
	 
	 
}
?>