<?php 
	include("User.php");
	session_start();
	if($_POST){
		$basicUser = new BasicUser;
		$error=$basicUser->getRegistered($_POST,$_FILES);
		
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link href="styles/styles.css" type="text/css" rel="stylesheet" >
<script type="text/javascript"  src="js/js.js" ></script>
<script type="text/javascript"  src="js/jq" ></script>
<script type="text/javascript"  src="js/jquery-ui.js" ></script>
<script type="text/javascript"  src="js/jquery-ui.min.js" ></script>
<script>
	function maleUncheck(){
		document.getElementById("male").checked = false;
	}
	function femaleUncheck(){
		document.getElementById("female").checked = false;
	}
</script>
<?php include "bootstrapIncluder.php"?>
</head>

<body>
	<nav class="navbar navbar-default navbar-fixed-top" style="background:#000">
  <div class="container">
  
  <ul class="nav navbar-nav navbar-left">
    <li><a href="index.php"><strong>Smart Notice Board System</strong></a></li>
      
	  
	 
	
	</ul>


<ul class="nav navbar-nav navbar-right">
      <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
      <li><a href="index.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
       
    </ul>



</div>
</nav>
	<div class="login-page">
  <div class="form">
    <form action="<?php echo($_SERVER['PHP_SELF']) ?>" method="post" class="register-form" enctype="multipart/form-data" >
      <input type="text" name="username" value="<?php if(!empty($_POST['username'])){ echo($_POST['username']); }?>" placeholder="Username"/>
      <?php
		if(isset($error["username"])){
			echo("<p style='color:red'>".$error["username"]."</p>");
		}
		?>
      <input type="password" name="password" placeholder="Password"/>
      <?php
		if(isset($error["password"])){
			echo("<p style='color:red'>".$error["password"]."</p>");
		}
		?>
      <input type="text" name="name"  value="<?php if(!empty($_POST['name'])){ echo($_POST['name']); }?>" placeholder="Name"/>
      <?php
		if(isset($error["name"])){
			echo("<p style='color:red'>".$error["name"]."</p>");
		}
		?>
      <input type="email" name="email"  value="<?php if(!empty($_POST['email'])){ echo($_POST['email']); }?>" placeholder="Email Address"/>
      <?php
		if(isset($error["email"])){
			echo("<p style='color:red'>".$error["email"]."</p>");
		}
		?>
      Male
      <input type="checkbox" name="male" id="male" onChange="femaleUncheck()" checked value="male"/> 
      Female
      <input type="checkbox" name="female"  id="female" onChange="maleUncheck()" value="Female"/> 
      <input type="file" name="images" id="images" accept="image/jpeg" />
      <?php
		if(isset($error["images"])){
			echo("<p style='color:red'>".$error["images"]."</p>");
		}
		?>
      <button type="submit" name="submit">create</button>
      
      <p class="message">Already registered? <a href="index.php">Sign In</a></p>
      <?php
		if(isset($error["success"])){
			echo("<p style='color:green'>".$error["success"]."</p>");
		}
		?>
	  </form>
  </div>
  
</div>
	
</body>
</html>
<?php session_destroy();?>