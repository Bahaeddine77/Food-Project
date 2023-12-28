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
                 <h1>Add Admin</h1>
                 <br>
                 <br>
               
                 <?php  
                    if(isset($_SESSION["add"]))
                    {
                        echo $_SESSION["add"];  
                        unset($_SESSION["add"]); 
                    }
                    ?>
                 <form action="" method="post">


                    <table class="tab">
                        <tr>
                            <td>Full name:</td>
                            <td><input type="text" name="full_name" placeholder="your name"></td>
                        </tr>
                        <tr>
                            <td>Username:</td>
                            <td><input type="text" name="username" placeholder="username"></td>
                        </tr>
                        <tr>
                            <td>Password:</td>
                            <td><input type="password" name="password" placeholder="password"></td>
                        </tr>

                        <tr>
                            <td colspan="2">
                            <input type="submit" name="submit" value="Add Admin" class="btn1" style="padding: 3%;">
                            </td>
                        </tr>
                    </table>
                 </form>
                
            </div>
           

        </div>

    <?php include('parts/foot.php');  
    if(isset($_POST["submit"]))
    {
        $full_name=$_POST["full_name"];
        $username=$_POST["username"];
        $password=md5($_POST["password"]);



        $sql= "INSERT INTO admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
            ";

        $res= mysqli_query($conn, $sql) or die(mysqli_error($conn));

        if($res==TRUE)
        {
            $_SESSION["add"]= "Admin added ";

            header("location:".SITEURL."admin/manager_admin.php");

        }
        else
            {$_SESSION["add"]= "Failed to add admin";

            header('location:http://localhost:3000/admin/add_admin.php');}

        

    }
    
    
    
    
    ?>
 
</body>
</html>