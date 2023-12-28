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
    <section class="food_search ">
        <div class="container">

            <?php
                if(isset($_GET['id']))
                {
                    $id=$_GET['id']; 
                }
                else
                {
                    header('location'.SITEURL.'index.php');
                }
            
                $sql="SELECT * FROM food WHERE id='$id'";
                $res=mysqli_query($conn, $sql);
                $count=mysqli_num_rows($res);
                if($count==1)
                {
                    $row=mysqli_fetch_assoc($res);
                    $title=$row["title"];
                    $price=$row["price"];
                    $img_name=$row["img_name"];
                }
                else
                {
                    echo "hhh";
                }
            ?>
            <h1 class="search_textt " >Fill this form to confirm your order</h1>


            <form style="justify-content: center;" action="" method="post">

            
                <fieldset class="food_menu2">
                    <div >
                    
                            
                        
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
                                <h3 style="font-size: xx-large;margin-top: 4%;"><?php echo $title ?></h3>
                                <p class="price" ><?php echo $price ?></p>
                                <input type="hidden" name="title" value="<?php echo $title; ?>">
                                <input type="hidden" name="price" value="<?php echo $price; ?>">
                                <p style="font-size: larger ; margin-top: 4%; font-weight: 800;">Quantity</p>
                            
                                    <input type="number" name="qty" value="1">
                        
                            
                                
            
                            </div>
                            <div class="clear_fix"></div>
                    
                    </div>
                </fieldset>

                <fieldset class="food_menu2">
                    <div >

                
                        <p class="te">Full Name</p><br>
                        <input type="text" name="name" placeholder="name" class="spacy" ><br>
                        <p class="te">Phone Number</p><br>
                        <input type="text" name="phone" placeholder="phone" class="spacy" ><br>
                        <p class="te">Email</p> <br>
                        <input type="text" name="email" placeholder="email" class="spacy"><br>                       
                        <p class="te">Adress</p><br>
                        <textarea name="adress"  cols="55" placeholder="adress"  style="font-size: x-large;"></textarea>
                        <input type="submit" name="submit" value="Confirm order" class="butt button">

                    </div>
                </fieldset>

            

               
            </form>

            <?php 
                if(isset($_POST["submit"]))
                {
                    $title=$_POST["title"];
                    $price=$_POST["price"];
                    $qty=$_POST["qty"];
                    $name=$_POST["name"];
                    $phone=$_POST["phone"];
                    $email=$_POST["email"];
                    $adress=$_POST["adress"];

                    $total=$price * $qty ;
                    $order_date=date("Y-m-d h:i:sa");
                    $status= "Ordered";

                    $sql2="INSERT INTO hmm_order SET
                    food='$title',
                    price='$price',
                    qty='$qty',
                    total='$total',
                    order_date='$order_date',
                    status='$status',
                    customer_name='$name',
                    customer_contact='$phone',
                    customer_email='$email',
                    custmer_adress='$adress'
                    ";
                    $res2=mysqli_query($conn,$sql2);
                    if($res2==TRUE)
                    {
                        $_SESSION["order"]="Food orderer successfully";
                        header('location:'.SITEURL);
                    }
                    

                    else
                    {
                        $_SESSION["order"]="Failed to order food";
                        header('location:'.SITEURL);
                    }
                }

            ?>

           
        
        </div>

    </section>






    <?php include("parts_front/footer.php") ?>




</body>
</html>