<div class="col-sm-3 col-md-2 sidebar">
					<br>
					<br>
					<br>
					  <ul class="nav nav-sidebar">
						<?php
							if($assoc['user_type']==1){ ?>
						<li style="border: 2px solid blue;"><a href="dashBoard.php"><h4>Dashboard</h4> <span class="sr-only"></span></a></li>
						 <?php
							}
						?>
									<li><a href="uploadPhoto.php"><img title="Update Your profile pic Click here" style="border-radius:50px" src="<?php echo($assoc['user_image_path'])?>" width="100" height="100" alt="not found"></a></li>

						
						<!--		<li><a href="dashboard.php"><h1 style="color: red;" >Dashboard</h1></a></li>  -->
						
						<li><a href="updatePassword.php"><span class="glyphicon glyphicon-user"></span> Update Password</a></li>
						<li><a href="updateProfile.php"><span class="glyphicon glyphicon-user"></span> Update Profile</a></li>
						 <li><a href="messages.php"><span class="glyphicon glyphicon-envelope"></span> Messages</a></li>
						 <?php 
								if($assoc['user_type']==1){?>
									<li><a href="newNotice.php"><span class="glyphicon glyphicon-envelope"></span>New Notice</a></li>
									<?php
								}
						  ?>

					  </ul>

         
      			</div>