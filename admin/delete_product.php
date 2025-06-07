<?php

if(isset($_GET['delete_product'])){
    $delete_product=$_GET['delete_product'];
    // echo $delete_product;

    $delete_query="Delete  from `products` where product_id=$delete_product";
    $result=mysqli_query($con,$delete_query);
    if($result){
        echo "<script>alert('Product has been deleted successfully')</script>";
        echo "<script>window.open('./index.php?view_products', '_self')</script>";
    }


}


?>