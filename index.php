<?php
		 session_start();
     if(session_is_registered('username'))
		{
 		 header("location:main.php");
		}else
		{
			
		}
	?>	
<?php
		if(isset($_POST['login']))
				{
				$user=trim($_POST['username']);
				$password=trim($_POST['password']);
				include ("includes/rec_class.php");
				$check= new Check();
				$check->login($user,$password);
				}
?>


<html>
<head>
<style type="text/css">
body,td,th {
	color: #000;
}
body {
	background-color: #FFF;
}
a:link {
	color: #FFF;
	text-decoration: none;
}
a:visited {
	color: #FFF;
	text-decoration: none;
}
a:hover {
	color: #FFF;
	text-decoration: none;
}
a:active {
	color: #FFF;
	text-decoration: none;
}
</style>
<?php include ("templates/template.php"); ?>
<div class="liner"></div>
<title>Log In</title>
	<link rel="stylesheet" type="text/css" href="../recordings_trial/stylesheet.css" >
</head>

<body>
<center>
   <br /> <br /> <br />
  <form method="POST" action="" style="margin:0; padding:0;">
    <div class="login">
      <div class="top"><font color="#FFFBF0" size="3" face="Arial Rounded MT Bold">Login</font></div>
      <div class="logback">
        <br />
        <div class="welcome">
          <font color="#FFFFFF">
          Welcome to NorthStar Solutions Online Recordings. To continue, please input your username and password.
          </font>
        </div><br /><br /> 
        <table>
        	<tr>
          	<td>
            	<div class="form_lbl"> 
                <font color="#FFFFFF">
                  <strong>Username:</strong>
                </font>      
              </div>
            </td>
            <td>
            	<div class="form_field">
                <input type="text" size="20" name="username" style="width: 150px;" />
              </div>
            </td>
          </tr>
          <tr>
          	<td>
            	<div class="form_lbl">          
                <font color="#FFFFFF">
                <strong>Password:</strong>
                </font>
              </div>
            </td>
            <td>
            	<div class="form_field">
                <input type="password" size="20" name="password" style="width: 150px;" />
              </div>
            </td>
          </tr>
          <tr>
          	<td></td>
            <td>
            	<div class="submit">
                <input type="submit" value="Log In" name="login" id="login" style="width:70px;"/>
              </div>
            </td>
          </tr>
          <tr>
          	<td></td>
            <td>
            	<div class="error_msg">
                <font color="#800000" face="Arial"size="2">
                  <?php echo $_COOKIE['error_msg']; $_COOKIE['error_msg'] = "";?>
                 </font>
              </div>
            </td>
          </tr>
        </table>
        </div>
      </div> 
   </form>
</center>        


</body>
</html>

<?php include ("templates/footer.php");?>  