<?php

    include("../config/constants.php");
    $id= $_GET["id"];
    $image_name=$_GET["img_name"];

    if($image_name!="")
    {
        $path="../images/food/".$image_name;
        $remove = unlink($path);
        if($remove !=true)
        {
            $_SESSION["remove_img"]="Failed to remove food image";
            header("location:".SITEURL."admin/manage_food.php");
            die();

        }
    }

    $sql = "DELETE FROM food WHERE id= $id ";
   

    $res= mysqli_query($conn, $sql);

    if($res==true)
    {
        $_SESSION["delete"]="food deleted successfully";
        header("location:".SITEURL."admin/manage_food.php");
    }

    else
    {
        $_SESSION["delete"]="Failed to delete food, try again later ";
        header("location:".SITEURL."admin/managee_food.php");
    }





?>