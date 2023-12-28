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
                    } ?>
                 <br>
               
                 <?php  
                 $id= $_GET["id"];
                 $sql= "SELECT * FROM admin WHERE id=$id";
                 $res=mysqli_query($conn,$sql);
                 if($res==true)
                 {  $couny=mysqli_num_rows($res);
                    if($couny==1)
                    {
                        $rows=mysqli_fetch_assoc($res);
                        $full_name= $rows["full_name"];
                        $username=$rows["username"];
                    }
                    else
                    {
                        header("location:".SITEURL."admin/manager_admin.php");
                    }


                 }
                   
                    ?>
                 <form action="" method="post">


                    <table class="tab">
                        <tr>
                            <td>Full name:</td>
                            <td><input type="text" name="full_name" value="<?php echo $full_name ?>"></td>
                        </tr>
                        <tr>
                            <td>Username:</td>
                            <td><input type="text" name="username" value="<?php echo $username ?>"></td>
                        </tr>
                       

                        <tr>
                            <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <input type="submit" name="submit" value="Update Admin" class="btn1" style="padding: 3%;">
                            </td>
                        </tr>
                    </table>
                 </form>
                
            </div>
           

        </div>

   <?php
    if(isset($_POST["submit"]))
    {
        $full_name=$_POST["full_name"];
        $username=$_POST["username"];
        $id= $_POST["id"];
       
       
       $sql= "UPDATE admin SET
       full_name='$full_name',
       username='$username'
       WHERE id=$id";

        $res=mysqli_query($conn, $sql);

        if($res==TRUE)
        {
            $_SESSION["update"]= "Admin updated";

            header("location:".SITEURL."admin/manager_admin.php");

        }
        else
            {$_SESSION["update"]= "Failed to update admin";
                

            header('location:http://localhost:3000/admin/update_admin.php');}

        

    }

    
    ?>
     <?php include('parts/foot.php');  ?>
 
</body>
</html>