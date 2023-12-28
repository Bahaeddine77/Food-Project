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
                 <h1>Add Category</h1>
                 <br>
                 <br>
               
                 <?php  
                    if(isset($_SESSION["addc"]))
                    {
                        echo $_SESSION["addc"];  
                        unset($_SESSION["addc"]); 
                    }
                    if(isset($_SESSION["upload"]))
                    {
                        echo $_SESSION["upload"];  
                        unset($_SESSION["upload"]); 
                    }
                    ?>
                 <form action="" method="post" enctype="multipart/form-data">


                    <table class="tab">
                        <tr>
                            <td>Title:</td>
                            <td><input type="text" name="title" placeholder="Category title"></td>
                        </tr>
                        <tr>
                             <td>Select image:</td>
                            <td><input type="file" name="image"></td>     
                        </tr>
                        <tr>
                            <td>Featured:</td>
                            <td>
                                <input type="radio" name="featured" value="Yes">Yes
                                <input type="radio" name="featured" value="No">No
                        
                            </td>
                        </tr>
                        <tr>
                            <td>Active:</td>
                            <td>
                                <input type="radio" name="active" value="Yes">Yes
                                <input type="radio" name="active" value="No">No
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2">
                            <input type="submit" name="submit" value="Add Category" class="btn1" style="padding: 3%;">
                            </td>
                        </tr>
                    </table>
                 </form>
                
            </div>
           

        </div>

    <?php include('parts/foot.php');  
    if(isset($_POST["submit"]))
    {
        $title=$_POST["title"];
        if(isset($_POST["featured"]))
        {
            $featured=$_POST["featured"];
        }
        else
        {
            $featured="No";
        }
        if(isset($_POST["active"]))
        {
            $active=$_POST["active"];
        }
        else
        {
            $active="No";
        }
        if(isset($_FILES["image"]["name"]))
        {
            $image_name=$_FILES["image"]["name"];

            if($image_name!="")
            {
                $ext= end(explode('.',$image_name));

                $image_name="food_category_".rand(000,999).'.'.$ext;




                $source_path=$_FILES["image"]["tmp_name"];

                $destination_path="../images/category/".$image_name;

                $upload = move_uploaded_file($source_path, $destination_path);

                if($upload==FALSE)
                {
                    $_SESSION["upload"]="Failed to upload image";
                    
                    header('location:http://localhost:3000/admin/add_category.php');


                }
            }


           
        }
        else
        {
            $image_name="";
        }



        $sql= "INSERT INTO category SET
            title='$title',
            featured='$featured',
            img_name='$image_name',
            active='$active'
            ";

        $res= mysqli_query($conn, $sql) or die(mysqli_error($conn));

        if($res==TRUE)
        {
            $_SESSION["addc"]= "Category added ";

            header("location:".SITEURL."admin/manage_category.php");

        }
        else
            {$_SESSION["addc"]= "Failed to add category";

            header('location:http://localhost:3000/admin/add_category.php');}

        

    }
    
    
    
    
    ?>
 
</body>
</html>