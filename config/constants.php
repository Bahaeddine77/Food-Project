<?php
    session_start();

    
    define('SITEURL','http://localhost:3000/');
    define('LOCALHOST','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','hmmm_food');


    //hethi t7otha bech t7ell lbase de donnée wou bech t5aleha ta3mel connect 
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn));

    //hethi bech ta3mel select lel base de données 
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));

    echo dirname(__FILE__);

?>