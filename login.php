<?php session_start(); ?> <!-- session -->
<?php require('header.php');?>
<?php require_once('navigation.php');?>
<main class="container login">
	<?php
	//*******Session checking********
	if(isset($_SESSION['username']))
	{
		echo "<h1>". "<p class='cover-heading'> You already logged in, ".$_SESSION['username']."!"."</h1>";
	}
	else
	{
		echo "<h1>Log In!</h1>";
	}
	//*******Session checking end********
	
	?>
	<!-- <h1> Log In! </h1> -->
	<form action="login-validate.php" method="post">
		<fieldset class="form-group">
			<label for="username" class="col-sm-2">User Name:</label>
			<input name="username" type="text" class="form-control" id="username" required>
		</fieldset>
		<fieldset class="form-group">
			<label for="password" class="col-sm-2">Password:</label>
			<input name="password" required type="password" class="form-control" id="password">
		</fieldset>
			<input type="submit" value="Log In!" name="submit" class="btn btn-success">
	</form>
	<a href="register.php"> Do not have an account yet? Click here to Sign Up!</a>
</main>
<?php require("footer.php") ?>

