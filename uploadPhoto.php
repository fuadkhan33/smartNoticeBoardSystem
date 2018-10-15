<?php
	include("User.php");
	session_start();
	if(!isset($_SESSION['assocForBasicUser'])){
		header("Location: index.php");
	}
	
	$basicUser = new BasicUser;
	$assoc = $_SESSION['assocForBasicUser'];
	
	$error = array();
	if($_POST){
		$error=$basicUser->updateUserPhotos($_FILES,$assoc['user_id'],$assoc['user_image_path']);
		sleep(2);
		$assoc = $basicUser->getAssocRow($assoc['user_id']);
		$_SESSION['assocForBasicUser']=$assoc;
	}
	
?>
<!DOCTYPE html>

<html lang="en">
	<head>
	<title>Home</title>
   	
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
				<div class="col-sm-7 col-sm-offset-1 col-md-8 col-md-offset-1 main">
				  <!-- container-->
					<h2 align="center">Upload Your Photo</h2>
					<form method="post" enctype="multipart/form-data" action="uploadPhoto.php">
						<table class="table table-bordered">
							<tbody><tr>
								<td colspan="2"></td>
							</tr>

							<tr>
								<td>Choose Your pic</td>
								<td><input class="form-control" type="file" name="image" required></td>
							</tr>

							<tr>


								<td colspan="2" align="center">
								<input type="submit" class="btn btn-default" value="Update My Profile Pic" name="update">

								</td>
							</tr>
						</tbody></table>
						<?php 
							if(isset($error['success'])){
								echo($error['success']);
							}
							if(isset($error['error'])){
								echo($error['error']);
							}
						?>
					</form>
				</div>
			</div>
    	</div>
	</body>
</html>