<?php session_start(); ?>
<?php require_once('header.php'); ?>
<?php require_once('navigation.php'); ?>
<main class="validation">
	<?php

	$first_name = filter_input(INPUT_POST, 'fname');
	$last_name = filter_input(INPUT_POST, 'lname');
	$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
	$current_city = filter_input(INPUT_POST, 'current_city');
	$skills = filter_input(INPUT_POST, 'skills');
	$credentialid = $_SESSION['id'];

	// link and photo
	$link = filter_input(INPUT_POST, 'link');
	/* image */
	$photo = $_FILES['photo']['name'];
	$photo_type = $_FILES['photo']['type'];
	$photo_size = $_FILES['photo']['size'];
	// end
	$id = null;
	$id = filter_input(INPUT_POST, 'user_id');

	
	$ok = true;

	//define image constants
	define('UPLOADPATH', 'images/');
	define('MAXFILESIZE', 64786); //64 KB

	// some input validation
	if (empty($first_name) || empty($last_name)) {
		echo "<p class='error'>Please provide both first and last name! </p>";
		$ok = false;
	}

	if (empty($email) || $email === false) {
		echo "<p class='error'>Please include your email in the proper format!</p>";
		$ok = false;
	}

	if (empty($current_city)) {
		echo "<p class='error'>Please tell us where you are located!!</p>";
		$ok = false;
	}

	if (empty($skills)) {
		echo "<p class='error'>Please tell us what you are good at!</p>";
		$ok = false;
	}

	//link
	if (empty($link)) {
		echo "<p class='error'>Please inform your social media link!</p>";
		$ok = false;
	}

	// check photo is the right size and type 
	if ((($photo_size >= MAXFILESIZE) && ($photo_type !== 'image/jpeg') || ($photo_type !== 'image/png') || ($photo_type !== 'image/gif') || ($photo_type !== 'image/jpg')) && ($photo_size < 0)) {
		//making sure upload with NO errors 
		if ($_FILES['photo']['error'] !== 0) {
				$ok = false;
				echo "Please submit a photo with the size less than 64kb and correct format";
		}
	}

	if ($ok === true) {

		try 
		{
			$target = UPLOADPATH . $photo;
			move_uploaded_file($_FILES['photo']['tmp_name'], $target);
           
			require_once('connect.php');

			if (!empty($id)) {
				$sql = "UPDATE users SET first_name = :firstname, last_name = :lastname, email = :email, current_city = :current_city, skills = :skills, social_media = :link, profile_image = :photo WHERE user_id = :user_id;";
			} else {

				$sql = "INSERT INTO users (first_name, last_name, email, current_city, skills, social_media, profile_image, id) VALUES (:firstname, :lastname, :email, :current_city, :skills, :link, :photo, $credentialid);";
			}

			$statement = $db->prepare($sql);

			$statement->bindParam(':firstname', $first_name);
			$statement->bindParam(':lastname', $last_name);
			$statement->bindParam(':email', $email);
			$statement->bindParam(':current_city', $current_city);
			$statement->bindParam(':skills', $skills);
			$statement->bindParam(':photo', $photo);
			$statement->bindParam(':link', $link);

			if (!empty($id)) {
				$statement->bindParam(':user_id', $id);
			}

			$statement->execute();

			//*******Session checking********
			$_SESSION['fname'] = $first_name;

			if(isset($_SESSION['fname']))
			{           
			// show message
					echo "<p>Thanks for sharing, ".$_SESSION['fname']."!"."</p>";
			}
			//*******Session checking end********

			$statement->closeCursor();
		}catch (PDOException $e) {
			$error_message = $e->getMessage();

			echo "<p> Sorry! it's not with you, it's with us! We will inform you when the problem is fixed! Sorry for the inconvenience. </p> ";
			echo $error_message;

			mail('moraesimurilo@gmail.com', 'App Error ', 'Error :' + $error_message);
		}
	}
	?>
	<a href="view.php" class="btn-error"> Check out what we have stored! </a>
</main>
<?php require_once('footer.php'); ?>