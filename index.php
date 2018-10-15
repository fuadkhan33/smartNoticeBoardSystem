<?php
	include("User.php");
	session_start();
	$basicUser = new BasicUser;
	$assoc = array();

	if($_POST){
		$assoc = $basicUser->getLoginAssoc($_POST);
	}
	if(isset($_SESSION["assocForBasicUser"])){
		header("Location: home.php");
	}
	if(count($assoc)>1){
			$_SESSION['assocForBasicUser'] = $assoc;
			header("Location: home.php");
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
      <li><a href="index.php?option=login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
       
    </ul>



</div>
</nav>
	<div class="login-page">
  <div class="form">
    <form method="post" action="<?php echo($_SERVER['PHP_SELF']);?>" class="login-form">
      <input type="text" name="username" placeholder="Username"/>
      <input type="password" name="password" placeholder="Password"/>
      <?php
		if(isset($assoc["error"])){
			echo("<p style='color:red'>".$assoc["error"]."</p>");
		}
		?>
      <button >login</button>
      <p class="message">Not registered? <a href="register.php">Create an account</a></p>
    </form>
  </div>
</div>
	
</body>
</html>