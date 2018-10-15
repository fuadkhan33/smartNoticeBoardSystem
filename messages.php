<?php
	include("User.php");
	session_start();
	if(!isset($_SESSION['assocForBasicUser'])){
		header("Location: index.php");
	}
	
	$assoc = $_SESSION['assocForBasicUser'];
	$basicUser = new BasicUser;
	//get all query result first for get message by *this user id
	$queryResult = $basicUser->getAllMessageQueryResult($assoc['user_id']);
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
				<div class="col-sm-7 col-sm-offset-1 col-md-8 col-md-offset-1 main">
				  <!-- container-->
					<h2 align="center">All Messages</h2>
					<a href="newMessage.php"><button type="button"  class="btn btn-success">Send New Message</button></a>

					<table class="table table-bordered">
						<tbody><tr class="success">
							<th width="7%">Sr.No</th>
							<th width="8%">User Id</th>
							<th width="64%">Message</th>
							<th width="21%">Date</th>
							</tr>
							
							<?php
								$counter = 0;
								while($messageAssoc = mysqli_fetch_assoc($queryResult)){
								$counter++;
								
							?>
									<tr><td><?php echo("<p>".$counter."</p>")?></td><td><?php echo("<p>".$messageAssoc['sender']."</p>");?></td><td><?php echo("<p>".$messageAssoc['message_body']."</p>");?></td><td><?php echo("<p>".$messageAssoc['sent_time']."</p>");?></td>
									<td><a href="deleteMessages.php?message_id=<?php echo($messageAssoc['message_id'])?>" >Delete</a></td>
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