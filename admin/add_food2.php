<?php


if (isset($_POST["submit"])) {
    include("parts/head.php");

    $title = $_POST["title2"];
    $price = $_POST["price"];
    $description=mysqli_real_escape_string($conn, $_POST["description"]);
    $category = $_POST["category"];
    if (isset($_POST["featured"])) {
        $featured = $_POST["featured"];
    } else {
        $featured = "No";
    }
    if (isset($_POST["active"])) {
        $active = $_POST["active"];
    } else {
        $active = "No";
    }
    if (isset($_FILES["image"]["name"])) {
        $image_name = $_FILES["image"]["name"];

        if ($image_name != "") {
            $exploded = explode('.', $image_name);
            $ext = end($exploded);

            $image_name = "food_" . rand(0000, 9999) . '.' . $ext;

            $source_path = $_FILES["image"]["tmp_name"];
            $destination_path = "../images/food/" . $image_name;

            $upload = move_uploaded_file($source_path, $destination_path);

            if ($upload == FALSE) {
                $_SESSION["upload"] = "Failed to upload image";
                header('location:http://localhost:3000/admin/add_food.php');
                exit();
            }
        }
    } else {
        $image_name = "";
    }

    $sql2 = "INSERT INTO food SET
            title='$title',
            description='$description',
            price='$price',
            category_id='$category',
            featured='$featured',
            img_name='$image_name',
            active='$active'";

    $res2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));

    if ($res2 == TRUE) {
        $_SESSION["addc"] = "food added";
        header("location:" . SITEURL . "admin/manage_food.php");
        exit();
    } else {
        $_SESSION["addc"] = "Failed to add food";
        header('location:http://localhost:3000/admin/add_food.php');
        exit();
    }
}

include("parts/head.php"); 

?>
<!DOCTYPE html>
<html lang="en">
<head>
</head>
<body>
    <?php
    if (isset($_SESSION["addc"])) {
        echo $_SESSION["addc"];
        unset($_SESSION["addc"]);
    }
    if (isset($_SESSION["upload"])) {
        echo $_SESSION["upload"];
        unset($_SESSION["upload"]);
    }
    ?>

    <div class="body">
        <div class="bod">
            <h1>Add Food</h1>
            <br>
            <br>

            <form action="" method="post" enctype="multipart/form-data">

                <table class="tab">
                <tr>
                            <td>Title:</td>
                            <td><input type="text" name="title2" placeholder="Food title"></td>
                        </tr>
                        <tr>
                            <td>Description:</td>
                            <td><textarea name="description" cols="28" rows="7" placeholder="Food description"></textarea>

                            </td>
                        </tr>
                        <tr>
                            <td>Price:</td>
                            <td><input type="number" step="any" name="price" ></td>
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
                            <input type="submit" name="submit" value="Add food" class="btn1" style="padding: 3%;">
                            </td>
                        </tr>
                     
                </table>
            </form>

        </div>
    </div>

    <?php include('parts/foot.php'); ?>

</body>
</html>
