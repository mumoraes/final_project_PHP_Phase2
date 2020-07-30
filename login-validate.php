<?php session_start(); ?> <!-- session -->

<?php 
try
{
    require_once('connect.php');

    $pass = true; 

    if(empty(trim($_POST['username']))) 
    {
        echo "<p>Enter an username</p>"; 
        $pass = false; 
    }
    else 
    {
        $nameprovided = trim($_POST['username']); 
    }

    if(empty(trim($_POST['password']))) 
    {
        echo "<p>Enter a password</p>"; 
        $pass = false; 
    }
    else 
    {
        $passordprovided = trim($_POST['password']); 
    }


    if($pass === true) 
    {
        $sql = "SELECT id, username, password FROM users_credentials WHERE username = :username"; 

        $statement = $db->prepare($sql); 
        $statement->bindParam(':username', $nameprovided); 
        $statement->execute(); 
        if($statement->rowCount() == 1) //method from PDO statement object.  1 means get a result
        {
            if($row = $statement->fetch()) //fetch() returns only one row while fetchAll() returns the entire data set.
            {   
                $id = $row['id']; 
                $user_name = $row['username']; 
                $hashed_password = $row['password']; 
                // checking if the provided password matchs with the one from database to this id user
                if(password_verify($passordprovided, $hashed_password)) 
                {
                    $_SESSION['id'] = $id; 
                    $_SESSION['username'] = $user_name; 
                    header('location:view.php'); 
                }
            }
        }
        else 
        {
            echo "<p>Problem with Validation.</p>"; 
        }
    }
}catch(PDOException $e) {
    $error_message = $e->getMessage(); 
    echo "<p> $error_message </p>"; 
}

$statement->closeCursor(); 
?> 