<?php
	session_start();
     if(!session_is_registered('username1'))
		{
 		 header("location:admin.php");
		}
?>
	<?php 
         
          if(isset($_POST['Register']))
          {
             $user=trim($_POST['username']);
             $password=trim($_POST['password']);
             $conpass=trim($_POST['confirm']);
             $name=trim($_POST['name']);
             $permission=$_POST['permission'];
         
            include ("includes/admin_class.php");
              $check= new Check();
              $check->register($user,$password,$conpass,$name,$permission);
          }
        
       ?>
     
<?php include ("templates/template.php"); ?>
<div class="liner"></div>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Online Recordings Registration</title>


<body> 		
<center>
    <div style="width: 1200px;">
      <div class="leftcontent">
        <?php include ("templates/navigation.php"); ?>
      </div>
       <div class="rightcontent">
       <br />
          <form action="" method="post" style="margin:0; padding:0;">
             <div class="reg_container">
               <div class="top">
                <font color="#FFFBF0" size="3" face="Arial Rounded MT Bold">
                    Admin Sign Up
                 </font>
               </div>
               <div class="reg_back">
                 <div class="welcome">
                  <font color="#FFFFFF">
                    Welcome to NorthStar Solutions Online Recordings User Registration Form. To continue, please fill up the blank                    fields
                  </font>
                  </div>
                  <table>
                  <tr>
                  	<td>
                     <div class="form_lbl" align="left"> 
                     <strong>
                       Username:
                     </strong>
                     </div>
                    </td>
                    <td>
                    	<input name="username" type="text" style="width: 150px;">
                    </td>
                  </tr>
                  <tr>
                    <td>
                       <div class="form_lbl" align="left"> 
                         <strong>
                          Password:
                         </strong>
                       </div>
                    </td>
                    <td>
                    	<input name="password" type="password" style="width: 150px;">
                    </td>
                  </tr>
                    <tr>
                    <td>
                    	 <div class="form_lbl" align="left"> 
                         <strong>
                          Confirm_Password:
                         </strong>
                       </div>
                    </td>
                    <td>
                    	<input name="confirm" type="password" style="width: 150px;">
                    </td>
                  </tr>
                  <tr>
                    <td>
                    	 <div class="form_lbl" align="left"> 
                         <strong>
                          Name:
                         </strong>
                       </div>
                    </td>
                    <td>
                    	<input name="name" type="text" id="name" style="width: 150px;">
                    </td>
                  </tr>
                  <tr>
                    <td>
                       <div class="form_lbl" align="left"> 
                        <strong>
                         	Permission:
                        </strong>
                      </div>
                    </td>
                    <td>
                     	<strong>Yes</strong>
                     	<input name="permission" type="radio" id="radio" value="1" />
                      <strong>No</strong>
                      <input name="permission" type="radio" id="radio2" value="0" checked="checked" />
                    </td>
                  </tr>
                  <tr>
                    <td>
                    	<div class="error_msg">
												<?php echo $_COOKIE['error_msg']; $_COOKIE['error_msg'] = "";?>
                      </div>
                    </td>
                    <td>
                    	<div class="reg_button">
                      <input name="Register" type="submit" id="Register" value="Register" style="width:70px; float:right;"/>
                     </div>
                    </td>
                  </tr>
                  </table>
          </div>  
       </div> 
      </form> 
     </div>
  </div>
</center>   
 <?php include ("templates/footer.php"); ?>
</body>
</html>

