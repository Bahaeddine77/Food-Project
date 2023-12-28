<?php

    include("../config/constants.php");
    $id= $_GET["id"];
    $image_name=$_GET["img_name"];

    if($image_name!="")
    {
        $path="../images/category/".$image_name;
        $remove = unlink($path);
        if($remove !=true)
        {
            $_SESSION["remove_img"]="Failed to remove category image";
            header("location:".SITEURL."admin/manage_category.php");
            die();

        }
    }

    $sql = "DELETE FROM category WHERE id= $id ";
   

    $res= mysqli_query($conn, $sql);

    if($res==true)
    {
        $_SESSION["delete"]="Category deleted successfully";
        header("location:".SITEURL."admin/manage_category.php");
    }

    else
    {
        $_SESSION["delete"]="Failed to delete category, try again later ";
        header("location:".SITEURL."admin/managee_category.php");
    }





?>