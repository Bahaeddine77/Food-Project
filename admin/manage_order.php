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
            <div class="bod_order">
                <h1 style="margin: 1% 5%;">Manage order</h1>
                <br>
                <?php if(isset($_SESSION["update"]))
                    {
                        echo $_SESSION["update"];  
                        unset($_SESSION["update"]); 
                    }
                  ?>

            
             
                <table class="tab_order">
                    <tr>
                        <th>S.N</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Order_date</th>
                        <th>Status</th>
                        <th>Customer_name</th>
                        <th>Contact</th>
                        <th>email</th>
                        <th>Adress</th>
                        <th>Actions</th>
                    </tr>
                    <?php
                            $sql = "SELECT * FROM hmm_order ORDER BY id DESC";
                            $res = mysqli_query($conn, $sql);

                            $sn=1;

                            if( $res==TRUE )
                            {
                                $count= mysqli_num_rows($res);

                                if ($count >0){
                                 
                                    while($rows=mysqli_fetch_assoc($res))  
                                    {
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
                                        ?>
                                        <tr>
                                            <td><?php echo $sn++; ?></td>
                                            <td><?php echo $food; ?></td>
                                            <td><?php echo $price; ?></td>
                                            <td><?php echo $qty; ?></td>
                                            <td><?php echo $total; ?></td>
                                            <td><?php echo $order_date; ?></td>
                                            
                                            <td><?php
                                                if($status=="Ordered")
                                                {
                                                    echo "<label style='color: blue;'>$status</label>";
                                                }
                                                if($status=="On Deliver")
                                                {
                                                    echo "<label style='color: orange;'>On Delivery</label>";
                                                }
                                                if($status=="Delivered")
                                                {
                                                    echo "<label style='color: green;'>$status</label>";
                                                }
                                                if($status=="Cancelled")
                                                {
                                                    echo "<label style='color: red;'>$status</label>";
                                                }

                                    
                                              ?>
                                             </td>
                                            <td><?php echo $customer_name; ?></td>
                                            <td><?php echo $customer_contact; ?></td>
                                            <td><?php echo $customer_email; ?></td>
                                            <td><?php echo $customer_adress; ?></td>
                                            <td>
                                               
                                                <a href="<?php echo SITEURL;?>admin/update_order.php?id=<?php echo $id ;?>" class="btn2" >Update Admin</a>
                                                
                                               
                                             </td>
                                        </tr>
                                        <?php 
                                    }
                                }
                                else
                                {
                                    ?>
                                    <tr>
                                        <td colspan="12" style="color:brown;">Order not available </td>
                                    </tr>
                                    <?php
                                }
                               
                            }

                            



                        ?>

                 
                 </table>

            </div>
           

        </div>

    <?php include('parts/foot.php');  ?>
 
</body>
</html>