<?php require_once('authentication.php'); ?>
<?php require_once('header.php'); ?>
<?php require_once('navigation.php'); ?>
<section>
  <article>
  <!-- <h1>Here You Can Check Out What We Have Stored!</h1> -->
    <main>

    <h3> Search Skills</h3>
    <form action="search.php" method="get">
      <label for="usersearch">Find skills you are looking for:</label>
      <input type="text" name="usersearch">
      <input  class="btn btn-outline-primary" type="submit" name="submit" value="Find it!">
    </form>
    <hr>

      <?php
        try {
          require_once('connect.php');
          
          $sql = "SELECT * FROM users;";
          $statement = $db->prepare($sql);
          $statement->execute();
          $records = $statement->fetchAll(); 

          //*******Session checking********
          if(isset($_SESSION['username']))
          {
              echo "<h1>". "<p class='cover-heading'> Hello, ".$_SESSION['username']."! Check out what we have stored!"."</h1>";
          }
          else
          {
              echo "<h1>Here You Can Check Out What We Have Stored!</h1>";
          }
          //*******Session checking end********

          echo "<table class='table table-striped'><thead class='thead-dark'> 
          <th></th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Current City</th>
            <th>Skills</th>
            <th>Social Media</th>
          </thead><tbody>";

          foreach ($records as $record) {
              echo "<tr><td><img src='images/". $record['profile_image']. "' alt='" . $record['profile_image'] . "'></td><td>".
              $record['first_name'] . "</td><td>" . 
              $record['last_name'] . "</td><td>" .
              $record['email'] . "</td><td>" .
              $record['current_city'] . "</td><td>" .
              $record['skills'] . "</td><td><a href='" .
              $record['social_media']. "' target='_blank'> Personal Media </a></td><tr>";
              
          }
          echo "</tbody></table>"; 

          $statement->closeCursor(); 
          }
          catch(PDOException $e) {
              $error_message = $e->getMessage(); 
              echo "<p> $error message </p>"; 
          }
      ?>

      <p>
        <a href="del-page.php" class="btn btn-outline-primary">Update / Delete</a>
      </p>

    </main>
  </article>
</section>

<?php require_once('footer.php'); ?>
