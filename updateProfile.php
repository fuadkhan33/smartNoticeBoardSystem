<?php
	include("User.php");
	session_start();
	if(!isset($_SESSION['assocForBasicUser'])){
		header("Location: index.php");
	}
	
	$assoc = $_SESSION['assocForBasicUser'];
	$basicUser = new BasicUser;
	$error = array();
	
	
?>
<!DOCTYPE html>

<html lang="en">
	<head>

    <?php include "bootstrapIncluder.php"?>
  </head>
	<body>
		<nav class="navbar navbar-inverse navbar-fixed-top">
       		<div class="container-fluid">
       			 <div class="navbar-header">
         			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
 					 	<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
          			</button>
          			<a class="navbar-brand" href="home.php">Hello <?php echo($assoc['name'])?></a>
       			 </div>
        		 <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
           
            <li><a href="logout.php">Logout <?php echo($assoc['user_id'])?></a></li>
          </ul>
          <!--<form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>-->
        </div>
      		</div>
    	</nav>
		<div class="container-fluid">
      		<div class="row">
        		<?php include "sidebar.php" ?>
      			<br>
      			<br>
      			<br>
      			<br>
      			<div class="col-sm-8 col-sm-offset-1 col-md-6 col-md-offset-2 main">
					<div align="center" class="col-sm-12 ">
                       <a href="<?php echo($assoc['user_image_path'])?>"><img title="Update Your profile pic Click here" style="" src="<?php echo($assoc['user_image_path'])?>" width="100" height="100" alt="not found"></a>
                        <h4><?php echo($assoc['name'])?></h4>
                       
                        <p>
                            <i class="glyphicon glyphicon-envelope"></i><?php echo($assoc['email'])?>
                            <br />
                            
                            <i class="glyphicon glyphicon-gift"></i><?php echo($assoc['create_time'])?></p>
                        <!-- Split button -->
                        
                    </div>
          <!-- container-->
		  		  <script async="" src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- new header responsive -->
<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-6338063578832547" data-ad-slot="5149371714" data-ad-format="auto"></ins>

		<?php
			if($_POST){
				$error=$basicUser->updateUserFormValidationAndUpdate($assoc['user_id'],$_POST);
				//echo($error['error']);
			}
					?>
		<h2 align="center">Update Your Profile</h2>
		<form method="post" action="<?php echo($_SERVER['PHP_SELF'])?>">
			<table class="table table-bordered">
	<tbody><tr>
		<td colspan="2"></td>
	</tr>
				
				<tr>
					<td>Enter Your name</td>
					<td><input class="form-control" value="" required type="text" name="n"></td>
				</tr>
				<tr>
					<td>Enter Your email </td>
					<td><input class="form-control" required type="email"  value="" name="e"></td>
				</tr>
				
				
				
				
				<tr>
					<td>Select Your Gender</td>
					<td>
				Male<input type="radio" name="gen" value="m" checked>
				Female<input type="radio" name="gen" value="f">	
					</td>
				</tr>
				
				
				
				
				
				
				<tr>
					
					
<td colspan="2" align="center">
<input type="submit" class="btn btn-default" value="Update My Profile" name="update">
<input type="reset" class="btn btn-default" value="Reset">
				
					</td>
				</tr>
			</tbody></table>
		</form>
	    <?php 
			if(isset($error['success'])){
					echo("<p style='color:green;'>".$error['success']."</p>");
				}
		?>  
         
        </div>
      			
			</div>
  			
   			
    	</div>
    	
	</body>
</html>