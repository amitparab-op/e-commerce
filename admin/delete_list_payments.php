<?php

if (isset($_GET['delete_list_payments'])) {
    $delete_list_payments = $_GET['delete_list_payments'];
    // echo $delete_list_payments;

    $delete_query="Delete  from `user_payments` where order_id=$delete_list_payments";
    $result=mysqli_query($con,$delete_query);
    if($result){
        echo "<script>alert('Payment has been deleted successfully')</script>";
        echo "<script>window.open('./index.php?list_payments', '_self')</script>";
    }


}


?>