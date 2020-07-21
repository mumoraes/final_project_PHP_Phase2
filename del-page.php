<?php require_once('header.php'); ?>

<section>
  <article>
  <h1>Delete or Update Information! </h1>
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
            <th>Delete</th>
            <th>Edit</th>
          </thead><tbody>";

          foreach ($records as $record) {
            echo "<tr><td>" . 
              $record['first_name'] . "</td><td>" . 
              $record['last_name'] . "</td><td>" .
              $record['email'] . "</td><td>" .
              $record['current_city'] . "</td><td>" .
              $record['skills'] . 
              "<td><a href='delete.php?id= " . $record['user_id'] . "' onclick='return confirm(\"Are you sure you want to delete?\")'> x </a></td>
              <td><a href='new.php?id=" . $record['user_id'] . "' > --- </a></td></tr>";
          }
          echo "</tbody></table>"; 

          $statement->closeCursor(); 
          }
          catch(PDOException $e) {
              $error_message = $e->getMessage(); 
              echo "<p> $error message </p>"; 
          }
      ?>
    </main>
  </article>
</section>
      
<?php require_once('footer.php'); ?>
