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
                 <h1>Manage category</h1>

                 <br>
                 <?php  if(isset($_SESSION["addc"]))
                    {
                        echo $_SESSION["addc"];  
                        unset($_SESSION["addc"]); 
                    }
                    if(isset($_SESSION["delete"]))
                    {
                        echo $_SESSION["delete"];  
                        unset($_SESSION["delete"]); 
                    }
                    if(isset($_SESSION["remove_img"]))
                    {
                        echo $_SESSION["remove_img"];  
                        unset($_SESSION["remove_img"]); 
                    }
                    if(isset($_SESSION["update"]))
                    {
                        echo $_SESSION["update"];  
                        unset($_SESSION["update"]); 
                    }

                    
                    
                    ?>
                <br>
                <br>
                 <a href="add_category.php" class="btn1">Add Category</a>
                 <table class="tableau">
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                    
                    <?php 
                        $sql= "SELECT * FROM category";
                        $res = mysqli_query($conn, $sql);
                        $count=mysqli_num_rows($res);
                        if($count>0)
                        {   $i=1;
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id=$row["id"];
                                $title=$row["title"];
                                $image_name=$row["img_name"];
                                $featured=$row["featured"];
                                $active=$row["active"];
                                ?>
                                <tr>
                                    <td><?php echo $i++ ?></td>
                                    <td><?php echo $title?></td>
                                    <td>
                                        <?php 
                                            if($image_name!="")
                                            {?>
                                                <img src="http://localhost:3000/images/category/<?php echo $image_name; ?>" width="100px">
                                                <?php
                                            }
                                            else
                                            {
                                                echo "Image not added";
                                            }
                                        ?>

                                    </td>       
                                        
                                       
                                    <td><?php echo $featured?></td>
                                    <td><?php echo $active?></td>
                                    <td>
                                        <a href="<?php echo  SITEURL;?>admin/update_category.php?id=<?php echo $id; ?> " class="btn2">Update Category</a>
                                        <a href="<?php echo  SITEURL;?>admin/delete_category.php?id=<?php echo $id; ?> & img_name=<?php echo $image_name ?> " class="btn3">Delete Category</a>
                                    </td>
                                </tr>
                                <?php
                            }
                            
                       
    
                        }
                        else
                        {
                            ?>
                            <tr>
                                <td colspan="6" style="color:brown;">No category added </td>
                            </tr>
                            <?php
                        }
                        ?>
                       
                  
                    
                 </table>

            </div>
           

        </div>

    <?php include('parts/foot.php');  ?>
 
</body>
</html>