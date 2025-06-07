<?php

if (isset($_GET['delete_list_order'])) {
    $delete_list_order = $_GET['delete_list_order'];
    // echo $delete_list_order;

    $delete_query="Delete  from `user_orders` where order_id=$delete_list_order";
    $result=mysqli_query($con,$delete_query);
    if($result){
        echo "<script>alert('Order has been deleted successfully')</script>";
        echo "<script>window.open('./index.php?list_order', '_self')</script>";
    }
}