<?php 

    include_once('config/Database.php');
    include_once('class/UserLogin.php');

    $connectDB = new Database();
    $db = $connectDB->getConnection();
    
    $users = new UserLogin($db);
    $users-> logOut();

?>
<link rel="stylesheet" href="font.css">