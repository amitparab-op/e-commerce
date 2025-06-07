<?php

if (isset($_GET['delete_list_user'])) {
    $delete_list_user = $_GET['delete_list_user'];
    // echo $delete_list_user;

    $delete_query="Delete  from `user_table` where user_id=$delete_list_user";
    $result=mysqli_query($con,$delete_query);
    if($result){
        echo "<script>alert('User has been deleted successfully')</script>";
        echo "<script>window.open('./index.php?list_users', '_self')</script>";
    }


}




?>