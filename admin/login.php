<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/styly.css">
</head>
<body>
<?php include("../config/constants.php"); ?>

        <div class="body">
            <div class="bod" style="position: relative;">
                 <h1 class="t-center">Login</h1>
                 <br>
                 <br>
                 <?php if(isset($_SESSION["login_erreur"]))
                    {
                        echo $_SESSION["login_erreur"];  
                        unset($_SESSION["login_erreur"]); 
                    }
                    if(isset($_SESSION["user_not_found"]))
                    {
                        echo $_SESSION["user_not_found"]; 
                        unset($_SESSION["user_not_found"]);
                    }?>
               
                 
               <div class="taby">
               <form action="" method="post">


                        <table class="tab1 t-center">
                        
                            <tr>
                                <td><p class="te">Username:</p></td>
                                
                            </tr>
                            <tr>
                                 <td><input type="text" name="username" placeholder="username" style="padding: 2%;"></td>
                            </tr>
                            <tr>
                                <td><p class="te">Password:</p></td>
                             
                            </tr>
                            <tr>
                                <td><input type="password" name="password" placeholder="password" style="padding: 2%; "><br></td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                <input type="submit" name="submit" value="login" class="btn5" >
                                </td>
                            </tr>
                        </table>
                        </form>
               </div>
                
                
            </div>
           

        </div>

    <?php 
    if(isset($_POST["submit"]))
    {
        $username=mysqli_real_escape_string($conn, $_POST["username"]);
        $password_yy=md5($_POST["password"]);
        $password=mysqli_real_escape_string($conn, $password_yy);




        $sql1= "SELECT * FROM admin 
            WHERE username= '$username' 
            ";

        $res1= mysqli_query($conn, $sql1);
        $count1= mysqli_num_rows($res1);
      

        $sql2="SELECT * FROM admin WHERE password='$password'";
        $res2= mysqli_query($conn, $sql2);
        $count2= mysqli_num_rows($res2);
      
        
           
            if ($count1>0 ) 
            {
                $row1=mysqli_fetch_assoc($res1);
                $password1=$row1["password"];
                if($password1==$password)
                {
                    $_SESSION["login"]= "<h1 class='t-center'>Welcome </h1>";
                    $_SESSION["user"]= $username;
    
                    header("location:".SITEURL."admin/home.php");
                }

                else
                {
                    $_SESSION["login_erreur"]= "<div class='login_message' >Password not correct</div>";

                    header('location:http://localhost:3000/admin/login.php');
                   

                  
                  
                }
            }

            else
            {
                if($count2>0)
                {
                    $_SESSION["login_erreur"]= "<div class='login_message' >Username not correct</div>";

                    header('location:http://localhost:3000/admin/login.php');

                }
                else                
                {$_SESSION["login_erreur"]= " <div class='login_message' >user not found</div>";

                    header('location:http://localhost:3000/admin/login.php');}
            }
          

           
        

    }
    
    
    
    
    ?>

</body>
</html>