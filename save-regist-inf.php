<?php require_once ('header.php');

require_once "connect.php";

$user = trim($_POST["username"]);
$password = trim($_POST["password"]);
$confirm_password = trim($_POST["confirm"]);


if(empty($user))
{
  echo "<p> Provide Username <p>";
}

if(empty($password))
{
  echo "<p> Provide Password <p>";
}

if($password != $confirm_password)
{
  echo "<p> Password does not match <p>";
  //echo "<p> Password : $password <p>";  //test
  //echo "<p> Confirm Password : $confirm_password <p>"; //test
}

// checking if the username already exists before register
//require_once('connect.php');
$sql = "SELECT username FROM users_credentials;";
$statement = $db->prepare($sql);
$statement->execute();

$records = $statement->fetchAll(); //check all rows in database

foreach ($records as $record) //loop to run inside each username column field from DB
{
  //echo $record['username']; // test to show reconds from DB
  //echo " "; // test
  $rec = $record['username']; // store each username inside $rec    $record is an Array
  //echo $rec; // test space between records
  if (strcmp($user, $rec) == 0) //compare if the username inserted form user alredy existis inside table from DB ("0" means true -> case sensitive string mothod)
  {
    echo "<h2> Sorry, the username \"{$rec}\" already exists :( </h2>"; 
    echo "<p>" ?> <a href="register.php">Click here to try it again</a></p>
    <?php
    echo $rec = ''; // cleanning the string
    //echo "string is: {$rec} data";
    goto end; // skip the next if and go to the final of the page
  }
}


//if($password == $confirm_password && $user != $record['username'])
if($password == $confirm_password && !empty($user) && !empty($password))
{
  require_once('connect.php');

  $sql = "INSERT INTO users_credentials (username, password) VALUES (:username, :password)";

  $statemt = $db->prepare($sql);
  $hash_pw = password_hash($password, PASSWORD_DEFAULT);
  $statemt->bindParam(':username', $user);
  $statemt->bindParam(':password', $hash_pw);
  $statemt->execute();
  $statemt->closeCursor();

  echo"<p> Successfully Registered! Go to <a href='login.php'>login</a> page </p>";

  //add try catch blocks to handling some erros
}

end:  //goto 

require_once ('footer.php');
?>
