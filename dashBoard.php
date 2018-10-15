<?php
	include("User.php");
	session_start();
	if(!isset($_SESSION['assocForBasicUser'])){
		header("Location: index.php");
	}
	$assoc = $_SESSION['assocForBasicUser'];
	if($assoc['user_type']==0){
		header("Location: index.php");
	}
	$AdminUser = new AdminUser;
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
					<h2>All Notice</h2>

					<table class="table table-bordered">
						<tbody><tr class="success">
							<th width="9%">Sr.No</th>
							<th width="18%">Username</th>
							<th width="24%">Name</th>
							<th width="28%">Email</th>
							<th width="21%">Registered Time</th>
							</tr>
							<?php
								$result = $AdminUser->getAllUserResult();
								$counter = 0;
								while($row=mysqli_fetch_assoc($result)){
									$counter++;
									if($row['user_type']==0){
							?>

									<tr><td><?php echo("<p>".$counter."</p>");?></td>
										<td><?php echo("<p>".$row['user_id']."</p>");?></td>
										<td><?php echo("<p>".$row['name']."</p>");?></td>
										<td><?php echo("<p>".$row['email']."</p>");?></td>
										<td><?php echo("<p>".$row['create_time']."</p>");?></td>
										<td><a href="deleteUser.php?userID=<?php echo($row['user_id']);?>">Delete User</a></td>
									</tr>	
							<?php
									}
								}
							?>	
						</tbody>
					</table> 
				</div>
			</div>
    	</div>
	</body>
</html>