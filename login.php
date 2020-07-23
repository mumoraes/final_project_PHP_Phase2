<?php session_start(); ?> <!-- session -->
<?php require('header.php');?>
<?php require_once('navigation.php');?>
<main class="container login">
<section>
  <article>	
		<?php
		//*******Session checking********
		if(isset($_SESSION['username']))
		{
			echo "<h1>". "<p class='cover-heading'> You already logged in, ".$_SESSION['username']."!"."</h1>";
			goto end;
		}
		else
		{
			echo "<h1>Log In!</h1>";
		}
		//*******Session checking end********		
		?>
		
			<form action="login-validate.php" method="post" enctype="multipart/form-data" class="form">
					<label for="username">User Name:</label>
					<input name="username" type="text" class="form-control" id="username" required>

					<label for="password">Password:</label>
					<input name="password" required type="password" class="form-control" id="password">

					<input type="submit" value="Log In!" name="submit" class="btn btn-success">
			</form>
			<article>
				<a href="register.php"> Do not have an account yet? Click here to Sign Up!</a>
			</article>
		</main>
	</article>
</section>
<?php end: ?>  
<?php require("footer.php") ?>

