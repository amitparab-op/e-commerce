<?php
include('../includes/connect.php');
include('../functions/common_function.php');
@session_start();

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login </title>
         <!-- bootstrap css link -->
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
         <style>
            body{
                overflow:hidden;
            }
         </style>

<!-- font awesome link -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">


</head>
<body>
    <div class="container-fluid m-3">
    <h2 class="text-center mb-5">Admin Registration</h2>
    <div class="row d-flex justify-content-center ">
        <div class="col-lg-6 col-xl-5">
            <img src="../images/w.jpg" alt="Admin Registration" class="img-fluid">

        </div>
        <div class="col-lg-6 col-xl-4">
    <form action="" method="post">
        <div class="form-outline mb-4">
            <label for="username" class="form-label">Username</label>
            <input type="text" id="username" name="admin_name" placeholder="Enter your username" required="required" class="form-control" >
        </div>


        <div class="form-outline mb-4">
            <label for="password" class="form-label">Password</label>
            <input type="password" id="password" name="admin_password" placeholder="Enter your password" required="required" class="form-control" >
        </div>

        <div>
            <input type="submit" class="bg-info py-2 px-3 border-0" name="admin_login"  value="Login">
            <p class="small fw-bold mt-2 pt-1">Don't you  have an account?<a href="admin_registration.php" class="link-danger">Register</a></p>
        </div>


    </form>
</div>

        </div>

    </div>
    </div>
</body>
</html>

<?php
if (isset($_POST['admin_login'])) {
    $admin_name = mysqli_real_escape_string($con, $_POST['admin_name']); // Sanitize input
    $admin_password = $_POST['admin_password'];

    // Query to select the admin by name
    $select_query = "SELECT * FROM `admin_table` WHERE admin_name='$admin_name'";
    $result = mysqli_query($con, $select_query);
    $row_count = mysqli_num_rows($result);

    if ($row_count > 0) {
        // Fetch the admin data from the result
        $row_data = mysqli_fetch_assoc($result);
        $hashed_password = $row_data['admin_password']; // Assuming password is stored hashed

        // Verify the entered password against the stored hashed password
        if (password_verify($admin_password, $hashed_password)) {
            // Password is correct, log the admin in
            session_start();
            $_SESSION['admin_name'] = $admin_name;  // Storing admin name in session
            echo "<script>alert('Login successful!');</script>";
            echo "<script>window.open('index.php', '_self');</script>";  // Redirect to admin dashboard
        } else {
            // Password is incorrect
            echo "<script>alert('Invalid credentials. Please try again.');</script>";
            echo "<script>window.open('admin_login.php', '_self');</script>";  // Redirect back to login page
        }
    } else {
        // Admin name doesn't exist
        echo "<script>alert('Invalid credentials. Please try again.');</script>";
        echo "<script>window.open('admin_login.php', '_self');</script>";  // Redirect back to login page
    }
}
?>


   




