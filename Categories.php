<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hmmm food</title>
    <link rel="stylesheet" href="css/indi.css">
</head>
<body>
    <?php include("parts_front/menu.php") ?>
    
   
    <section class="Categories">
        <div class="container ">
            <h2 class="t_center">Categories</h2>

            <?php 
                $sql="SELECT * FROM category WHERE active='Yes' ";
                $res=mysqli_query($conn, $sql);
                $count= mysqli_num_rows($res);
                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id=$row["id"];
                        $title=$row["title"];
                        $img_name=$row["img_name"];
                        
                        ?>

                        <a href="<?php echo SITEURL; ?>categories_food.php?id_categ=<?php echo $id; ?>">
                            <div class="categ float">
                                <?php

                                if($img_name!="")
                                {
                                    ?>
                                    <img src="<?php echo SITEURL ?>images/category/<?php echo $img_name; ?>" alt="hh" class="img1 border_radius">
                                    <h3 class="float_text text_white"><?php echo $title; ?></h3>
                                    <?php
                                }
                                else
                                {
                                    ?> <div class="desc_img_categ">
                                            <h1 style="width: 80%;" >
                                                Image is not available
                                            </h1>
                                        
                                    
                                        </div>
                                    <?php
                                }?>
                            </div>
                        </a> 
                        <?php
                    }
                }

            ?> 
            
          
           
         

            <div class="clear_fix"></div>
           
        
        </div>

        

       

           



    </section>

    
</section>



<?php include("parts_front/footer.php") ?>

</body>
</html>