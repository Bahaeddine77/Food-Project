<?php 
    include("../config/constants.php");
    session_destroy();

    header('location:http://localhost:3000/admin/login.php');

?>