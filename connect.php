<?php

    //ONLINE
    /*
    $dsn = 'mysql:host=172.31.22.43; dbname=Murilo200449241';
    $username = 'Murilo200449241';
    $password = 'N3s_mszxVp'; 
    $db = new PDO($dsn, $username, $password);
    //set error mode to exception 
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    */

    //ONLINE
    // 000webhost
    /*
    $dsn = 'mysql:host=localhost;dbname=id12510247_final_project_php';
    $username = 'id12510247_root';
    $password = 'Georgian0123*'; 
    $db = new PDO($dsn, $username, $password);
    //set error mode to exception 
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    */

    //OFFLINE (WAMP)

    $dsn = 'mysql:host=localhost;dbname=final_project_php'; 
    $username = 'root';
    $password = ''; 
    $db = new PDO($dsn, $username, $password);
    //set error mode to exception 
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    
?>
