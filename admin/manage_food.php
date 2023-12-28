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
                 <h1>Manage food</h1>

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
                <br><br>
                 <a href="add_food2.php" class="btn1">Add food</a>
                 <table class="tableau">
                    <tr>
                        <th>S.N</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Category</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>
                    
                    <?php 
                        $sql= "SELECT * FROM food";
                        $res = mysqli_query($conn, $sql);
                        $count=mysqli_num_rows($res);
                        if($count>0)
                        {   $i=1;
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id=$row["id"];
                                $title=$row["title"];
                                $price=$row["price"];
                                $image_name=$row["img_name"];
                                $category=$row["category_id"];
                                $featured=$row["featured"];
                                $active=$row["active"];
                                ?>
                                <tr>
                                    <td><?php echo $i++ ?></td>
                                    <td><?php echo $title?></td>
                                    <td><?php echo $price?></td>
                                    <td>
                                        <?php 
                                            if($image_name!="")
                                            {?>
                                                <img src="http://localhost:3000/images/food/<?php echo $image_name; ?>" width="100px">
                                                <?php
                                            }
                                            else
                                            {
                                                echo "Image not added";
                                            }
                                        ?>

                                    </td>    
                                    <td><?php echo $category?></td>                           
                                        
                                       
                                    <td><?php echo $featured?></td>
                                    <td><?php echo $active?></td>
                                    <td>
                                        <a href="<?php echo  SITEURL;?>admin/update_food2.php?id=<?php echo $id; ?> " class="btn2">Update food</a>
                                        <a href="<?php echo  SITEURL;?>admin/delete_food.php?id=<?php echo $id; ?> & img_name=<?php echo $image_name ?> " class="btn3">Delete food</a>
                                    </td>
                                </tr>
                                <?php
                            }
                            
                       
    
                        }
                        else
                        {
                            ?>
                            <tr>
                                <td colspan="6" style="color:brown;">No food added </td>
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