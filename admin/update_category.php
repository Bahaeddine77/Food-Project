<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/styly.css">
</head>
<body>
    <?php include("parts/head.php") ?>

        <div class="body">
            <div class="bod">
                 <h1>Update Admin</h1>
                 <br>
                <?php if(isset($_SESSION["update"]))
                    {
                        echo $_SESSION["update"];  
                        unset($_SESSION["update"]); 
                    }
                    if(isset($_SESSION["upload"]))
                    {
                        echo $_SESSION["upload"];  
                        unset($_SESSION["upload"]); 
                    } ?>
                 <br>
               
                 <?php  
                 $id= $_GET["id"];
                 $sql= "SELECT * FROM category WHERE id=$id";
                 $res=mysqli_query($conn,$sql);
                 if($res==true)
                 {  $couny=mysqli_num_rows($res);
                    if($couny==1)
                    {
                        $rows=mysqli_fetch_assoc($res);
                        $title1= $rows["title"];
                        $img_name=$rows["img_name"];
                        $featured=$rows["featured"];
                        $active=$rows["active"];
                    }
                    else
                    {
                        header("location:".SITEURL."admin/manage_category.php");
                    }


                 }
                   
                    ?>
                   <form action="" method="post" enctype="multipart/form-data">
                    <!-- enctype="multipart/form-data" n7otoha bech najem n7otou file fi wost lfom -->


                    <table class="tab">
                        <tr>
                            <td>Title:</td>
                            <td><input type="text" name="title" value="<?php echo $title1; ?>"></td>
                        </tr>
                        <tr>

                            <td>Current image:</td>
                           
                                <td>
                                        <?php
                                        if($img_name!="")
                                        {
                                            ?>
                                            <img src="http://localhost:3000/images/category/<?php echo $img_name; ?>" width="150px">
                                            <?php
                                        }    
                                        else
                                        {
                                           
                                            echo "Image not added";
                                           
                                        }
                                    ?>
                                </td>
                           
                        </tr>
                        <tr>
                             <td>Select image:</td>
                            <td><input type="file" name="image"></td>       
                    <!--type file y5alik t7ot ayy fichier t7eb 3lih -->
                        </tr>
                        <tr>
                            <td>Featured:</td>
                            <td>
                                <input <?php if($featured=="Yes"){ echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                                <input <?php if($featured=="No"){ echo "checked";} ?> type="radio" name="featured" value="No">No
                        
                            </td>
                        </tr>
                        <tr>
                            <td>Active:</td>
                            <td>
                                <input <?php if($active=="Yes"){ echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                                <input <?php if($active=="No"){ echo "checked";} ?> type="radio" name="active" value="No">No
                            </td>
                        </tr>

                        <tr>
                            <input type="hidden" name="img_name" value="<?php echo $img_name; ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <td colspan="2">
                            <input type="submit" name="submit" value="Update Category" class="btn1" style="padding: 3%;">
                            </td>
                        </tr>
                    </table>
                 </form>
                
            </div>
           

        </div>

   <?php

    if(isset($_POST["submit"]))
    {
        $title= $_POST["title"];
        $featured=$_POST["featured"];
        $active=$_POST["active"];
        $img_name=$_POST["img_name"];
        $id=$_POST["id"];

        if(isset($_FILES["image"]["name"]))
        {
            $image_name=$_FILES["image"]["name"];

            if($image_name != "")
            {
                $exploded = explode('.', $image_name);
                $ext = end($exploded);
                
                $image_name="food_category_".rand(000,999).'.'.$ext;




                $source_path=$_FILES["image"]["tmp_name"];

                $destination_path="../images/category/".$image_name;

                $upload = move_uploaded_file($source_path, $destination_path);

                if($upload==FALSE)
                {
                    $_SESSION["upload"]="Failed to upload image";
                    
                    header('location:http://localhost:3000/admin/update_category.php');
                    die();


                };
                if($img_name != "")
                {
                    $remove_path="../images/category/".$img_name;
                    $remove = unlink($remove_path);
                    if($remove ==false)
                    {
                        $_SESSION["remove_img"]="Failed to remove category image";
                        header("location:".SITEURL."admin/manage_category.php");
                        die();
                       
            
                    }
                }

               
            }
            else
            {
                $image_name= $img_name;
            }

           
        }
        else
        {
            $image_name=$img_name;
        }
       
       
       $sql= "UPDATE category SET
       title='$title',
       img_name='$image_name',
       featured='$featured',
       active='$active'
       WHERE id=$id";

        $res=mysqli_query($conn, $sql);

        if($res==TRUE)
        {
            $_SESSION["update"]= "Category updated";
           

            header("location:".SITEURL."admin/manage_category.php");

        }
        else
            {$_SESSION["update"]= "Failed to update category";
                

            header('location:http://localhost:3000/admin/update_category.php');
        }

    
    }
     ?>
     <?php include('parts/foot.php');  ?>
 
</body>
</html>