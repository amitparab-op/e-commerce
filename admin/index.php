<?php
include('../includes/connect.php');
include('../functions/common_function.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Font Awesome link -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../style.css">
    <style>
        .product_img {
            width: 100px;
            object-fit: contain;
        }
        .logo {
            width: 50px;
        }
        .navbar-custom {
            background-color: #00bfff;
        }
        .admin {
            width: 300px;
            border-radius: 50%;
        }
        .button a {
            display: block;
            margin-bottom: 10px;
            padding: 10px;
        }

        @media (max-width: 768px) {
            .admin {
                width: 200px;
            }
            .button a {
                padding: 8px;
                font-size: 14px;
            }
            .text-light {
                font-size: 14px;
            }
        }

        @media (max-width: 576px) {
            .admin {
                width: 150px;
            }
            .text-light {
                font-size: 12px;
            }
            .button a {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <img src="../images/logo.png" alt="Logo" class="logo">
                <nav class="navbar navbar-expand-lg">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="#" class="nav-link">Welcome guest</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>

        <!-- Manage Details Section -->
        <div class="bg-light">
            <h3 class="text-center p-2">Manage Details</h3>
        </div>

        <!-- Admin Controls Section -->
        <div class="container-fluid">
            <div class="row align-items-center bg-secondary text-center text-md-start">
                <div class="col-12 col-md-4">
                    <a href="#">
                        <img src="../images/pineapple.jpg" alt="Admin" class="admin">
                    </a>
                    <p class="text-light">Admin name</p>
                </div>
                <div class="col-12 col-md-8 text-center text-md-start">
                    <div class="button">
                        <a href="insert_product.php" class="nav-link text-light bg-info mt-3">Insert Products</a>
                        <a href="index.php?view_products" class="nav-link text-light bg-info">View Products</a>
                        <a href="index.php?insert_category" class="nav-link text-light bg-info">Insert Categories</a>
                        <a href="index.php?view_categories" class="nav-link text-light bg-info">View Categories</a>
                        <a href="index.php?list_orders" class="nav-link text-light bg-info">All Orders</a>
                        <a href="index.php?list_payments" class="nav-link text-light bg-info">All Payments</a>
                        <a href="index.php?list_users" class="nav-link text-light bg-info">List Users</a>
                        <a href="logout.php" class="nav-link text-light bg-info">Logout</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Dynamic Content Section -->
        <div class="container my-3">
            <?php
            if (isset($_GET['insert_category'])) {
                include('insert_categories.php');
            }

            if (isset($_GET['view_products'])) {
                include('view_products.php');
            }
            if (isset($_GET['edit_products'])) {
                include('edit_products.php');
            }
            if (isset($_GET['delete_product'])) {
                include('delete_product.php');
            }

            if (isset($_GET['view_categories'])) {
                include('view_categories.php');
            }
            if (isset($_GET['edit_category'])) {
                include('edit_category.php');
            }
            if (isset($_GET['delete_category'])) {
                include('delete_category.php');
            }

            if (isset($_GET['list_orders'])) {
                include('list_orders.php');
            }
            if (isset($_GET['delete_list_order'])) {
                include('delete_list_order.php');
            }

            if (isset($_GET['list_payments'])) {
                include('list_payments.php');
            }
            if (isset($_GET['delete_list_payments'])) {
                include('delete_list_payments.php');
            }

            if (isset($_GET['list_users'])) {
                include('list_users.php');
            }
            if (isset($_GET['delete_list_user'])) {
                include('delete_list_user.php');
            }
            ?>
        </div>

        <!-- Footer -->
        <div class="bg-info p-3 text-center">
            <p>All rights reserved @- Designed by Amit Parab-2024</p>
        </div>
    </div>

    <!-- Bootstrap JS link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
