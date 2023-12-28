<?php

    include("../config/constants.php");
    $id= $_GET["id"];

    $sql = "DELETE FROM admin WHERE id= $id ";

    $res= mysqli_query($conn, $sql);

    if($res==true)
    {
        $_SESSION["delete"]="Admin deleted successfully";
        header("location:".SITEURL."admin/manager_admin.php");
    }

    else
    {
        $_SESSION["delete"]="Failed to delete admin, try again later ";
        header("location:".SITEURL."admin/manager_admin.php");
    }





?>