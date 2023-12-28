<?php
include("parts/head.php");
if (isset($_GET["id"])) {

    $id = $_GET["id"];
    $sql = "SELECT * FROM food WHERE id='$id'";
    $res = mysqli_query($conn, $sql);
    if ($res == true) {
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            $rows = mysqli_fetch_assoc($res);
            $title1 = $rows["title"];
            $price1 = $rows["price"];
            $category = $rows["category_id"];
            $img_name = $rows["img_name"];
            $featured = $rows["featured"];
            $active = $rows["active"];
        } else {
            header("location:".SITEURL."admin/update_food.php");
            exit();
        }
    }
}

if (isset($_POST["submit"])) {
    // Handle form submission
    $title = $_POST["title"];
    $price = $_POST["price"];
    $featured = $_POST["featured"];
    $active = $_POST["active"];
    $img_name = $_POST["img_name"];
    $id = $_POST["id"];
    if(isset($_FILES["image"]["name"]))
    {
        $image_name=$_FILES["image"]["name"];

        if($image_name != "")
        {
            $exploded = explode('.', $image_name);
            $ext = end($exploded);
            

            $image_name="food_".rand(0000,9999).'.'.$ext;




            $source_path=$_FILES["image"]["tmp_name"];

            $destination_path="../images/food/".$image_name;

            $upload = move_uploaded_file($source_path, $destination_path);

            if($upload==FALSE)
            {
                $_SESSION["upload"]="Failed to upload image";
                
                header('location:http://localhost:3000/admin/update_food.php');
                die();


            };
            if($img_name != "")
            {
                $remove_path="../images/food/".$img_name;
                $remove = unlink($remove_path);
                if($remove ==false)
                {
                    $_SESSION["remove_img"]="Failed to remove food image";
                    header("location:".SITEURL."admin/manage_food.php");
                    die();
                   
        
                }
            }

           
        }
        else
        {
            $image_name= $img_name;
        }

       
    }
    else
    {
        $image_name=$img_name;
    }
   
   
   $sql2= "UPDATE food SET
   title='$title',
   price='$price',
   img_name='$image_name',
   featured='$featured',
   active='$active'
   WHERE id='$id'";

    $res2=mysqli_query($conn, $sql2);

    
    if ($res2 == TRUE) {
        $_SESSION["update"] = "food updated";
        header("location:".SITEURL."admin/manage_food.php");
        exit();
    } else {
        $_SESSION["update"] = "Failed to update food";
        header('location:http://localhost:3000/admin/update_food.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/styly.css">
</head>
<body>
    

    <div class="body">
        <div class="bod">
            <h1>Update food</h1>
            <br>
            <?php
            if (isset($_SESSION["update"])) {
                echo $_SESSION["update"];
                unset($_SESSION["update"]);
            }
            if (isset($_SESSION["upload"])) {
                echo $_SESSION["upload"];
                unset($_SESSION["upload"]);
            }
            ?>
            <br>
            <form action="" method="post" enctype="multipart/form-data">
            <table class="tab">
                        <tr>
                            <td>Title:</td>
                            <td><input type="text" name="title" value="<?php echo $title1; ?>"></td>
                        </tr>
                        <tr>
                            <td>Price:</td>
                            <td><input type="number" step="any" name="price" value="<?php echo $price1; ?>"></td>
                        </tr>
                        <tr>

                            <td>Current image:</td>
                           
                                <td>
                                        <?php
                                        if($img_name!="")
                                        {
                                            ?>
                                            <img src="http://localhost:3000/images/food/<?php echo $img_name; ?>" width="150px">
                                            <?php
                                        }    
                                        else
                                        {
                                           
                                            echo "Image not added";
                                           
                                        }
                                    ?>
                                </td>
                           
                        </tr>
                        <tr>
                             <td>Select image:</td>
                            <td><input type="file" name="image"></td>       
                        </tr>
                        <tr>
                            <td>Category:</td>
                            <td>
                                <select name="category" >

                                        <?php
                                            $sql1= "SELECT * FROM category WHERE active='Yes'";
                                            $res1= mysqli_query($conn, $sql1);
                                            $count1= mysqli_num_rows($res1);
                                            if($count1>0)
                                            {
                                                while($row1=mysqli_fetch_assoc($res1))
                                                {
                                                    $category_title=$row1['title'];
                                                    $category_id=$row1['id'];

                                                    echo "<option value='$category_id'>$category_title</option>";
                                                }
                                            }
                                            else
                                            {
                                                echo "<option value='0'>Category not available.</option>";
                                            }

                                        ?>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>Featured:</td>
                            <td>
                                <input <?php if($featured=="Yes"){ echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
                                <input <?php if($featured=="No"){ echo "checked";} ?> type="radio" name="featured" value="No">No
                        
                            </td>
                        </tr>
                        <tr>
                            <td>Active:</td>
                            <td>
                                <input <?php if($active=="Yes"){ echo "checked";} ?> type="radio" name="active" value="Yes">Yes
                                <input <?php if($active=="No"){ echo "checked";} ?> type="radio" name="active" value="No">No
                            </td>
                        </tr>

                        <tr>
                            <input type="hidden" name="img_name" value="<?php echo $img_name; ?>">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <td colspan="2">
                                <input type="submit" name="submit" value="Update Category" class="btn1" style="padding: 3%">
                            </td>
                            
                        </tr>
                    </table>
            </form>
        </div>
    </div>

    <?php include('parts/foot.php'); ?>
</body>
</html>
