<?php 
    session_start();
    session_unset(); 
    session_destroy(); 

    //page after log out button be clicked
    header('location:login.php'); 
?> 