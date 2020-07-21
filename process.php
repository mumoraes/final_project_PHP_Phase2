<?php require_once('header.php'); ?>
<?php require_once('navigation.php'); ?>
<main class="validation">
	<?php

	$first_name = filter_input(INPUT_POST, 'fname');
	$last_name = filter_input(INPUT_POST, 'lname');
	$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
	$current_city = filter_input(INPUT_POST, 'current_city');
	$skills = filter_input(INPUT_POST, 'skills');

	$id = null;
	$id = filter_input(INPUT_POST, 'user_id');

	$ok = true;

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

	if ($ok === true) {

		try {

			require_once('connect.php');

			if (!empty($id)) {
				$sql = "UPDATE users SET first_name = :firstname, last_name = :lastname, email = :email, current_city = :current_city, skills = :skills WHERE user_id = :user_id;";
			} else {

				$sql = "INSERT INTO users (first_name, last_name, email, current_city, skills) VALUES (:firstname, :lastname, :email, :current_city, :skills);";
			}

			$statement = $db->prepare($sql);

			$statement->bindParam(':firstname', $first_name);
			$statement->bindParam(':lastname', $last_name);
			$statement->bindParam(':email', $email);
			$statement->bindParam(':current_city', $current_city);
			$statement->bindParam(':skills', $skills);

			if (!empty($id)) {
				$statement->bindParam(':user_id', $id);
			}

			$statement->execute();

			echo "<p> Thanks for Sharing! </p>";

			$statement->closeCursor();
		} catch (PDOException $e) {
			$error_message = $e->getMessage();

			echo "<p> Sorry! it's not with you, it's with us! We will inform you when the problem is fixed! Sorry for the inconvenience. </p> ";
			echo $error_message;

			mail('moraesimurilo@gmail.com', 'App Error ', 'Error :' + $error_message);
		}
	}
	?>
	<a href="new.php" class="btn-error"> Back to Form </a>
</main>
<?php require_once('footer.php'); ?>