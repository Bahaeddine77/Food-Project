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
                 <h1>Dashboard</h1>
                 <br>
                 <?php if(isset($_SESSION["login"]))
                    {
                        echo $_SESSION["login"];  
                        unset($_SESSION["login"]); 
                    }?>
                 
                 <div class="col t-center">
                    <?php 
                        $sql="SELECT * FROM category";
                        $res=mysqli_query($conn, $sql);
                        $count=mysqli_num_rows($res);


                    ?>
                    <h1><?php echo $count;?></h1>
                    <p class="t-center">Categories</p>

                 </div>

                 <div class="col">
                    <?php
                        $sql2="SELECT * FROM food";
                        $res2=mysqli_query($conn, $sql2);
                        $count2=mysqli_num_rows($res2);
                        ?>


                    <h1 class="t-center" ><?php echo $count2;?></h1>
                    <p class="t-center">Foods</p>

                 </div>

                 <div class="col">
                    <?php
                        $sql3="SELECT * FROM hmm_order";
                        $res3=mysqli_query($conn, $sql3);
                        $count3=mysqli_num_rows($res3);
                        ?>
                    <h1 class="t-center" ><?php echo $count3;?></h1>
                    <p class="t-center">Total Orders</p>

                 </div>

                 <div class="col">
                     <?php
                        $sql4="SELECT SUM(total) As totaly FROM hmm_order WHERE status='Delivered'";
                        $res4=mysqli_query($conn, $sql4);
                        $row4=mysqli_fetch_assoc($res4);
                        $total=$row4["totaly"];
                        
                        ?>

                    <h1 class="t-center" >$ <?php echo $total;?></h1>
                    <p class="t-center">Revenue Generated</p>

                 </div>

                 <div class="clear-fix"></div>



            </div>
           

        </div>

    <?php include('parts/foot.php');  ?>
 
</body>
</html>