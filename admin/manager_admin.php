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
                 <h1>Manage Admin</h1>
                 <br>
                 

                 <?php  
                    if(isset($_SESSION["add"]))
                    {
                        echo $_SESSION["add"]; 
                        unset($_SESSION["add"]); 
                    }
                    if(isset($_SESSION["delete"]))
                    {
                        echo $_SESSION["delete"];  
                        unset($_SESSION["delete"]); 
                    }
                    if(isset($_SESSION["update"]))
                    {
                        echo $_SESSION["update"];  
                        unset($_SESSION["update"]); 
                    }
                    if(isset($_SESSION["user_not_found"]))
                    {
                        echo $_SESSION["user_not_found"];  
                        unset($_SESSION["user_not_found"]); 
                    }
                    if(isset($_SESSION["pass_not_match"]))
                    {
                        echo $_SESSION["pass_not_match"];  
                        unset($_SESSION["pass_not_match"]); 
                    }
                    if(isset($_SESSION["change_pass"]))
                    {
                        echo $_SESSION["change_pass"];  
                        unset($_SESSION["change_pass"]); 
                    }
                  
                    ?>
                <br>
                <br>
                 <a href="add_admin.php" class="btn1">Add Admin</a>

                 <table class="tableau">
                    <tr>
                        <th>S.N</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>

                        <?php
                            $sql = "SELECT * FROM admin";
                            $res = mysqli_query($conn, $sql);

                            $sn=1;

                            if( $res==TRUE )
                            {
                                $count= mysqli_num_rows($res);

                                if ($count >0){
                                   
                                
                                    while($rows=mysqli_fetch_assoc($res))  
                                    {
                                        $id = $rows['id'];
                                        $full_name=$rows["full_name"];
                                        $username=$rows["username"];
                                        ?>
                                        <tr>
                                            <td><?php echo $sn++; ?></td>
                                            <td><?php echo $full_name; ?></td>
                                            <td><?php echo $username; ?></td>
                                            <td>
                                               
                                                <a href="<?php echo SITEURL;?>admin/update_admin.php?id=<?php echo $id ;?>" class="btn2">Update Admin</a>
                                                <a href="<?php echo SITEURL;?>admin/update_password.php?id=<?php echo $id ;?>" class="btn4">Change Password</a>
                                                <a href="<?php echo SITEURL;?>admin/delete_admin.php?id=<?php echo $id ;?>" class="btn3">Delete Admin</a>
                                               
                                            </td>
                                        </tr>
                                        <?php 
                                    }
                                }
                               
                            }
                            else
                            {
                                ?>
                                <tr>
                                    <td colspan="6" style="color:brown;">No admin added </td>
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