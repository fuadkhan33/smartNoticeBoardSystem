<?php
	include("User.php");
	session_start();
	if(!isset($_SESSION['assocForBasicUser'])){
		header("Location: index.php");
	}
	
	$assoc = $_SESSION['assocForBasicUser'];
	$basicUser = new BasicUser;
	if($_POST){
		$error=$basicUser->passwordValidation($assoc['user_id'],$_POST);
	}
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
         <h2 align="center">Update Password</h2>
          <!-- container-->
		  		  <script async="" src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- new header responsive -->
<ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-6338063578832547" data-ad-slot="5149371714" data-ad-format="auto"></ins>

<form method="post" action="<?php echo($_SERVER['PHP_SELF']);?>">
	
	<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-4"></div>
	</div>
	
	
	
	<div class="row">
		<div class="col-sm-4">Enter YOur Old</div>
		<div class="col-sm-5">
		<input type="password" name="op" class="form-control"></div>
		<?php if(isset($error['op'])){echo($error['op']);}?>
	</div>
	
	<div class="row">
		<div class="col-sm-4">Enter YOur New Password</div>
		<div class="col-sm-5">
		<input type="password" name="np" class="form-control"></div>
		<?php if(isset($error['np'])){echo($error['np']);}?>
	</div>
	
	<div class="row">
		<div class="col-sm-4">Enter YOur Confirm Password</div>
		<div class="col-sm-5">
		<input type="password" name="cp" class="form-control"></div>
		<?php if(isset($error['cp'])){echo($error['cp']);}?>
	</div>
	<div class="row" style="margin-top:10px">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
		
		
		<input type="submit" value="Update Password" name="save" class="btn btn-success">
		<input type="reset" class="btn btn-success">
		</div>
	</div>
	<?php if(isset($error['success'])){echo($error['success']);}?>
</form>	          
         
        </div>
			</div>
    	</div>
	</body>
</html>