<?php session_start(); ?>
<?php require_once('header.php'); ?>
<?php require_once('navigation.php'); ?>

<section>
  <article>
    
    <?php
      //*******Session checking********
      if(isset($_SESSION['username']))
      {
        echo "<h1>". "<p class='cover-heading'> Welcome, ".$_SESSION['username']."!"."</h1>";
      }
      else
      {
        echo "<h1>Home</h1>";
      }
      //*******Session checking end******** 
    ?>
    <h1>Join The DevShare Community.</h1>
    <p>Looking for improvement in your network? Join our community and share your skills. Here you are very Welcome!</p>
    <p>
      <a href="new.php" class="btn btn-outline-primary">Share Skills</a>
      <a href="view.php" class="btn btn-outline-primary">View</a>
    </p>
  </article>
</section>

<?php require_once('footer.php'); ?>