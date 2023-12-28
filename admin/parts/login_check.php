<?php
    if(!$_SESSION["user"])
    {
        $_SESSION["user_not_found"]= "<div class='t-center' >Please login to access admin panel</div>";

                header("location:".SITEURL."admin/login.php");
    }

?>