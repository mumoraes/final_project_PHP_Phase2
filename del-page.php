<?php require_once('authentication.php'); ?>
<?php require_once('header.php'); ?>
<?php require_once('navigation.php'); ?>

<section>
  <article>
    <main>

    <?php
    try {

        $name = $_SESSION['username'];
        $iduser = $_SESSION['id'];
                
        //$sql = "SELECT * FROM users;";
        require_once('connect.php');
        $sql = "SELECT * FROM users WHERE id = '$iduser' ;";

        require_once('connect.php');
        $statement = $db->prepare($sql);
        $statement->execute();
        $dbrecords = $statement->fetchAll(); 
        
        $row=$statement->fetchAll();
        
        //*******Session checking********
        
        if($statement->rowCount() == 0)
        {
          echo "<h1>". "<p class='cover-heading'> Hello, ".$_SESSION['username']."! You did not share yet."."</h1>";
          ?>
          <button  class="btn btn-outline-primary" onclick="location.href='new.php'">Go To Share Info</button>
          <?php
          goto end;
        }
        else
        {
          //echo "<h1>". "<p class='cover-heading'> Welcome, ".$_SESSION['username']."! Ready to share?"."</h1>";
          echo "<h1>". "<p class='cover-heading'>" .$_SESSION['username'].", here You can Delete or Update Your Personal Information!"."</h1>";
        }
        //*******Session checking end********		

       
        foreach ($dbrecords as $dbrec) 
        {
          //echo $dbrec[0];
          if($dbrec['id'] == $iduser)
          {
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

            echo "<tr><td><img src='images/". $dbrec['profile_image']. "' alt='" . $dbrec['profile_image'] . "'></td><td>".
            $dbrec['first_name'] . "</td><td >" . 
            $dbrec['last_name'] . "</td><td>" .
            $dbrec['email'] . "</td><td>" .
            $dbrec['current_city'] . "</td><td>" .
            $dbrec['skills'] . "</td><td><a href='" .
            $dbrec['social_media']."' target='_blank'> Personal Media </a>
            <td><a href='delete.php?id= " . $dbrec['user_id'] . "' onclick='return confirm(\"Are you sure you want to delete?\")'> x </a></td>
              <td><a href='newUpdate.php?id=" . $dbrec['user_id'] . "' > --- </a></td></tr>";
            echo "</tbody></table>"; 
          }
        }
      $statement->closeCursor(); 
      }catch(PDOException $e) {
        $error_message = $e->getMessage(); 
        echo "<p> $error_message </p>"; 
      }
          
    ?>
    </main>
  </article>
</section>
<?php end: ?> 
<?php require_once('footer.php'); ?>
