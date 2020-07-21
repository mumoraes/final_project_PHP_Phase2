<?php require_once('authentication.php'); ?>
<?php require_once('header.php'); ?>
<?php require_once('navigation.php'); ?>
<section>
  <article>
  <h1>Here You Can Check Out What We Have Stored!</h1>
    <main>
      <?php
        try {
          require_once('connect.php');
          
          $sql = "SELECT * FROM users;";

          $statement = $db->prepare($sql);

          $statement->execute();

          $records = $statement->fetchAll(); 

          echo "<table class='table table-striped'><thead class='thead-dark'> 
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Current City</th>
            <th>Skills</th>
          </thead><tbody>";

          foreach ($records as $record) {
            echo "<tr><td>" . 
              $record['first_name'] . "</td><td>" . 
              $record['last_name'] . "</td><td>" .
              $record['email'] . "</td><td>" .
              $record['current_city'] . "</td><td>" .
              $record['skills'] ;
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
        <a href="del-page.php" class="btn btn-outline-primary">Edit or Delete</a>
      </p>

    </main>
  </article>
</section>

<?php require_once('footer.php'); ?>
