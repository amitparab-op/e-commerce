<!-- connect file  -->
<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();
if(isset($_GET['order_id'])){
    $order_id = $_GET['order_id'];
    // echo $order_id;

// SQL query to fetch the data for the given order_id
$select_data = "Select * from `user_orders` where order_id=$order_id";
$result = mysqli_query($con, $select_data);

// Fetch the result as an associative array
$row_fetch = mysqli_fetch_assoc($result);

// Extract the invoice number and amount due from the row
// $payment_mode = isset($_POST['payment_mode']) ? $_POST['payment_mode'] : null;
// $invoice_number = isset($_POST['invoice_number']) ? $_POST['invoice_number'] : null;
$invoice_number = $row_fetch['invoice_number'];
$amount_due = $row_fetch['amount_due'];


}

if (isset($_POST['confirm_payment'])) {
    // Retrieve values from the form
    $invoice_number = $_POST['invoice_number'];
    $amount = $_POST['amount'];
    $payment_mode = $_POST['payment_mode'];

    // Insert query to store the payment details in the user_payments table
    $insert_query = "INSERT INTO `user_payments` (order_id, invoice_number, amount, payment_mode) 
                     VALUES ($order_id, '$invoice_number', '$amount', '$payment_mode')";
    
    // Execute the query
    $result = mysqli_query($con, $insert_query);

    // Check if the query was successful
    if ($result) {
        echo "<h3 class='text-center text-light'>Successfully completed the payment</h3>";
        echo "<script>window.open('profile.php?my_orders', '_self')</script>";
    }

    $update_orders="update `user_orders` set order_status='Complete' where order_id=$order_id";
    $result_orders = mysqli_query($con, $update_orders);
}



?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment page</title>
    <!-- bootstrap css link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="bg-secondary">
<div class="container my-5">
    <h1 class="text-center text-light">Confirm Payment</h1>
    <form action="" method="post">
        <div class="form-outline my-4 text-center w-50 m-auto">
            <input type="number" class="form-control w-50 m-auto" name="invoice_number" placeholder="Invoice Number" value="<?php echo $invoice_number ?>">
        </div>
        <div class="form-outline my-4 text-center w-50 m-auto">
            <label for="amount" class="text-light">Amount</label>
            <input type="number" class="form-control w-50 m-auto" name="amount"  placeholder="Enter Amount" value="<?php echo $amount_due ?>">
        </div>
        <div class="form-outline my-4 text-center w-50 m-auto">
            <select name="payment_mode" class="form-select w-50 m-auto">
            <option>Select Payment Mode</option>

                <option>UPI</option>
                <option>Net Banking</option>
                <option>Paypal</option>
                <option>Credit Card</option>
                <option>Pay Offline</option>
            </select>
        </div>
        <div class="form-outline my-4 text-center w-50 m-auto">
            <input type="submit" class="bg-info py-2 px-3 border-0" value="Confirm" name="confirm_payment">


    </form>
</div>



</body>
</html>

