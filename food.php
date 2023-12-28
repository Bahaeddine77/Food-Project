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
    <?php include('parts_front/search.php'); ?>
        

   
   


    <section class="food_menu">
        <div class="container">
            <h2 class="t_center">Explore food</h2>

            <?php 
                $sql2="SELECT * FROM food WHERE active='Yes'";
                $res2=mysqli_query($conn, $sql2);
                $count2= mysqli_num_rows($res2);
                if($count2>0)
                {
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $id=$row2["id"];
                        $title=$row2["title"];
                        $description=$row2["description"];
                        $img_name=$row2["img_name"];
                        $price=$row2["price"];
                        
                        ?>
                        <div class="food_menu1">
                            
                                <?php
                                if($img_name!="")
                                {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/food/<?php echo $img_name; ?>" class="img2 border_radius">
                                    <?php
                                }
                                else
                                {
                                    ?> <div class="desc_img">
                                            <h1 style="width: 80%;" >
                                                Image is not available
                                            </h1>
                                        
                                      
                                        </div>
                                      <?php
                                }?>

                           
                           

                                
                            <div class="desc_food">
                                <h3><?php echo $title; ?></h3>
                                <p class="price"><?php echo $price ;?></p>
                                <p class="desc"><?php echo $description; ?></p>
                                <a href="<?php echo SITEURL ?>order.php?id= <?php echo $id ?>" class="but_order button">Order now</a>
                                

                            </div>
                            <div class="clear_fix"></div>
                        </div>
                          
                    
                         <?php
                    }
                }
                else
                {
                    echo '<h1 class="search_text_not_found">Food is not available</h1>';
                }
               
            ?>

          
        
     

         

            
            <div class="clear_fix"></div>
        </div>
        

    </section>



    
 

 

    <?php include('parts_front/footer.php'); ?>

    
</body>
</html>