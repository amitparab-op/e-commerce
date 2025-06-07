    <title>View Products</title>

    <h1 class="text-center text-success">All products</h1>
    <table class="table table-bordered mt-5 ">
    <thead class="bg-success">
        <tr >
            <th>Product ID</th>
            <th>Product Title</th>
            <th>Product Image</th>
            <th>Product Price</th>
            <th>Total Sold</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody class="bg-secondary text-light">
    <!-- Dynamic rows for each product will be inserted here -->

    <?php
// Query to get all products
$get_products = "SELECT * FROM `products`";
$result = mysqli_query($con, $get_products);
$number = 0;

// Loop through each product from the result
while ($row = mysqli_fetch_assoc($result)) {
    $product_id = $row['product_id'];
    $product_title = $row['product_title'];
    $product_image1 = $row['product_image1'];
    $product_price = $row['product_price'];
    $status = $row['status'];
    $number++;
?>
    <!-- HTML table row to display product information -->
    <tr class="text-center">
        <td><?php echo $number; ?></td>
        <td><?php echo $product_title; ?></td>
        <td><img src="./product_image/<?php echo $product_image1; ?>" class="product_img" /></td>
        <td><?php echo $product_price; ?></td>
        <td>
            <?php
            // Query to get order count where product is pending
            $get_count = "SELECT * FROM `orders_pending` WHERE product_id = $product_id";
            $result_count = mysqli_query($con, $get_count);
            $rows_count=mysqli_num_rows($result_count);
            echo $rows_count;


            // Execute the query and fetch the result (not shown in the image but implied)
            ?>
        </td>
        <td><?php echo $status;?></td>
        <td><a href='index.php?edit_products=<?php echo $product_id?>' class='text-dark'><i class='fa-solid fa-pen-to-square'></i></a></td>
        <td><a href='index.php?delete_product=<?php echo $product_id?>' type="button" class=" text-dark" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class='fa-solid fa-trash'></i></a></td>

    </tr>
<?php
}
?>
</tbody>
</table>




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <h4>Are you sure you want to delete this?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><a href="./index.php?view_products" class='text-light text-decoration-none'>No</a></button>
        
        <button type="button" class="btn btn-primary"><a href='index.php?delete_product=<?php echo $product_id?>'  class='text-light text-decoration-none'>Yes</a></button>
      </div>
    </div>
  </div>
</div>

