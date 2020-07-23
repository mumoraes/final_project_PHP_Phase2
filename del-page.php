<?php require_once('authentication.php'); ?>
<?php require_once('header.php'); ?>
<?php require_once('navigation.php'); ?>

<section>
  <article>
    <main>

    <?php
		//*******Session checking********
		if(isset($_SESSION['username']))
		{
			echo "<h1>". "<p class='cover-heading'>" .$_SESSION['username'].", here You can Delete or Update Information!"."</h1>";
		}
		//*******Session checking end********		

    try {
      require_once('connect.php');

      $sql = "SELECT * FROM users;";
      $statement = $db->prepare($sql);
      $statement->execute();
      $records = $statement->fetchAll(); 

      echo "<table class='table table-striped'><thead class='thead-dark'> 
        <th></th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Current City</th>
        <th>Skills</th>
        <th>Social Media</th>
        <th>Delete</th>
        <th>Update</th>
        </thead><tbody>";

      foreach ($records as $record) 
      {
        echo "<tr><td><img src='images/". $record['profile_image']. "' alt='" . $record['profile_image'] . "'></td><td>".
        $record['first_name'] . "</td><td >" . 
        $record['last_name'] . "</td><td>" .
        $record['email'] . "</td><td>" .
        $record['current_city'] . "</td><td>" .
        $record['skills'] . "</td><td><a href='" .
        $record['social_media']."' target='_blank'> Personal Media </a>
        <td><a href='delete.php?id= " . $record['user_id'] . "' onclick='return confirm(\"Are you sure you want to delete?\")'> x </a></td>
          <td><a href='new.php?id=" . $record['user_id'] . "' > --- </a></td></tr>";
      }
      echo "</tbody></table>"; 

      $statement->closeCursor(); 
      }catch(PDOException $e) {
        $error_message = $e->getMessage(); 
        echo "<p> $error message </p>"; 
      }
    ?>

    </main>
  </article>
</section>
<?php require_once('footer.php'); ?>
