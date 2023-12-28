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
                 <h1>Update Order</h1>
                 <br>
                <?php if(isset($_SESSION["update"]))
                    {
                        echo $_SESSION["update"];  
                        unset($_SESSION["update"]); 
                    }
                  ?>
                 <br>
               
                 <?php  
                 $id= $_GET["id"];
                 $sql= "SELECT * FROM hmm_order WHERE id=$id";
                 $res=mysqli_query($conn,$sql);
                 if($res==true)
                 {  $couny=mysqli_num_rows($res);
                    if($couny==1)
                    {
                        $rows=mysqli_fetch_assoc($res);
                        $id = $rows['id'];
                        $food=$rows["food"];
                        $price=$rows["price"];
                        $qty = $rows['qty'];
                        $total=$rows["total"];
                        $order_date=$rows["order_date"];
                        $status= $rows['status'];
                        $customer_name=$rows["customer_name"];
                        $customer_contact=$rows["customer_contact"];
                        $customer_email=$rows["customer_email"];
                        $customer_adress=$rows["custmer_adress"];
                    }
                    else
                    {
                        header("location:".SITEURL."admin/manage_order.php");
                    }


                 }
                   
                    ?>
    <?php

if(isset($_POST["submit"]))
{

    $price=$_POST["price"];
    $qty=$_POST["qty"];
    $customer_name=$_POST["customer_name"];
    $customer_contact=$_POST["customer_contact"];
    $customer_email=$_POST["customer_email"];
    $customer_adress=$_POST["adress"];

    $total=$price * $qty ;
    $status=$_POST["status"];

  
   
   $sql2= "UPDATE hmm_order SET
    qty='$qty',
    total='$total',
    status='$status',
    customer_name='$customer_name',
    customer_contact='$customer_contact',
    customer_email='$customer_email',
    custmer_adress='$customer_adress'
   WHERE id=$id";

    $res2=mysqli_query($conn, $sql2);

    if($res2==TRUE)
    {
        $_SESSION["update"]= "Order Updated";
       

        header("location:".SITEURL."admin/manage_order.php");

       
    }
    else
        {$_SESSION["update"]= "Failed to update order";
            

        header('location:http://localhost:3000/admin/update_order.php');
    }


}
 ?>
                   <form action="" method="post">
                 


                    <table class="tab">
                        <tr>
                            <td>Food name:</td>
                            <td>  <p style="font-size: larger ; font-weight: 600;"><?php echo $food ?></p></td>                           
                        </tr>
                        <tr>
                            <td>Price:</td>
                            <td>  <p style="font-size: larger ; font-weight: 400;">$ <?php echo $price ?></p></td>  
                        </tr>
                        <tr>
                       
                            <td>Quantity:</td>
                            <td><input type="number" class="qty_order" name="qty" value="<?php echo $qty; ?>"></td>
                        </tr>
                        <tr>

                            <td>Status:</td>
                            <td>
                                <select name="status">
                                    <option <?php if($status=="Ordered"){echo "selected";} ?> value='Ordered'>Ordered</option>
                                    <option <?php if($status=="On Deliver"){echo "selected";} ?> value='On Deliver'>On Delivery</option>
                                    <option <?php if($status=="Delivered"){echo "selected";} ?> value='Delivered'>Delivered</option>
                                    <option <?php if($status=="Cancelled"){echo "selected";} ?> value='Cancelled'>Cancelled</option>

                                </select>
                               

                            </td>
                           
                           
                           
                        </tr>
                        <tr>
                             <td>Customer Name:</td>
                            <td><input type="text" name="customer_name" value="<?php echo $customer_name; ?>"></td>       
                 
                        </tr>
                        <tr>
                             <td>Customer Contact:</td>
                            <td><input type="text" name="customer_contact" value="<?php echo $customer_contact; ?>"></td>       
                        </tr>
                        <tr>
                             <td>Customer Email:</td>
                             <td><input type="text" name="customer_email" value="<?php echo $customer_email; ?>"></td>       
                        </tr>
                        <tr>
                             <td>Customer Adress:</td>
                             <td>
                                <textarea name="adress"  cols="24" placeholder="adress"  ><?php echo $customer_adress ?></textarea>
                             </td>       
                        </tr>
                     

                        <tr>
                          
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="price" value="<?php echo $price; ?>">
                            <td colspan="2">
                            <input type="submit" name="submit" value="Update Category" class="btn1" style="padding: 3%;">
                            </td>
                        </tr>
                    </table>
                 </form>
                
            </div>
           

        </div>

   
     <?php include('parts/foot.php');  ?>
 
</body>
</html>