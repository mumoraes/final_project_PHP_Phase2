<?php session_start(); ?>
<?php require_once('header.php'); ?>
<?php require_once('navigation.php'); ?>
<body>
	<main class="container">
		<section>
			<article>	
				<div>
					<?php
					//*******Session checking********
					if(isset($_SESSION['username']))
					{
							echo "<h1>". "<p class='cover-heading'> You already signed up, ".$_SESSION['username']."!"."</h1>";
							goto end;
					}
					else
					{
							echo "<h1>Sign Up</h1>";
					}
					//*******Session checking end********
					?>
				</div>
											
				<form action="save-regist-inf.php" method="post" enctype="multipart/form-data" class="form">
						<p>Please fill all fields to create an account.</p>    
						<fieldset>
								<label>Choose Your Username</label>
								<input type="text" name="username" class="form-control" id="username" >
						</fieldset>
						<fieldset>
								<label>Choose Your Password</label>
								<input type="password" name="password" class="form-control" id="password">
						</fieldset>
						<fieldset>
								<label>Confirm Password</label>
								<input type="password" name="confirm" class="form-control" id="confirm" >
						</fieldset>
						<p></p>
						<div>
								<input type="submit" class="btn btn-primary" value="Submit">
						</div>
						<br>
						<p>Already have an account? <a href="login.php">Login here</a></p>
				</form>
			</article>
		</section>	
	</main>  
	<?php end: ?>  
<?php require_once('footer.php'); ?>