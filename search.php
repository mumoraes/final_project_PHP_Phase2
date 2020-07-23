<?php require_once('authentication.php'); ?>
<?php require_once('header.php'); ?>
<?php require_once('navigation.php'); ?>
<section>
  <article>
  <h1>Search Results!</h1>
    <main>

        <?php 
        $search_term = filter_input(INPUT_GET, 'usersearch'); 
        //echo $search_term;
        $searchwords = explode(' ', $search_term); 
        $where = ""; 
        $sql = "SELECT * FROM users WHERE "; 

        foreach($searchwords as $word) {
            $where = $where . "skills LIKE '%$word%' OR "; 
        }

        $where = substr($where, 0, strlen($where) - 4);
        $finalsql = $sql . $where; 

        try
        {
            require_once('connect.php'); 

            $statement = $db->prepare($finalsql); 
            $statement->execute();
            $results = $statement->fetchAll(); 

            if(empty($results)) 
            {
                echo "<h1>Sorry, no results found!</h1>";
            }

            if(!empty($results) && (!empty($search_term))) 
            {
                echo "<h2>Great, you are looking for \" $word \" Skills. </h2><br>";
                echo "\n\n";
                echo "<table class='table table-striped'><thead class='thead-dark'> 
                <th></th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Current City</th>
                <th>Skills</th>
                <th>Social Media</th>
                </thead><tbody>";
                
                foreach ($results as $result) {
                    echo "<tr><td><img src='images/". $result['profile_image']. "' alt='" . $result['profile_image'] . "'></td><td>".
                    $result['first_name'] . "</td><td>" . 
                    $result['last_name'] . "</td><td>" .
                    $result['email'] . "</td><td>" .
                    $result['current_city'] . "</td><td>" .
                    $result['skills'] . "</td><td><a href='" .
                    $result['social_media']. "' target='_blank'> Personal Media </a></td><tr>";
                    
                }
                echo "</tbody></table>"; 
            }

            if((empty($search_term))) 
            {
                echo "<h2>Please provide a keyword</h2>";
            }
        }catch(PDOException $e) {
            $error_message = $e->getMessage(); 
            echo "<p> $error message </p>"; 
         }    
        
        ?> 
            <p> <a href="view.php" class="btn btn-outline-primary">Try it Again!</a></p>
        <?php

        $statement->closeCursor(); 

        ?>
    </main>
  </article>
</section>

<?php require_once('footer.php'); ?>