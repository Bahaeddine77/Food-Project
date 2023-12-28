<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/styly.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
</head>
<body>
    <?php include("parts/head.php") ?>

        <div class="body">
            <div class="bod">
                 <h1>Change Password</h1>
                 <br>
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
                        $password= $rows["password"];
                        
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
                            <td>Current Password:</td>
                            <td><input type="password" name="password1" placeholder="older password"></td>
                        </tr>
                        <tr>
                            <td>New Password:</td>
                            <td><input type="password" name="password2" placeholder="new password"></td>
                        </tr>
                        <tr>
                            <td>Confirm your new Password:</td>
                            <td><input type="password" name="password3" placeholder="confirm password"></td>
                        </tr>
                       

                        <tr>
                            <td colspan="2">
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <input type="submit" name="submit" value="Change password" class="btn1" style="padding: 3%;">
                            </td>
                        </tr>
                    </table>
                 </form>
                
            </div>
           
                <?php 
                    if(isset($_POST["submit"]))
                    {
                        $current_password=md5($_POST["password1"]);
                        $new_password=md5($_POST["password2"]);
                        $confirm_password=md5($_POST["password3"]);

                        $sql = "SELECT * FROM admin WHERE id=$id AND password='$current_password' ";
                        $res= mysqli_query($conn, $sql);
                        $count=mysqli_num_rows($res);
                        if($count==1)
                        {
                            if($new_password==$confirm_password)
                            {
                                $sql2 = "UPDATE admin SET password ='$new_password' WHERE id=$id  ";
                                $res2= mysqli_query($conn, $sql2);
                                if($res2==true)
                                {
                                    $_SESSION["change_pass"]="Password changed successfully";
                                    header("location:".SITEURL."admin/manager_admin.php");
                                }
                                else
                                {
                                    $_SESSION["change_pass"]="Failed to change Password ";
                                    header("location:".SITEURL."admin/manager_admin.php");

                                }
                                
                            }
                            else
                            {
                                $_SESSION["pass_not_match"]="Password not match";
                                header("location:".SITEURL."admin/manager_admin.php");
                            }
                        }
                        else
                        {
                            $_SESSION["user_not_found"]="User not found";
                            header("location:".SITEURL."admin/manager_admin.php");
                        }
                    }
                   
                ?>
        </div>

  
     <?php include('parts/foot.php');  ?>
 
</body>
</html>