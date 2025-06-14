
<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start(); // Make sure session_start() is at the very beginning of your script
if (!isset($_SESSION['user_id'])) {
    echo "Session user_id is not set!";
} else {
    echo "Session user_id is: " . $_SESSION['user_id'];
}
echo "User ID before query: $user_id"; // This will help you see the value of $user_id before inserting it into the query.


// Getting total items and total price of all items
$get_ip_address = getIPAddress();
$total_price = 0;
$cart_query_price = "SELECT * FROM `cart_details` WHERE ip_address='$get_ip_address'";
$result_cart_price = mysqli_query($con, $cart_query_price);

$invoice_number=mt_rand();
$status='pending';
$count_products = mysqli_num_rows($result_cart_price);


while ($row_price = mysqli_fetch_array($result_cart_price)) {
    $product_id = $row_price['product_id'];
    $select_product = "SELECT * FROM `products` WHERE product_id=$product_id";

    $run_price = mysqli_query($con,$select_product);


    while ($row_product_price = mysqli_fetch_array($run_price)) {
        $product_price = array($row_product_price['product_price']);
        $product_values = array_sum($product_price);
        $total_price+=$product_values;
    }
}



// Getting quantity from the cart


$get_cart = "SELECT * FROM `cart_details`";
$run_cart = mysqli_query($con, $get_cart);
$get_item_quantity = mysqli_fetch_array($run_cart);
$quantity = $get_item_quantity['quantity'] ;

if ($quantity == 0) {
    $quantity = 1;
    $subtotal = $total_price;

} else {
    $quantity = $quantity;
    $subtotal = $total_price*$quantity;

}

// Inserting the order details into the user_orders table
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 
null; // From session
// while ($row_price = mysqli_fetch_array($result_cart_price)) {
//     $user_id = $row_price['user_id'];
//     $select_product = "SELECT * FROM `user_table` WHERE user_id=$user_id";

//     $run_price = mysqli_query($con,$select_product);
// }



// Ensure user_id, subtotal, and invoice_number are correct and numeric values are not wrapped in quotes
$insert_orders = "INSERT into `user_orders` (user_id, amount_due, invoice_number, total_products, order_date, order_status) 
                  values ('$user_id', $subtotal, $invoice_number, $count_products, NOW(), '$status')";

// Debug the query by printing it
echo $insert_orders; 

$result_orders = mysqli_query($con, $insert_orders);

// Check if the query executes successfully
if ($result_orders) {
    echo "<script>alert('Orders are submitted successfully')</script>";
    echo "<script>window.open('profile.php', '_self')</script>";
} else {
    echo "<script>alert('Failed to submit the order')</script>";
    echo mysqli_error($con);  // Print the exact error
}


// orders pending 
$insert_pending_orders = "INSERT INTO `orders_pending` (user_id, invoice_number, product_id, quantity, order_status) 
                          VALUES ('$user_id', $invoice_number, $product_id, $quantity, '$status')";

$result_pending_orders = mysqli_query($con, $insert_pending_orders);

// delete itemns from cart
$empty_cart="Delete from `cart_details` where ip_address='$get_ip_address'";
$result_delete = mysqli_query($con, $empty_cart);





?>


