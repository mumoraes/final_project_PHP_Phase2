<?php require_once('authentication.php'); ?>
<?php require_once('header.php'); ?>
<?php require_once('navigation.php'); ?>
<section>
  <article>
    <?php

    $id = null;
    $firstname = null;
    $lastname = null;
    $email = null;
    $current_city = null;
    $skills = null;
    $profile = null; 
    $link = null;

    if(!empty($_GET['id']) && is_numeric($_GET['id']))
    {
      try 
      {
        $id = filter_input(INPUT_GET, 'id');
      
        require_once('connect.php');

        $sql = "SELECT * FROM users WHERE user_id =:user_id;";

        $statement = $db->prepare($sql);
        $statement->bindParam(':user_id', $id);  
        $statement->execute();
        $records = $statement->fetchAll();
      
        foreach($records as $record) :
          $firstname = $record['first_name'];
          $lastname = $record['last_name'];
          $email = $record['email'];
          $current_city = $record['current_city'];
          $skills = $record['skills'];
          $profilepic = $record['profile_image'];
          $link = $record['social_media'];
        endforeach;
  
        $statement->closeCursor();

      }catch(PDOException $e){
        $error_message = $e->getMessage();
        echo "<p> $error message </p>"; 
      }
    }
    ?>
    <main>    
      <?php
      //*******Session checking********
      if(isset($_SESSION['username']))
      {
        echo "<h1>". "<p class='cover-heading'> Welcome, ".$_SESSION['username']."! Ready to Share?"."</h1>";
      }
      else
      {
        echo "<h1>Connect with another coders worldwide and share your skills to create an amazing network!</h1>";
      }
      //*******Session checking end******** 
      ?>
      <form action="process.php" method="post" enctype="multipart/form-data" class="form">
        <input type="hidden" name="user_id" value="<?php echo $id;?>">
        <label for="fname"> Your First Name  </label>
        <input type="text" name="fname" class="form-control" id="fname" value="<?php echo $firstname;?>">
        <label for="lname"> Your Last Name  </label>
        <input type="text" name="lname" class="form-control" id="lname" value="<?php echo $lastname;?>">
        <label for="email"> Your Best Email </label>
        <input type="email" name="email" class="form-control" id="email" value="<?php echo $email;?>">
        <label for="current_city"> Your City </label>
        <input type="text" name="current_city" class="form-control" id="current_city" value="<?php echo $current_city;?>">
        <label for="skills"> What Are Your Skills? </label>
        <input type="text" name="skills" class="form-control" id="skills" value="<?php echo $skills;?>">     
        <label for="link"> Social Media</label>
        <input type="url" name="link" class="form-control" id="link" value="<?php echo $link;?>">
        <br>
        <label for="profile"> Profile Photo</label>
        <input type="file" name="photo"  id="profilepic" value="<?php echo $profile;?>">          
        <br>
        <input type="submit" name="submit" value="Send & Share" class="btn">
      </form>
    </main>
  </article>
</section>

<?php require_once('footer.php'); ?>