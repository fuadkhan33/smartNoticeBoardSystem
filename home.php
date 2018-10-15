<?php
	include("User.php");
	session_start();
	if(!isset($_SESSION['assocForBasicUser'])){
		header("Location: index.php");
	}
	
	$assoc = $_SESSION['assocForBasicUser'];
	$basicUser = new BasicUser;
	$adminUser = new AdminUser;
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
							<th width="15%">Sr.No</th>
							<th width="15%">Notice Title</th>
							<th width="47%">Details</th>
							<th width="16%">Date</th>
							</tr>
							<?php
								$result = $basicUser->getAllDataFromNoticeBoardQueryResult();
								$counter = 0;
								while($row=mysqli_fetch_assoc($result)){
									$counter++;
							?>

									<tr><td><?php echo("<p>".$counter."</p>")?></td><td><?php echo("<p>".$row['notice_title']."</p>");?></td><td><?php echo("<p>".$row['notice_body']."</p>");?></td><td><?php echo("<p>".$row['create_time']."</p>");?></td><?php 
									if($assoc['user_type']==1){?>
									 	<td width="7%"><a href="deleteNotice.php?noticeID=<?php echo($row['notice_id'])?>"><p>Delete</p></a></td>
									<?php
									} 
									?>
							</tr>
										
							<?php
								}
							?>	
						</tbody>
					</table> 
				</div>
			</div>
    	</div>
	</body>
</html>