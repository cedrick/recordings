<html>
<head>
<title>LOGS</title>
</head>
<body>
  <center>
			<?php
        session_start();
           if(!session_is_registered('username1'))
          {
           header("location:admin.php");
          }
      ?>
      <?php include ("templates/template.php"); ?>
		<div class="liner"></div>
    <div style="width: 1200px;">
    	<div class="leftcontent">
      	<?php 
					include ("templates/navigation.php"); 
				?>
      </div>
      <div class="rightcontent">
      	<?php 
					include"includes/admin_class.php";
					$check= new Check();
					echo $check->manageuser2();
      	?> 
      </div>
    </div>
		<?php include ("templates/footer.php"); ?>    
    
  </center>
</body>
</html>
