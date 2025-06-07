<!-- connect file -->
<?php
include('includes/connect.php');
include('functions/common_function.php');
session_start();
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ecommerce website using PHP and MySQL</title>
  <!-- Bootstrap CSS link -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome link -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      overflow-x: hidden;
    }
    .logo {
      width: 50px;
    }
    .navbar-custom {
      background-color: #00bfff;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <div class="container-fluid p-0">
    <!-- First child -->
    <nav class="navbar navbar-expand-lg navbar-light bg-info navbar-custom">
      <div class="container-fluid">
        <!-- Logo with img-fluid class for responsiveness -->
        <img src="./images/logo.png" alt="Logo" class="logo img-fluid">
        <!-- Toggle button for collapsing navbar on mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="display_all.php">Products</a>
            </li>
            <?php
              if (isset($_SESSION['username'])) {
                echo "<li class='nav-item'>
                        <a class='nav-link' href='./users_area/profile.php'>My Account</a>
                      </li>";
              } else {
                echo "<li class='nav-item'>
                        <a class='nav-link' href='./users_area/user_registration.php'>Register</a>
                      </li>";
              }
            ?>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item(); ?></sup></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Total Price: <?php total_cart_price(); ?>/-</a>
            </li>
          </ul>
          <form class="d-flex" action="search_product.php" method="get">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
            <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
          </form>
        </div>
      </div>
    </nav>

    <!-- Second child: Welcome bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
      <ul class="navbar-nav me-auto">
        <?php
        if (!isset($_SESSION['username'])) {
          echo "<li class='nav-item'>
                  <a class='nav-link' href='#'>Welcome Guest</a>
                </li>";
        } else {
          echo "<li class='nav-item'>
                  <a class='nav-link' href='#'>Welcome " . $_SESSION['username'] . "</a>
                </li>";
        }

        if (!isset($_SESSION['username'])) {
          echo "<li class='nav-item'>
                  <a class='nav-link' href='./users_area/user_login.php'>Login</a>
                </li>";
        } else {
          echo "<li class='nav-item'>
                  <a class='nav-link' href='./users_area/logout.php'>Logout</a>
                </li>";
        }
        ?>
      </ul>
    </nav>

    <!-- Third child: Store description -->
    <div class="bg-light text-center py-3">
      <h3>Hidden Store</h3>
      <p>Communication is the heart of e-commerce and community</p>
    </div>

    <!-- Fourth child: Products and Categories -->
    <div class="row px-1">
      <div class="col-lg-10 col-md-9 col-12">
        <!-- Products -->
        <div class="row">
          <?php
          // Fetch products
          getproducts();
          search_product();
          get_unique_categories();
          cart();
          ?>
        </div>
      </div>
      
      <!-- Side nav for categories -->
      <div class="col-lg-2 col-md-3 col-12 bg-secondary p-0">
        <ul class="navbar-nav me-auto text-center">
          <li class="nav-item bg-info">
            <a href="#" class="nav-link text-light"><h4>Categories</h4></a>
          </li>
          <?php
          // Display categories
          getcategories();
          ?>
        </ul>
      </div>
    </div>

    <!-- Footer -->
    <?php include('./includes/footer.php'); ?>
  </div>

  <!-- Bootstrap JS link -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
