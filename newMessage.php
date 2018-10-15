<?php
	include("User.php");
	session_start();
	if(!isset($_SESSION['assocForBasicUser'])){
		header("Location: index.php");
	}
	
	$assoc = $_SESSION['assocForBasicUser'];
	$adminUser = new AdminUser;
	$error= array();
	$thisUser = $assoc['user_id'];
	if($_POST){
		if(isset($_POST['user_select'])){
			if($_POST['user_select']=='one_user'){
				$error = $adminUser->validationAndSendMessageToParticularUser($_POST,$thisUser);
			}
			if($_POST['user_select']=='all_user'){
				$error = $adminUser->sendMessageToAllUser($_POST['message'],$thisUser);
			}
		} else {
			$error = $adminUser->validationAndSendMessageToParticularUser($_POST,$thisUser);
		}
		
	}
?>
<!DOCTYPE html>

<html lang="en">
	<head>
	<title>New Messages</title>
    <?php include "bootstrapIncluder.php"?>
	<script>
		function uncheckAllUser(){
			document.getElementById('all_user').checked = false;
			document.getElementById('one_user').checked = true;
		}
		function uncheckOneUser(){
			document.getElementById('one_user').checked = false;
			document.getElementById('all_user').checked = true;
		}
		</script>
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
      			<H2 align="center">Send New Message</H2>
				<div class="col-sm-7 col-sm-offset-1 col-md-8 col-md-offset-1 main">
					<form class="form-horizontal" role="form" method="post" action="newMessage.php">
					<?php
						if($assoc['user_type']==1){
					?>
						  <label><input onClick="uncheckAllUser()" type="checkbox" value="one_user" name="user_select" id="one_user" checked>Specific User</label>
						  <label><input onClick="uncheckOneUser()" type="checkbox" value="all_user" name="user_select" id="all_user">All User</label>
					<?php
						}
					?>
						<div class="form-group">
							<label for="name" class="col-sm-2 control-label">username</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="name" name="username" placeholder="First & Last Name" value="">
							</div>
						</div>
						<div class="form-group">
							<label for="message" class="col-sm-2 control-label">Message</label>
							<div class="col-sm-10">
								<textarea name="message" id="message" type="text" class="form-control" rows="3" placeholder="What's up?"></textarea>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-10 col-sm-offset-2">
								<input id="submit" name="submit" type="submit" value="Send" class="btn btn-primary">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-10 col-sm-offset-2">
								<?php
									if(count($error)>0){
										if($error['error']!=""){
										echo($error['error']);
										} else {
											echo($error['success']);
										}
									}	
								?>
							</div>
						</div>
					</form>
				</div>
			</div>
    	</div>
	</body>
</html>